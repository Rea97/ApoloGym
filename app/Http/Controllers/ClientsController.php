<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $clients = Client::latest()->paginate(10);
            $response = [
                'pagination' => [
                    'total' => $clients->total(),
                    'per_page' => $clients->perPage(),
                    'current_page' => $clients->currentPage(),
                    'last_page' => $clients->lastPage(),
                    'from' => $clients->firstItem(),
                    'to' => $clients->lastItem()
                ],
                'data' => $clients
            ];
            return response()->json($response);
        }
        $clients = Client::latest()->paginate(10);
        return view('sections.admin.clients', compact('clients'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|max:40|string',
            'instructor_id' => 'required|integer',
            'first_surname' => 'required|max:40|string',
            'second_surname'=> 'max:40|string|nullable',
            'gender'        => 'required|max:1|string',
            'birth_date'    => 'required|date',
            'height'        => 'required|integer|between:120,220',
            'weight'        => 'required|between:40,250',
            'phone_number'  => 'required|string',
            'address'       => 'required|string|max:100',
            'rfc'           => 'alpha_num|max:30',
            'email'         => 'required|email|max:255|unique:clients',
            'password'      => 'required|min:6|confirmed'
        ]);
        $message = Client::create($request->all())
            ? 'Cliente registrado con exito.'
            : 'Ha ocurrido un error al registrar al cliente.';
        return redirect()->route('dashboard.clients')->with($message);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'          => 'required|max:40|string',
            'instructor_id' => 'required|integer',
            'first_surname' => 'required|max:40|string',
            'second_surname'=> 'max:40|string|nullable',
            'gender'        => 'required|max:1|string',
            'birth_date'    => 'required|date',
            'height'        => 'required|integer|between:120,220',
            'weight'        => 'required|between:40,250',
            'phone_number'  => 'required|string',
            'address'       => 'required|string|max:100',
            'rfc'           => 'alpha_num|max:30',
            'email'         => 'required|email|max:255|unique:clients',
            'password'      => 'required|min:6|confirmed'
        ]);
        $edit = Client::find($id)->update($request->all());
        return response()->json($edit);
    }

    public function show(Client $client)
    {
        return view('sections.admin.client', compact('client'));
    }

    public function destroy($id)
    {
        Client::find($id)->delete();
        return response()->json(['message' => 'Cliente eliminado satisfactoriamente.']);
    }
}
