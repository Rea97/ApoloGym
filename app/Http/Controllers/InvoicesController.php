<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Repositories\InvoiceRepository;
use Illuminate\Http\Request;
use App\Utilities\Pagination;
use App\Models\Client;
use App\Models\Service;

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
        $this->validate($request, [
            'client_id' => 'required|integer',
            'due_date' => 'required|date|after:today',
            'services' => 'required|array'
        ]);
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
        $message = ['type' => 'success', 'content' => 'Factura creada con exito.'];
        return redirect()->route('dashboard.invoices')->with($message['type'], $message['content']);

    }
}
