<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Income;
use App\Models\Invoice;
use App\Notifications\Invoices\ChangedInvoiceStatus;
use App\Repositories\InvoiceRepository;
use Illuminate\Http\Request;
use App\Utilities\Pagination;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Support\Facades\Notification;
use Illuminate\Validation\Rules\In;
use Illuminate\Support\Facades\Validator;
use App\Notifications\Invoices\CreatedInvoice;
use Carbon\Carbon;

class InvoicesController extends Controller
{
    use Pagination;

    private $invoice;

    private $invoiceRepository;

    public function __construct(Invoice $invoice, InvoiceRepository $invoiceRepository)
    {
        $this->invoice = $invoice;
        $this->invoiceRepository = $invoiceRepository;
    }

    public function showInvoices()
    {
        return view('sections.admin.invoices');
    }

    public function showInvoice()
    {
        return view('sections.admin.invoice');
    }

    public function showNewInvoiceForm(Request $request)
    {
        $client_id = $request->get('cliente');
        $clients = Client::select('id', 'name', 'first_surname')->get();
        $services = Service::all();
        return view('sections.admin.create-invoice', compact('clients', 'services', 'client_id'));
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('page', 'quantity')) {
                if ($request->has('search')) {
                    $invoices = $this->invoiceRepository->search(
                        $request->get('search'), $request->input('quantity', 10)
                    );
                } else {
                    $invoices = $this->invoiceRepository->pagination($request->input('quantity'));
                }
                $response = $this->makePaginationArray($invoices);
                $response['clients'] = Client::select('id', 'name', 'first_surname')->get();
                //array_merge($response, $clients);
                return response()->json($response);
            }
            $invoices = $this->invoiceRepository->getAll();
            return response()->json(['data' => $invoices]);
        }
        return redirect()->route('dashboard.start');
    }

    public function store(Request $request)
    {
        $messages = [
            'after' => 'El campo :attribute debe ser una fecha posterior al día de hoy.',
        ];
        $rules = [
            'client_id' => 'required|integer',
            'due_date' => 'required|date|after:today',
            'services' => 'required|array'
        ];
        Validator::make($request->all(), $rules, $messages)->validate();
        $total = 0.0;
        $servicesId = $request->input('services');
        $invoice = new Invoice([
            'client_id' => $request->input('client_id'),
            'due_date' => $request->input('due_date')
        ]);
        for ($i = 0; $i < count($servicesId); $i++) {
            $service = Service::find($servicesId[$i]);
            $total += $service->price;
        }
        $invoice->total = $total;
        $invoice->save();
        $invoice->services()->attach($servicesId);
        Notification::send(Administrator::all(), new CreatedInvoice(Invoice::findOrFail($invoice->id)));
        $message = ['type' => 'success', 'content' => 'Factura creada con exito.'];
        return redirect()->route('dashboard.invoices')->with($message['type'], $message['content']);

    }

    public function show(Request $request, Invoice $invoice)
    {
        if ($request->ajax()) {
            $client = Client::find($invoice->client_id);
            $services = $invoice->services;
            return response()->json([
                'invoice' => $invoice,
                'client' => $client,
                'services' => $services
            ]);
        }
        return redirect()->route('dashboard.start');
    }

    public function update(Request $request, Invoice $invoice)
    {
        if ($request->has('client_id') && $request->has('services')) {
            $this->validate($request, [
                'client_id' => 'required|integer',
                'due_date' => 'required|date|after:today',
                'services' => 'required|array'
            ]);
            $total = $invoice->total;
            $servicesIds = $request->input('services');
            $invoice->update(['client_id' => $request->input('client_id'), 'due_date' => $request->input('due_date')]);
            foreach ($servicesIds as $service) {
                if (! $invoice->services->contains($service)) {
                    $invoice->services()->attach($service);
                    $total += Service::find($service)->price;
                }
            }
            $invoice->total = $total;
            $invoice->save();
            //$invoice->update(['total' => $total]);
            return response()->json(['message' => "Datos de la factura guardados con éxito."]);
        }
        $invoice->status = $request->input('status', 'cancelada');
        $invoice->save();
        if ($invoice->status === 'pagada') {
            Income::create(['type' => 'facturas',
                'description' => 'Pago de factura realizado',
                'entry_date' => Carbon::now()->toDateString(),
                'total' => $invoice->total
            ]);
        }
        Notification::send(Administrator::all(), new ChangedInvoiceStatus($invoice, $invoice->status));
        return response()->json(['message' => "El estado de la factura ha cambiado a {$request->input('status')}."]);
    }
}
