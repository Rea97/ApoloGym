<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Instructor;
use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use App\Utilities\Pagination;
use App\Repositories\InstructorRepository;

class InstructorsController extends Controller
{
    use Pagination;

    /**
     * @var Instructor
     */
    protected $instructor;

    /**
     * InstructorsController constructor.
     *
     * @param Instructor $instructor
     */
    public function __construct(InstructorRepository $instructor)
    {
        $this->instructor = $instructor;
    }

    public function showInstructor()
    {
        return view('sections.admin.instructor');
    }

    public function showInstructors()
    {
        return view('sections.admin.instructors');
    }

    public function showClientsInstructor()
    {
        return view('sections.instructor');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has(['page', 'quantity'])) {
                if ($request->search) {
                    $instructors = $this->instructor->search(
                        $request->get('search'), $request->input('quantity')
                    );
                } else {
                    $instructors = $this->instructor->pagination($request->input('quantity'));
                }
                $response = $this->makePaginationArray($instructors);
                return response()->json($response);
            }
            $instructors = $this->instructor->getAll();
            return response()->json(['data' => $instructors]);
        }
        return redirect()->route('dashboard.start');
    }

    public function show(Request $request, Instructor $instructor)
    {
        if ($request->ajax()) {
            return response()->json([
                'data' => [
                    'instructor' => $instructor
                ]
            ]);
        }
        return redirect()->route('dashboard.start');
    }

    public function showClientsInstructedBy(Request $request, Instructor $instructor, ClientRepository $client)
    {
        if ($request->ajax()) {
            $clients = $client->instructedBy($instructor);
            return response()->json([
                'data' => [
                    'clients' => $clients
                ]
            ]);
        }
        return redirect()->route('dashboard.start');
    }

}
