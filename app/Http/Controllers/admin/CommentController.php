<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('post')->latest()->get();
        return response()->json([
            'comments' => $comments
        ]);
    }
    public function approve(Comment $comment)
    {
        $comment->update([
            'approved' => true
        ]);
        return response()->json([
            'message' => 'Comment approved successfully.'
        ]);
    }
}
