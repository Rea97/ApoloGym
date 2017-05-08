<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use App\Models\Client;
use App\Models\Instructor;
use App\Notifications\Posts\CreatedPost;
use App\Notifications\Posts\DeletedPost;
use App\Notifications\Posts\UpdatedPost;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use App\Utilities\Pagination;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    use Pagination;

    private $post;
    private $postRepository;

    public function __construct(Post $post, PostRepository $postRepository)
    {
        $this->post = $post;
        $this->postRepository = $postRepository;
    }

    public function allPosts()
    {
        return view('sections.posts');
    }

    public function create()
    {
        return view('sections.create-post');
    }

    public function index(Request $request)
    {
        if (! $request->ajax()) {
            return redirect()->route('dashboard.start');
        }
        if ($request->has('page', 'quantity')) {
            if ($request->has('search')) {
                $posts = $this->postRepository->search(
                    $request->get('search'), $request->input('quantity', 10)
                );
            } else {
                $posts = $this->postRepository->pagination($request->input('quantity'));
            }
            $response = $this->makePaginationArray($posts);
            return response()->json($response);
        }
        $posts = $this->postRepository->getAll();
        return response()->json(['posts' => $posts]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:50|string|unique:posts',
            'image' => 'nullable|image',
            'description' => 'required|max:255|string',
            'content' => 'required|string'
        ]);
        Post::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'content' => $request->input('content')
        ]);
        $post = Post::where('title', '=', $request->title)->first();
        Notification::send(Administrator::all(), new CreatedPost($post));
        Notification::send(Client::all(), new CreatedPost($post));
        Notification::send(Instructor::all(), new CreatedPost($post));
        if ($request->image) {
            $postId = $post->id;
            $file = $request->file('image');
            $name = '/posts/'.$postId.'/image/'.$file->getClientOriginalName();
            Storage::disk('public')->put($name, File::get($file));
            $post->image = $name;
            $post->save();
        }
        return redirect()->route('dashboard.posts');
    }

    public function show(Post $post)
    {
        return view('sections.post', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => [
                'required',
                'string',
                'max:50',
                Rule::unique('posts')->ignore($post->id)
            ],
            'image' => 'nullable|image',
            'description' => 'required|max:255|string',
            'content' => 'required|string'
        ]);
        $post->update($request->only(['title', 'description', 'content']));
        Notification::send(Administrator::all(), new UpdatedPost($post));
        if ($request->image) {
            $postId = $post->id;
            $file = $request->file('image');
            $name = '/posts/'.$postId.'/image/'.$file->getClientOriginalName();
            Storage::disk('public')->put($name, File::get($file));
            $post->image = $name;
            $post->save();
        }
        return redirect()
            ->route('dashboard.posts.show', [$post->id])
            ->with('success', 'Contenido de noticia modificado correctamente.');
    }

    public function delete(Request $request, Post $post)
    {
        Notification::send(Administrator::all(), new DeletedPost($post));
        Notification::send(Instructor::all(), new DeletedPost($post));
        $post->delete();
        if ($request->ajax()) {
            return response()->json(['message' => 'Noticia eliminada correctamente.']);
        }
        return redirect()->route('dashboard.posts');
    }

    public function showBlogPost(Post $post)
    {
        $months = [
            1 => 'enero',2 => 'febrero',3 => 'marzo',4 => 'abril',5 => 'mayo',6 => 'junio',7 => 'julio',8 => 'agosto',9 => 'septiembre',10 => 'octubre',11 => 'noviembre',12 => 'diciembre'
        ];
        $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at);
        return view('sections.blog-post', compact('post', 'months', 'date'));
    }
}
