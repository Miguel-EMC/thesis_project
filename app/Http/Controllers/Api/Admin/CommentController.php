<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:view-comment');

    }

    //Funcion para mostrar todos los comentarios registrados en la base de datos
    public function index()
    {
        $this->authorize('viewAll', Comment::class);

        return $this->sendResponse(
            message: "Comments returned successfully",
            code: 200,
            result: [
                'comments' => Comment::all(),
            ]
        );
    }

    //Funcion para mostrar un comentario en especifico
    public function show(Comment $comment)
    {
        return $this->sendResponse(
            message: "Comment returned successfully",
            code: 200,
            result: [
                'comment' => $comment,
            ]
        );
    }

    //Funcion para eliminar un comentario de la base de datos
    public function destroy(Comment $comment)
    {
        $comment->delete();

        return $this->sendResponse(
            message: "Comment deleted successfully",
            code: 200,
            result: [
            ]
        );
    }
}
