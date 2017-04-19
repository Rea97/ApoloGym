<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Instructor;
use App\Repositories\ClientRepository;
use App\Utilities\Pagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Utilities\Validation\ClientValidation;
use Illuminate\Validation\Rule;

class ClientsController extends Controller
{
    use Pagination, ClientValidation;

    protected $client;

    protected $client_r;

    public function __construct(Client $client, ClientRepository $clientRepository)
    {
        $this->client = $client;
        $this->client_r = $clientRepository;
    }

    public function showClients()
    {
        return view('sections.admin.clients');
    }

    public function showClient()
    {
        return view('sections.admin.client');
    }

    public function showNewClientForm()
    {
        $instructors = Instructor::select('id', 'name', 'first_surname')->get();
        return view('sections.admin.create-client', compact('instructors'));
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('page', 'quantity')) {
                if ($request->has('search')) {
                    $clients = $this->client_r->search(
                        $request->get('search'), $request->input('quantity', 10)
                    );
                } else {
                    $clients = $this->client_r->pagination($request->input('quantity'));
                }
                $response = $this->makePaginationArray($clients);
                return response()->json($response);
            }
            $clients = $this->client_r->getAll();
            return response()->json(['data' => $clients]);
        }
        return redirect()->route('dashboard.start');
    }

    public function store(StoreClientRequest $request)
    {
        if ($this->client->create($request->except('password_confirmation'))) {
            $message = [
                'type'      => 'success',
                'content'   => 'Cliente registrado con exito.'
            ];
        } else {
            $message = [
                'type'      => 'error',
                'content'   => 'Ha ocurrido un error al registrar al cliente.'
            ];
        }
        return redirect()->route('dashboard.clients')->with($message['type'], $message['content']);
    }

    public function update(UpdateClientRequest $request, $id)
    {
        /*
         * Debido a que usando un request, al fallar la validación, solo retorna un
         * error 422 Unprocessable Entity, se deberá realizar la validación también
         * nivel client side, otra opcion es modificar el trait ClientValidation
         * e inyectar en el constructor el objeto Request y usar el siguiente metodo
         * que está comentado, para de esa forma, retornar los errores en la petición ajax
            $validation = Validator::make($request->all(), $this->getRules());
            if ($validation->fails()) {
                return response()->json(['errors' => $validation->errors()]);
            }
        */
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
