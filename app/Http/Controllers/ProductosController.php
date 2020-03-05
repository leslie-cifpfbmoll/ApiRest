<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;

class ProductosController extends Controller {

    //
    public function read() {
        return Product::all();
        
    }


    public function readOne($id) {
        return Product::where('id', $id)->get();
    }

    public function create(Request $request) {
        $nombre = $request->nombre;
        $description = $request->description;
        $price = $request->price;
        $category_id = $request->category_id;
        DB::insert('insert into products (nombre,description,price,category_id)'
                . ' values (?, ?, ?, ?)', [$nombre, $description, $price, $category_id]);
       return response()->json([
            'error' => false,
            'message'  => "Se ha creado de forma correcta.",
        ], 200);
    }

    public function delete($id) {
        $product = Product::find($id);
        $product->delete();
           return response()->json([
            'error' => false,
            'message'  => "Se ha borrado de forma correcta. ",
        ], 200);
   }

    public function update(Request $request) {
        $id = $request->id;
        $nombre = $request->nombre;
        $description = $request->description;
        $price = $request->price;
        $category_id = $request->category_id;
        DB::update('update products set nombre=?,description=?,price=?,category_id=?'
                . ' where id=?', [$nombre, $description, $price, $category_id, $id]);
        
         return response()->json([
            'error' => false,
            'message'  => "Se ha actualizado de forma correcta.",
        ], 200);
    }

}
