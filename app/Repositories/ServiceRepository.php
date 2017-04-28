<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceRepository
{
    private $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    public function getAll()
    {
        return $this->service->all();
    }

    public function pagination($quantity = 10)
    {
        return $this->service->latest()->paginate($quantity);
    }

    public function search($search, $paginate = 10)
    {
        return $this->service->where('name', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhere('price', 'LIKE', "%{$search}%")
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
}