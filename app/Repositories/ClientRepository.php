<?php

namespace App\Repositories;

use App\Models\Client;
use App\Models\Invoice;
use Illuminate\Http\Request;

class ClientRepository
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAll()
    {
        return $this->client->all();
    }

    public function pagination($quantity = 10)
    {
        return $this->client->latest()->paginate($quantity);
    }

    public function search($search, $paginate = 10)
    {
        return $this->client->where('name', 'LIKE', "%{$search}%")
            ->orWhere('first_surname', 'LIKE', "%{$search}%")
            ->orWhere('second_surname', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->paginate($paginate);
    }

    public function instructedBy($instructor)
    {
        return $this->client
            ->select('id', 'name', 'first_surname')
            ->where('instructor_id', '=', $instructor->id)->get();
    }

    public function makeDataArray(Request $request)
    {
        return [
            'instructor_id' => $request->input('instructor_id'),
            'name' => $request->input('name'),
            'first_surname' => $request->input('first_surname'),
            'second_surname' => $request->input('second_surname', null),
            'gender' => $request->input('gender'),
            'birth_date' => $request->input('birth_date'),
            'height' => $request->input('height'),
            'weight' => $request->input('weight'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'rfc' => $request->input('rfc', null),
            'profile_picture' => $request->input('profile_picture', null),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ];
    }

}