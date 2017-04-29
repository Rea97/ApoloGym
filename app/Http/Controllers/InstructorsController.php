<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructorRequest;
use App\Http\Requests\UpdateInstructorRequest;
use App\Models\Administrator;
use App\Models\Client;
use App\Models\Instructor;
use App\Models\InstructorSchedule;
use App\Notifications\Instructors\DeletedInstructor;
use App\Notifications\Instructors\RegisteredInstructor;
use App\Notifications\Instructors\UpdatedInstructor;
use App\Repositories\ClientRepository;
use App\Repositories\InstructorScheduleRepository;
use Illuminate\Http\Request;
use App\Utilities\Pagination;
use App\Repositories\InstructorRepository;
use Illuminate\Support\Facades\Notification;

class InstructorsController extends Controller
{
    use Pagination;

    /**
     * @var Instructor
     */
    protected $instructor;

    /**
     * @var InstructorSchedule
     */
    protected $instructorSchedule;

    /**
     * InstructorsController constructor.
     *
     * @param InstructorRepository         $instructor
     * @param InstructorScheduleRepository $instructorSchedule
     */
    public function __construct(InstructorRepository $instructor, InstructorScheduleRepository $instructorSchedule)
    {
        $this->instructor = $instructor;
        $this->instructorSchedule = $instructorSchedule;
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

    public function showNewInstructorForm()
    {
        //TODO: pendiente de modificación la vista
        return view('sections.admin.create-instructor');
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
            $schedule = $this->instructorSchedule->scheduleOf($instructor)->toArray();
            return response()->json([
                'data' => [
                    'instructor' => $instructor,
                    'schedule' => $this->instructorSchedule->makeScheduleArray($schedule)
                ]
            ]);
        }
        return redirect()->route('dashboard.start');
    }

    public function store(StoreInstructorRequest $request, Instructor $instructor)
    {
        if ($instructor->create($this->instructor->makeDataArray($request))) {
            $newInstructor = $instructor->where('email', '=', $request->input('email'))->first();
            Notification::send(Administrator::all(), new RegisteredInstructor($newInstructor));
            if ($this->instructorSchedule->storeSchedule($request, $newInstructor)) {
                $message = [
                    'type' => 'success',
                    'content' => 'Instructor registrado con exito.'
                ];
            } else {
                $message = [
                    'type' => 'error',
                    'content' => 'Ha ocurrido un error al registrar al instructor.'
                ];
            }
        }
        return redirect()->route('dashboard.instructors')->with($message['type'], $message['content']);
    }

    public function update(UpdateInstructorRequest $request, Instructor $instructor)
    {
        $edit = $instructor->update($request->all());
        Notification::send(Administrator::all(), new UpdatedInstructor($instructor));
        return response()->json($edit);

    }

    public function updateSchedule(Request $request, Instructor $instructor, InstructorSchedule $instructorSchedule)
    {
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        for ($i = 0; $i < 7; $i++) {
            $instructorSchedule->where('instructor_id', '=', $instructor->id)
                ->where('day', '=', $i + 1)->first()->update([
                    'from' => $request->input($days[$i].'-from', null),
                    'to' => $request->input($days[$i].'-to', null),
                    'hours' => getHoursDiff(
                        $request->input($days[$i].'-from', null),
                        $request->input($days[$i].'-to', null)
                    )
                ]);
        }
        return response()->json(['success' => 'Se ha modificado el registro exitosamente']);
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

    public function destroy(Client $client, Instructor $instructor)
    {
        $clientsInstructedBy = $client->where('instructor_id', '=', $instructor->id)->get();
        if ($clientsInstructedBy->isEmpty()) {
            Notification::send(Administrator::all(), new DeletedInstructor($instructor));
            $instructor->delete();
            return response()->json(['message' => 'Instructor eliminado satisfactoriamente.']);
        }
        $message = 'Antes de proceder con la eliminación, asegurate de cambiar de instructor a los clientes que instruye ';
        $message .= $instructor->name.' '.$instructor->first_surname;
        $message .= ' Puede que después de la eliminación, necesite recargar la página para ver los cambios';
        return response()->json(['error' => $message]);

    }

}
