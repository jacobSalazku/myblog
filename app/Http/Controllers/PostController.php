<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;

class PostController extends Controller
{
    
    public function like(Post $post)
    {

        //checks if the user has already liked the message by seeing if a record exists 
       // in the like table with both the ID of the message and the ID of the current user.
    //If the user has already liked the message, the code removes the corresponding like 
    //record from the like table. Otherwise, it creates a new like record in the like table
    // with the ID of the user and the ID of the message.
        if ($post->likes()->where('user_id', auth()->id())->exists()) {
            $post->likes()->where('user_id', auth()->id())->delete();
        } else {
            $post->likes()->create(['user_id' => auth()->id()]);
        }
    
        return back();
    }

    public function update(Request $request, Post $post)
    {
    // update the post with the new values
    $post->title = $request->title;
    $post->content = $request->content;
    $post->save();

    // Generate a cache-busting parameter based on the current timestamp
    $cache_buster = '?v=' . time();

    // Redirect to the dashboard with the cache-busting parameter
    return redirect('/' . $cache_buster);
    }   
    // add posts form
    public function submit(Request $request)
    {
        $user_id = auth()->id();

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->author_id = $user_id;

        $post->save();

            // Generate a cache-busting parameter based on the current timestamp
        $cache_buster = '?v=' . time();

        // Redirect to the dashboard with the cache-busting parameter
        return redirect('/' . $cache_buster);
    }

    public function index()
    {

        $posts = Post::latest()->get();
     
        return view('dashboard', compact('posts'));
    }
    // method die de post neemt en in een nieuwe detail page zet
    public function show(Post $post)
    {
        
        return view('showpost', compact('post'));
    }


    
}
