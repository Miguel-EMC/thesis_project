<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function __construct(){
        $this->middleware('can:manage-category');
    }

    //Funcion para mostrar todas las categorias registradas en la base de datos
    public function index()
    {
        $categories = Categorie::all();
        return $this->sendResponse(
            message: "Categories returned successfully",
            code: 200,
            result: [
                'categories' => $categories,
            ]
        );
    }

    //Funcion para mostrar una categoria en especifico
    public function show(Categorie $categorie)
    {
        return $this->sendResponse(
            message: "Category returned successfully",
            code: 200,
            result: [
                'categorie' => $categorie,
            ]
        );
    }

    //Funcion para crear una categoria en la base de datos
    public function store(Request $request)
    {
        //Se valida la informacion de la categoria
        $request->validate([
            'name' => 'required|unique:categories|max:255',
            'imagen' => 'required'
        ]);

        //Se crea la categoria
        $categorie = Categorie::create($request->all());

        //Se retorna la categoria creada
        return $this->sendResponse(
            message: "Category created successfully",
            code: 201,
            result: [
                'categorie' => $categorie,
            ]
        );
    }

    //Funcion para actualizar una categoria en la base de datos
    public function update(Request $request, Categorie $categorie)
    {
        //Se valida la informacion de la categoria
        $request->validate([
            'name' => 'required|unique:categories,name,'.$categorie->id.'|max:255',
            'imagen' => 'required'
        ]);

        //Se actualiza la categoria
        $categorie->update($request->all());

        //Se retorna la categoria actualizada
        return $this->sendResponse(
            message: "Category updated successfully",
            code: 200,
            result: [
                'categorie' => $categorie,
            ]
        );
    }

    //Funcion para eliminar una categoria en la base de datos
    public function destroy(Categorie $categorie)
    {
        //Se elimina la categoria
        $categorie->delete();

        //Se retorna la categoria eliminada
        return $this->sendResponse(
            message: "Category deleted successfully",
            code: 200,
            result: []
        );
    }
}
