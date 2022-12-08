<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment as ResourcesComment;
use App\Http\Resources\Product as ResourcesProduct;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments=Comment::all();
        return response()->json(ResourcesComment::collection($comments), 200);
    }

    public function show(Product $product, Comment $comment)
    {
        return response()->json($comment,200);
    }
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'comment' => 'required|string'
         ]);
         $comment = $product->comments()->save(new Comment($request->all()));

        return response()->json(new ResourcesComment($comment), 201);
    }


    public function update(Request $request, Comment $comment)
    {
        //
    }

    public function delete(Comment $comment)
    {
        //
    }
}
