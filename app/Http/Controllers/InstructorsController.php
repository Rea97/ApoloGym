<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorsController extends Controller
{
    public function showClientsInstructor()
    {
        return view('sections.instructor');
    }
}
