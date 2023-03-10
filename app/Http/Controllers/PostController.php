<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $posts = Post::with('users')->orderByDesc('created_at')->get();
        $login_user = Auth::user();
        $users = User::with('roles')->get();
        //print_r($users[0]->roles);
        //dd($users[0]->roles);
        return view('posts.index', compact(['posts','login_user','users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $posts = Post::all();
        $users = User::with('roles')->get();
        return view('posts.create', compact(['posts','users']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $login_user = Auth::user();
        //echo $login_user->id;

        //dd($request);

        $request->validate([
           'title' => 'required',
           'contents' => 'required',
        ]);

        $post = new Post;
        $post->title = $request->title;
        $post->contents = $request->contents;
        $post->img_url = $request->img_url;
        $post->created_by = $login_user->id;
        $post->save();

        return redirect(route('posts.index'))->with('status','Post added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Post $post)
    {
        $users = User::with('roles')->get();
        return view('posts.edit', compact(['post','users']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Post $post)
    {
        //dd($request);

        $request->validate([
            'title' => 'required',
            'contents' => 'required',
        ]);

        $post->title = $request->title;
        $post->contents = $request->contents;
        $post->img_url = $request->img_url;
        //$post->created_by = $login_user->id;
        $post->save();

        return redirect(route('posts.index'))->with('status','Post updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Post $post)
    {
        $post->delete();
        $post->save();

        return redirect(route('posts.index'))->with('status', 'Post Deleted');
    }
}
