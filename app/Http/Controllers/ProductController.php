<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $product= Product::all();
        return ProductResource::collection($product);
    }

    public function getProduct($id){
        $product= Product::find($id);
        
        if($product){
            return ProductResource::make($product);
        }
        else{
            return response()->json([
                'message' => "Failed to retrieve the product"
            ], 404);
        }

        return ProductResource::collection($product);
    }

    public function createProduct(Request $request){

        $request->validate([
            'name' =>"required|string",
            'category' =>"nullable",
            'price' =>"required|numeric",
            'stock' =>"required|integer",
        ]);

        $product= Product::create($request->all());

        if($product){
            return ProductResource::make($product);
        }
        else{
            return response()->json([
                'message' => "Failed to create new product"
            ], 404);
        }
    }


    public function updateProduct($id,Request $request){

        $request->validate([
            'name' =>"required|string",
            'category' =>"nullable",
            'price' =>"required|numeric",
            'stock' =>"required|integer",
        ]);

        $product= Product::find($id);

        if($product){
            $product->update($request->all());

            return response()->json([
                'message' => "Product updated successfully"
            ], 200);
        }
        else{
            return response()->json([
                'message' => "Failed to update"
            ], 404);
        }
    }


    public function deleteProduct($id){


        $product= Product::find($id);

        if($product){
            $product->delete();

            return response()->json([
                'message' => "Product deleted successfully"
            ], 200);
        }
        else{
            return response()->json([
                'message' => "Failed to delete"
            ], 404);
        }
    }
}
