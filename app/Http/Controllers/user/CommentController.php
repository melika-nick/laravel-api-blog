<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post)
    {
        $post->comments()->create([
            'author_name' => $request->author_name,
            'body' => $request->body,
            'approved' => false,
        ]);

        return response()->json([
            'message' => 'Thank you! Your comment has been received and will appear once approved.'
        ]);
    }
}
