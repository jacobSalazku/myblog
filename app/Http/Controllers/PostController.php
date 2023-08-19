<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function deleteComment(Comment $comment)
    {
        // Assuming you have an authorization mechanism to check if the user can delete the comment.
        // For example, you can check if the authenticated user is the comment's author before allowing the deletion.
        if (auth()->check() && auth()->user()->id === $comment->user_id) {
            // Delete the comment.
            $comment->delete();
        } else {
            // If the user is not authorized to delete the comment, you can return a response indicating the error.
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Optionally, you can redirect the user back to the post after deleting the comment.
        return redirect()->route('posts.showpost', ['post' => $comment->post]);
    }

    public function comment(Request $request, Post $post)
    {
        $user = Auth::user();

        $comment = new Comment();
        $comment->content = $request->comment_content;
        $comment->user_id = $user->id;
        $comment->username = $user->name;   

        $post->comments()->save($comment);

        return redirect()->route('posts.showpost', $post);
    }
    
    public function like(Post $post)
    {

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

        $posts = Post::with('author')->orderBy('created_at', 'desc')->get();
     
        return view('dashboard', compact('posts'));
    }
    // method die de post neemt en in een nieuwe detail page zet
    public function show(Post $post)
    {
        
        return view('showpost', compact('post'));
    }


    
    
}
