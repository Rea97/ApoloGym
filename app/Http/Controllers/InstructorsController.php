<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;
use App\Utilities\Pagination;

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
    public function __construct(Instructor $instructor)
    {
        $this->instructor = $instructor;
    }

    public function showInstructors()
    {
        return view('sections.admin.instructor');
    }

    public function showClientsInstructor()
    {
        return view('sections.instructor');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has(['page', 'quantity'])) {
                $instructors = $this->instructor->latest()->paginate($request->input('quantity', 10));
                $response = $this->makePaginationArray($instructors);
                return response()->json($response);
            }
            $instructors = $this->instructor->all();
            return response()->json(['data' => $instructors]);
        }
        return redirect()->route('dashboard.start');
    }



}
