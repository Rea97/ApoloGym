<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Http\Request;

class PostRepository
{
    private $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getAll()
    {
        return $this->post->all();
    }

    public function pagination($quantity = 10)
    {
        return $this->post->latest()->paginate($quantity);
    }

    public function search($search, $paginate = 10)
    {
        return $this->post->where('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->orWhere('created_at', 'LIKE', "%{$search}%")
            ->paginate($paginate);
    }
}