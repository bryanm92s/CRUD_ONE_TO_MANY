<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{

    public function index()
    {
        // Traenos todas las categorías.
        $categories=Category::all();

        return response()->json([
            "results"=>$categories
        ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Validamos los datos.
        $request->validate([
            'description' => 'required'
        ]);

        // Creamos un solo registro.
        $category=Category::create([
            "description"=>$request->description
        ]);

        //Devolvemos una respuesta.
        return response()->json([
            "result"=>$category
        ], Response::HTTP_OK);
    }


    public function show($id)
    {
        //
        $category = Category::findOrFail($id);
        return $category;
    }

    public function update(Request $request, $id)
    {
        // Validamos los datos para actualizar.
        $request->validate([
            'description' => 'required'
        ]);

        // Actualizamos en la BD.
        $category = Category::findOrFail($id);
        $category->description =$request->description;
        $category->save();

        // Devolvemos una respuesta.
        return response()->json([
            "message"=>"Category updated.",
            "result"=> $category
        ], Response::HTTP_OK);
    }

    public function destroy($id)
    {
        // Buscamos el datos en la BD y lo eliminamos.
        Category::findOrFail($id)->delete();

        // Devolvemos una respuesta
        return response()->json([
            "result"=> "Category deleted."
        ],Response::HTTP_OK);
    }
}
