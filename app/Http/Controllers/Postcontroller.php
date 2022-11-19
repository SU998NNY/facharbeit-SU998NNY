<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class Postcontroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
        return view('posts.index', [
            'posts' => Post::latest()->filter(
                        request(['search', 'category', 'author'])
                    )->paginate(18)->withQueryString()
        ]);
        
        //$posts = Post::paginate(5);

    //dd($posts);

    return view('home',

        [ 'posts' => $posts ]

    );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post          = new Post();
        $post->title   = $request->input ('title');
        $post->lead    = $request->input ('lead');
        $post->content = $request->input ('content');
        $post->user_id = 1;
        $post->image   = "https://via.placeholder.com/900x400.png/001166?text=eum";
        $post->save();

        return redirect('/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
            //dd($post);
    return view('post', ['post' => $post ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store()
    {

        $attributes = request()->validate([
    
          'title' => 'required',

          'thumbnail' => 'required|image',

          'slug' => ['required', Rule::unique('posts', 'slug')],
    
          'excerpt' => 'required',
    
          'body' => 'required',
    
          'category_id' => ['required', Rule::exists('categories', 'id')]
    
     ]);
    
     $attributes['user_id'] = auth()->id();
     $attributes['thumbnail'] = request()->file('thumbnail')->store('thumbnails');
     
    Post::create($attributes);
    
    return redirect('/');

    }

}
