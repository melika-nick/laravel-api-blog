<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $comments = Comment::all();
        return response()->json([
            'posts' => $posts,
            'comments' => $comments
        ]);
    }
}
