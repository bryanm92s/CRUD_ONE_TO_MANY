<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

    public function index()
    {
        // Traer todos los productos.
        $products = Product::all();

        // Retornamos a la vista welcome lo que recibimos
        return view('welcome', compact('products'));

        // // Devolvemos una respuesta
        // return response()->json([
        //     "results"=> $products
        // ], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        // Validamos los datos.
        $request->validate([
            'description'=>'required|string',
            'stock'=>'required|numeric|min:0',
            'category_id'=>'required'
        ]);

        // Buscamos la categoría que le estamos pasando.
        $category = Category::findOrFail($request->category_id);

        // Si encontramos la categoría creamos el producto, llamando la función que
        // Creamos en el modelo Category llamada products.
        $product = $category->products()->create([
            'description'=>$request->description,
            'stock'=>$request->stock,
        ]);

        // Devolvemos una respuesta
        return response()->json([
        "results"=> $product
        ], Response::HTTP_OK);
    }

    public function show($id)
    {
        //
        $product = Product::findOrFail($id);
        return $product;
    }

    public function update(Request $request, $product_id)
    {
        // Validamos los datos.
        $request->validate([
            'description'=>'required|string',
            'stock'=>'required|numeric|min:0',
            'category_id'=>'required'
        ]);

        // Buscamos la categoría por la clave fóranea.
        $category = Category::findOrFail($request->category_id);

        // Después de obtener la categoría llamamos la función products que creamos en el modelo Categoría.
        $product = $category->products()->where('id', $product_id)->update([
            'description'=> $request->description,
            'stock'=>$request->stock,
        ]);

        // Retornamos una respuesta
        return response()->json([
            "message" => "Product updated.",
            "result" => $product
        ], Response::HTTP_OK);

    }

    public function destroy($id)
    {
        // Buscamos el productos por id y lo eliminamos.
        Product::findOrFail($id)->delete();

        // Retornamos una respuesta.
        return response()->json([
            "message"=>"Producto deleted.",
        ], Response::HTTP_OK);
    }
}
