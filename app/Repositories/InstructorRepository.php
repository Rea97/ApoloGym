<?php

namespace App\Repositories;

use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorRepository
{
    private $instructor;

    public function __construct(Instructor $instructor)
    {
        $this->instructor = $instructor;
    }

    public function getAll()
    {
        return $this->instructor->all();
    }

    public function pagination($quantity = 10)
    {
        return $this->instructor->latest()->paginate($quantity);
    }

    public function search($search, $paginate = 10)
    {
        return $this->instructor->where('name', 'LIKE', "%{$search}%")
            ->orWhere('first_surname', 'LIKE', "%{$search}%")
            ->orWhere('second_surname', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->paginate($paginate);
    }

    public function makeDataArray(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'first_surname' => $request->input('first_surname'),
            'second_surname' => $request->input('second_surname', null),
            'about_me' => $request->input('about_me', null),
            'gender' => $request->input('gender'),
            'birth_date' => $request->input('birth_date'),
            'profile_picture' => $request->input('profile_picture', null),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'salary' => $request->input('salary'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ];
    }

}