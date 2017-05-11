<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Repositories\FinancesRepository;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $finances;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FinancesRepository $financesRepository)
    {
        $this->finances = $financesRepository;
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (isAdmin()) {
            $year = $request->input('year', Carbon::now()->year);
            $month = $request->input('month', Carbon::now()->month);
            $stats = $this->finances->byDate($month, $year);
            $incomesByCategory = $this->finances->incomesByCategory($month, $year);
            $expensesByCategory = $this->finances->expensesByCategory($month, $year);
            $months = [
                1 => 'enero',2 => 'febrero',3 => 'marzo',4 => 'abril',5 => 'mayo',6 => 'junio',7 => 'julio',8 => 'agosto',9 => 'septiembre',10 => 'octubre',11 => 'noviembre',12 => 'diciembre'
            ];
            $summary['new_clients'] = DB::table('notifications')
                ->where('notifiable_id', '=', $request->user()->id)
                ->where('type', '=', 'App\Notifications\Clients\RegisteredClient')
                ->where('read_at', '=', null)
                ->get()
                ->count();
            $summary['notifications'] = $request->user()->unreadNotifications->count();
            $summary['new_invoices'] = DB::table('notifications')
                ->where('notifiable_id', '=', $request->user()->id)
                ->where('type', '=', 'App\Notifications\Invoices\CreatedInvoice')
                ->where('read_at', '=', null)
                ->get()
                ->count();
            return view('sections.start', compact('stats', 'incomesByCategory', 'expensesByCategory', 'months', 'summary'));
        }
        if (isClient()) {
            $posts = Post::all();
            $notifications = $request->user()->unreadNotifications;
            $exercises = DB::table('notifications')
                ->where('notifiable_id', '=', $request->user()->id)
                ->where('type', '=', 'App\Notifications\Exercises\NewExercise')
                ->where('read_at', '=', null)
                ->get()
                ->count();
            $newMessages = DB::table('notifications')
                ->where('notifiable_id', '=', $request->user()->id)
                ->where('type', '=', 'App\Notifications\Messages\NewMessageForClient')
                ->where('read_at', '=', null)
                ->get()
                ->count();
            return view('sections.start', compact('posts', 'notifications', 'exercises', 'newMessages'));
        }
        if (isInstructor()) {
            $notifications = $request->user()->unreadNotifications;
            $clients = currentAuth()->clients()->count();
            $newMessages = DB::table('notifications')
                ->where('notifiable_id', '=', $request->user()->id)
                ->where('type', '=', 'App\Notifications\Messages\NewMessageForInstructor')
                ->where('read_at', '=', null)
                ->get()
                ->count();
            return view('sections.start', compact('clients', 'notifications', 'newMessages'));
        }
        return redirect()->route('dashboard.start');
    }
}
