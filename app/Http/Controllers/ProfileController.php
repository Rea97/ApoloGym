<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Client;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Notifications\Profile\ProfileUpdated;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Notifications\Profile\ProfilePictureUpdated;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view('sections.profile');
    }

    public function updateClient(Request $request, Client $client)
    {
        $v = Validator::make($request->all(), [
            'name'              => 'required|max:40|string',
            'first_surname'     => 'required|max:40|string',
            'second_surname'    => 'nullable|max:40|string',
            //'profile_picture'   => 'nullable|string',
            'phone_number'      => 'required|string',
            'address'           => 'required|string|max:100',
            'rfc'               => 'nullable|alpha_num|max:30',
            'email'             => [
                'required',
                'email',
                'max:255',
                Rule::unique('clients')->ignore($request->id)
            ],
            'password' => 'nullable|min:6|confirmed'
        ]);
        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()]);
        }
        /*$this->validate($request, [
            'name'              => 'required|max:40|string',
            'first_surname'     => 'required|max:40|string',
            'second_surname'    => 'nullable|max:40|string',
            'profile_picture'   => 'nullable|string',
            'phone_number'      => 'required|string',
            'email'             => [
                'required',
                'email',
                'max:255',
                Rule::unique('administrators')->ignore($request->id)
            ],
            'password' => 'required|min:6|confirmed'
        ]);*/
        $updated = $client->update([
            'name' => $request->input('name'),
            'first_surname' => $request->input('first_surname'),
            'second_surname' => $request->input('second_surname'),
            'address' => $request->input('address'),
            'rfc' => $request->input('rfc'),
            //'profile_picture' => $request->input('profile_picture'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email')
        ]);
        if ($request->has('password')) {
            $updated = $client->update([
                'password' => bcrypt($request->input('password'))
            ]);
        }
        if ($updated) {
            Notification::send($client, new ProfileUpdated($client));
        }
        return response()->json(['updated' => $updated]);
    }

    public function updateInstructor(Request $request, Instructor $instructor)
    {
        $v = Validator::make($request->all(), [
            'name'              => 'required|max:40|string',
            'first_surname'     => 'required|max:40|string',
            'second_surname'    => 'nullable|max:40|string',
            //'profile_picture'   => 'nullable|string',
            'about_me'          => 'nullable|string',
            'phone_number'      => 'required|string',
            'address'           => 'required|string|max:100',
            'email'             => [
                'required',
                'email',
                'max:255',
                Rule::unique('instructors')->ignore($request->id)
            ],
            'password' => 'nullable|min:6|confirmed'
        ]);
        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()]);
        }
        /*$this->validate($request, [
            'name'              => 'required|max:40|string',
            'first_surname'     => 'required|max:40|string',
            'second_surname'    => 'nullable|max:40|string',
            'profile_picture'   => 'nullable|string',
            'phone_number'      => 'required|string',
            'email'             => [
                'required',
                'email',
                'max:255',
                Rule::unique('administrators')->ignore($request->id)
            ],
            'password' => 'required|min:6|confirmed'
        ]);*/
        $updated = $instructor->update([
            'name' => $request->input('name'),
            'first_surname' => $request->input('first_surname'),
            'second_surname' => $request->input('second_surname'),
            'address' => $request->input('address'),
            'about_me' => $request->input('about_me', null),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email')
        ]);
        if ($request->has('password')) {
            $updated = $instructor->update([
                'password' => bcrypt($request->input('password'))
            ]);
        }
        if ($updated) {
            Notification::send($instructor, new ProfileUpdated($instructor));
        }
        return response()->json(['updated' => $updated]);
    }

    public function updateAdmin(Request $request, Administrator $administrator)
    {
        $v = Validator::make($request->all(), [
            'name'              => 'required|max:40|string',
            'first_surname'     => 'required|max:40|string',
            'second_surname'    => 'nullable|max:40|string',
            //'profile_picture'   => 'nullable|string',
            'phone_number'      => 'required|string',
            'email'             => [
                'required',
                'email',
                'max:255',
                Rule::unique('administrators')->ignore($request->id)
            ],
            'password' => 'nullable|min:6|confirmed'
        ]);
        if ($v->fails()) {
            return response()->json(['errors' => $v->errors()]);
        }
        /*$this->validate($request, [
            'name'              => 'required|max:40|string',
            'first_surname'     => 'required|max:40|string',
            'second_surname'    => 'nullable|max:40|string',
            'profile_picture'   => 'nullable|string',
            'phone_number'      => 'required|string',
            'email'             => [
                'required',
                'email',
                'max:255',
                Rule::unique('administrators')->ignore($request->id)
            ],
            'password' => 'required|min:6|confirmed'
        ]);*/
        $updated = $administrator->update([
            'name' => $request->input('name'),
            'first_surname' => $request->input('first_surname'),
            'second_surname' => $request->input('second_surname'),
            //'profile_picture' => $request->input('profile_picture'),
            'phone_number' => $request->input('phone_number'),
            'email' => $request->input('email')
        ]);
        if ($request->has('password')) {
            $updated = $administrator->update([
                'password' => bcrypt($request->input('password'))
            ]);
        }
        if ($updated) {
            Notification::send($administrator, new ProfileUpdated($administrator));
        }
        return response()->json(['updated' => $updated]);
    }

    public function updatePP(Request $request)
    {
        $message = 'No has subido ninguna foto.';
        if ($request->profile_picture) {
            $this->validate($request, [
                'profile_picture' => 'required|image'
            ]);
            if ($request->user()->profile_picture) {
                Storage::disk('public')->delete($request->user()->profile_picture);
            }
            $user = $request->user();
            $userId = $user->id;
            $file = $request->file('profile_picture');
            $name = $userId.'/profile_picture/'.$file->getClientOriginalName();
            Storage::disk('public')->put($name, File::get($file));
            if ($file->isValid()) {
                $user->profile_picture = $name;
                $user->save();
                Notification::send($request->user(), new ProfilePictureUpdated($request->user()));
                $message = 'Foto de perfil actualizada correctamente.';
            } else {
                $message = 'Ha ocurrido un error al intentar actualizar tú foto de perfil. ';
                $message .= 'Intenta de nuevo más tarde.';
            }
        }
        return response()->json(['message' => $message]);
    }

    public function deletePP(Request $request)
    {
        $message['content'] = "No dispones de una foto de perfil que eliminar.";
        $message['type'] = 'error';
        if ($request->user()->profile_picture) {
            Storage::disk('public')->delete($request->user()->profile_picture);
            $request->user()->profile_picture = null;
            $request->user()->save();
            $message['content'] = "Foto de perfil eliminada correctamente.";
            $message['type'] = 'success';
        }
        return response()->json([
            'type' => $message['type'],
            'message' => $message['content']
        ]);
    }


}
