<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Administrator;
use App\Models\Client;
use App\Models\Instructor;
use App\Notifications\Clients\DeletedClient;
use App\Notifications\Clients\RegisteredClient;
use App\Notifications\Clients\UpdatedClient;
use App\Repositories\ClientRepository;
use App\Utilities\Pagination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use App\Utilities\Validation\ClientValidation;
use Illuminate\Validation\Rule;
use App\Utilities\Notifications\NotifyUsers;
use Illuminate\Support\Collection as Collection;

class ClientsController extends Controller
{
    use Pagination, ClientValidation;

    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function showInstructorOfClient(Request $request)
    {
        $client = Client::find($request->user()->id);
        $instructor = $client->instructor;

        $messagesSentByUser = $client->messages()
            ->where('recipient_id', '=', $instructor->id)
            ->orderBy('created_at', 'asc')
            ->get();
        $messagesSentByInstructor = $instructor->messages()
            ->where('recipient_id', '=', $client->id)
            ->orderBy('created_at', 'asc')
            ->get();
        $messages = Collection::make([$messagesSentByUser, $messagesSentByInstructor])->collapse();
        $orderedMessages = $messages->sortBy('created_at');
        return view('sections.instructor', compact('orderedMessages'));
    }

    public function showClients()
    {
        return view('sections.admin.clients');
    }

    public function showClient(Client $client)
    {
        $quantityOfInvoices = $client->invoices()->count();
        $nextPaid = $client->invoices()
            ->select('id', 'due_date')
            ->where('status', '=', 'sin pagar')
            ->orWhere('status', '=', 'parcialmente pagada')
            ->orderBy('created_at', 'desc')
            ->first();
        $lastPaid = $client->invoices()
            ->select('id', 'paid_at')
            ->where('status', '=', 'pagada')
            ->orderBy('created_at', 'desc')
            ->first();
        //dd($quantityOfInvoices, $nextPaid, $lastPaid);
        return view('sections.admin.client', compact('quantityOfInvoices', 'lastPaid', 'nextPaid'));
    }

    public function showNewClientForm()
    {
        $instructors = Instructor::select('id', 'name', 'first_surname')->get();
        return view('sections.admin.create-client', compact('instructors'));
    }

    public function index(Request $request, ClientRepository $client)
    {
        if ($request->ajax()) {
            if ($request->has('page', 'quantity')) {
                if ($request->has('search')) {
                    $clients = $client->search(
                        $request->get('search'), $request->input('quantity', 10)
                    );
                } else {
                    $clients = $client->pagination($request->input('quantity'));
                }
                $response = $this->makePaginationArray($clients);
                return response()->json($response);
            }
            $clients = $client->getAll();
            return response()->json(['clients' => $clients]);
        }
        return redirect()->route('dashboard.start');
    }

    public function store(StoreClientRequest $request, ClientRepository $clientRepository)
    {
        if ($this->client->create($clientRepository->makeDataArray($request))) {
            $message = [
                'type'      => 'success',
                'content'   => 'Cliente registrado con exito.'
            ];
            $newClient = $this->client->where('email', '=', $request->input('email'))->first();
            Notification::send(Administrator::all(), new RegisteredClient($newClient));
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
        Notification::send(Administrator::all(), new UpdatedClient($this->client->find($id)));
        $edit = $this->client->find($id)->update($request->all());
        return response()->json($edit);
    }

    public function show(Request $request, Client $client)
    {
        if ($request->ajax()) {
            if (isAdmin() || currentAuth()->id === $client->id) {
                $response = [
                    'data' => [
                        'client' => $client,
                        'requested_instructor' => $client->instructor()->first()
                    ]
                ];
                return response()->json($response);
            }
        }
        return redirect()->route('dashboard.start');
    }

    public function destroy($id)
    {
        $client = $this->client->find($id);
        Notification::send(Administrator::all(), new DeletedClient($client));
        $client->delete();
        return response()->json(['message' => 'Cliente eliminado satisfactoriamente.']);
    }
}
