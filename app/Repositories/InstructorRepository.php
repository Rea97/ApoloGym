<?php
/**
 * Created by PhpStorm.
 * User: oziel
 * Date: 17/04/17
 * Time: 11:48 PM
 */

namespace App\Repositories;

use App\Models\Instructor;

class InstructorRepository
{
    private $instructor;

    public function __construct(Instructor $instructor)
    {
        $this->instructor = $instructor;
    }

    public function getAll()
    {
        return $this->instructor->all();
    }

    public function pagination($quantity = 10)
    {
        return $this->instructor->latest()->paginate($quantity);
    }

    public function search($search, $paginate = 10)
    {
        return $this->instructor->where('name', 'LIKE', "%{$search}%")
            ->orWhere('first_surname', 'LIKE', "%{$search}%")
            ->orWhere('second_surname', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->paginate($paginate);
    }

}