<?php

namespace App\Repositories;

use App\Models\Client;

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

}