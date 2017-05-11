<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Exercise;
use App\Notifications\Exercises\NewExercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ExerciseController extends Controller
{
    public function showRoutineOfClient(Request $request)
    {
        $client = $request->user();
        $exercises = $client->exercises()->where('finish', '=', 0)->orderBy('created_at', 'desc')->get();
        //$exMon = $exercises->where()
        //$exercisesPerDay = Collection::make([$exMon, $exTue, $exWed, $exThu, $exFri, $exSat, $exSun]);

        return view('sections.routines', compact('exercises'));
    }

    public function exercisesOfClient(Client $client)
    {
        $exercises = $client->exercises()->orderBy('created_at', 'desc')->get();
        return view('sections.instructor.exerciseOfClient', compact('client', 'exercises'));
    }

    public function store(Request $request)
    {
        $message = [];
        $this->validate($request, [
            'client_id' => 'required|numeric',
            'name' => 'required',
            'worked_muscle' => 'required',
            'picture' => 'nullable|image',
            'reps' => 'required|numeric|integer',
            'sets' => 'required|numeric|integer',
            'weight' => 'required|numeric',
            'date' => 'required|date',
        ]);
        $success = Exercise::create($request->all());
        Notification::send(Client::find($request->client_id), new NewExercise());
        if ($request->has('picture')) {
            $exercise = Exercise::where('client_id', '=', $request->client_id)->orderBy('created_at', 'desc')->first();
            $file = $request->file('picture');
            $name = 'exercises/'.$exercise->id.'/'.$file->getClientOriginalName();
            dd($name);
            Storage::disk('public')->put($name, File::get($file));
            if ($file->isValid()) {
                $exercise->picture = $name;
                $exercise->save();
            }
        }
        $message['type'] = $success ? 'success' : 'error';
        $message['content'] = $success ? 'Ejercicio agregado correctamente.' : 'Ha habido un error al agregar ejercicio.';
        return redirect()->route('dashboard.exercisesOfClient', [$request->client_id])->with($message['type'], $message['content']);
    }

    public function delete(Request $request, Exercise $exercise)
    {
        if ($request->has('client_id')) {
            $success = $exercise->delete();
            $message['type'] = $success ? 'success' : 'error';
            $message['content'] = $success ? 'Ejercicio eliminado correctamente.' : 'Ha habido un error al eliminar ejercicio.';
            return redirect()->route('dashboard.exercisesOfClient', [$request->client_id])->with($message['type'], $message['content']);
        }
        return redirect()->route('dashboard.start');
    }

    public function check(Exercise $exercise)
    {
        $exercise->finish = 1;
        $success = $exercise->save();
        $message['type'] = $success ? 'success' : 'error';
        $message['content'] = $success ? 'Ejercicio marcado como finalizado.' : 'Ha habido un error al marcar como finalizado el ejercicio.';
        return redirect()->route('dashboard.routines')->with($message['type'], $message['content']);
    }

    public function uploadPicture(Request $request, Exercise $exercise)
    {
        if ($request->picture) {
            $file = $request->file('picture');
            $name = '/storage/exercise/'.$exercise->id.'/'.$file->getClientOriginalName();
            Storage::disk('public')->put($name, File::get($file));
            $exercise->picture = $name;
            return $exercise->save();
        }
        return false;
    }
}
