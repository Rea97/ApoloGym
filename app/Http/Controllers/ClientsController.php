<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index()
    {
        $clients = Client::paginate(10);
        return view('sections.admin.clients', compact('clients'));
    }

    public function store(Request $request)
    {
        $this->validate($request, []);
        $message = Client::create($request->all())
            ? 'Cliente registrado con exito.'
            : 'Ha ocurrido un error al registrar al cliente.';
        return redirect()
            ->route('dashboard.clients')
            ->with(['message' => $message]);
    }

    public function show(Client $client)
    {
        return view('sections.admin.client', compact('client'));
    }
}
