<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Utilities\Pagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ClientsController extends Controller
{
    use Pagination;

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function showClients()
    {
        return view('sections.admin.clients');
    }

    public function showClient()
    {
        return view('sections.admin.client');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $clients = $this->client->latest()->paginate($request->quantity);
            $response = $this->makePaginationArray($clients);
            return response()->json($response);
        }
        return redirect()->route('dashboard.start');
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
        $message = $this->client->create($request->all())
            ? 'Cliente registrado con exito.'
            : 'Ha ocurrido un error al registrar al cliente.';
        return redirect()->route('dashboard.clients')->with($message);
    }

    public function update(Request $request, $id)
    {
        /*$this->validate($request, [
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
        ]);*/
        $validation = Validator::make($request->all(), [
            'name'          => 'required|max:40|string',
            'instructor_id' => 'required|integer',
            'first_surname' => 'required|max:40|string',
            'second_surname'=> 'max:40|string|nullable',
            'gender'        => 'required|max:1|string',
            'birth_date'    => 'required|date',
            'height'        => 'required|integer|between:120,220',
            'weight'        => 'required',
            'phone_number'  => 'required|string',
            'address'       => 'required|string|max:100',
            'rfc'           => 'alpha_num|max:30',
            'profile_picture'=> 'nullable|string',
            //'password'      => 'required|min:6|confirmed',
            'email'         => [
                'required',
                'email',
                'max:255',
                Rule::unique('clients')->ignore($id)
            ]
        ]);
        if ($validation->fails()) {
            return response()->json(['errors' => $validation->errors()]);
        }
        $edit = $this->client->find($id)->update($request->all());
        return response()->json($edit);
    }

    public function show(Request $request, Client $client)
    {
        if ($request->ajax()) {
            $response = [
                'data' => [
                    'client' => $client,
                    'requested_instructor' => $client->instructor()->first()
                ]
            ];
            return response()->json($response);
        }
        return redirect()->route('dashboard.start');
    }

    public function destroy($id)
    {
        $this->client->find($id)->delete();
        return response()->json(['message' => 'Cliente eliminado satisfactoriamente.']);
    }
}
