<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

// Helpers
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

// Mails
use App\Mail\NewPost;

// Models
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titleParam = request()->input('title');
        if (isset($titleParam)) {
            // SELECT * FROM posts WHERE title LIKE '%$titleParam%'  questo serve per filtrare.
            $posts = Post::where('title', 'LIKE', '%'.$titleParam.'%')->get();
        }
        else {
            $posts = Post::all();
        }

        return view('admin.posts.index', compact('posts'));
        // dd($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        if (array_key_exists('img', $data)) {
            $imgPath = Storage::put('posts', $data['img']);
            $data['img'] = $imgPath;
        }

        $data['slug'] = Str::slug($data['title']);
        // dd($data);
        $newPost = Post::create($data);

        $user = Auth::user();

        Mail::to([
            $user->email,
            'sergio@classe84.com', 
            'alessio@classe84.com'
        ])->send(new NewPost($newPost));

        return redirect()->route('admin.posts.show', $newPost->id)->with('success', 'Post aggiunto con successo!');

        //  ---------- ALTERNATIVA ----------
        // $slug = Str::slug($data['title']);

        // $newPost = Post::create([
        //     'title' => $data['title'],
        //     'slug' => $slug,
        //     'content' => $data['content']
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->validated();
        // dd($data);

        if (array_key_exists('delete_img', $data)) {
            if ($post->img) {
                // cancella il vecchio file
                Storage::delete($post->img);
                
                $post->img = null;
                $post->save();
            }
        }
        else if (array_key_exists('img', $data)) {
            $imgPath = Storage::put('posts', $data['img']);
            $data['img'] = $imgPath;

            if ($post->img) {
                // cancella il vecchio file
                Storage::delete($post->img);
            }
        }

        $data['slug'] = Str::slug($data['title']);

        $post->update($data);

        return redirect()->route('admin.posts.show', $post->id)->with('success', 'Post aggiornato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->img) {
            // cancella il vecchio file
            Storage::delete($post->img);
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Post eliminato con successo!');
    }
}
