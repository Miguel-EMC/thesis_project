<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
 //Funcion para verificar si el usuario tiene permiso para acceder a los comentarios
    //Se verifica si el usuario tiene el rol de customer
    //Si el usuario no tiene el rol de customer se le deniega el acceso
    //Si el usuario tiene el rol de customer se le permite el acceso
    public function __construct()
    {
        $this->middleware('can:create-comment');

        $this->authorizeResource(Comment::class, 'comment');
    }

    //Funcion para mostrar todos los comentarios  de un producto
    // Se recibe como parametro el id del producto
    public function index(Product $product)
    {
        //Se retorna la coleccion de comentarios del producto
        return $this->sendResponse(
            message: "Comments returned successfully", 
            code: 200,
            result: [
                'comments' => CommentResource::collection($product->comments->sortByDesc('created_at'))
            ]
        );
    }

    //Funcion para mostrar un comentario de un producto en especifico
    // Se recibe como parametro el id del producto y el id del comentario
    public function show(Product $product, Comment $comment)
    {
        $comment = $product->comments()->where('id', $comment->id)->firstOrFail();
        return $this->sendResponse(
            message: "Comment returned successfully",
            code: 200,
            result: [
                'comment' => new CommentResource($comment)
            ]
        );
    }

    //Funcion para crear un comentario
    // Se recibe como parametro el id del producto y los datos del comentario
    public function store(Request $request, Product $product)
    {

            $request->validate([
                'comment' => 'required|string'
            ]);
    
            $comment = $product->comments()->save(new Comment($request->all()));
            return $this->sendResponse(
                message: "Comment created successfully",
                code: 201,
                result: [
                    'comment' => new CommentResource($comment)
                ]
            );
    }
    
    //Funcion para actualizar un comentario
    // Se recibe como parametro el id del producto y el id del comentario
    public function update(Request $request, Product $product, Comment $comment)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);
        $comment = $product->comments()->where('id', $comment->id)->firstOrFail();
        $comment->update($request->all());
        return $this->sendResponse(
            message: "Comment updated successfully",
            code: 200,
            result: [
                'comment' => new CommentResource($comment)
            ]
        );
    }

    //Funcion para eliminar un comentario
    // Se recibe como parametro el id del producto y el id del comentario
    public function destroy(Product $product, Comment $comment)
    {
        $comment = $product->comments()->where('id', $comment->id)->firstOrFail();
        $comment->delete();
        return $this->sendResponse(
            message: "Comment deleted successfully",
            code: 200,
            result: []
        );
    }
}
