<?php

namespace App\Repositories;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceRepository
{
    private $invoice;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function getAll()
    {
        return $this->invoice->all();
    }

    public function pagination($quantity = 10)
    {
        return $this->invoice->latest()->paginate($quantity);
    }

    public function search($search, $paginate = 10)
    {
        return $this->invoice
            ->where('client_id', $search)
            ->orWhere('status', $search)
            ->orWhere('due_date', 'LIKE', "%{$search}%")
            ->paginate($paginate);
    }

    public function makeDataArray(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price')
        ];
    }

    public function invoicesWithServices()
    {
        return $this->invoice->with('services')->get();
    }
}