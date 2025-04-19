<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Nette\Utils\Validators;

class ProductController extends Controller
{
    public function index(){
        //products
        $products = Product::all();
        if($products !== null){
        return ProductResource::collection($products);
       
       }else{
        return response()->json(["msg" => "data not found"],404);
      }
    }
    //show
    public function show($id){
        //products
    $product = Product::find($id);
     if($product){
        return  new ProductResource($product);
     }else{
        return response()->json([
            "msg" =>"data not found"
        ],404);
     }
    }
    public function create(){
        //products
        return  view('admin.products.create');
    }
       //store
    public function store(Request $request){
        //valid
        $error = Validator::make($request->all(),[
            'name' => "required|string|max:255",
            'desc' => "required|string",
            'price' => "required|numeric",
            'image' => "required|image|mimes:png,jpg,jpeg",
            'quantity' => "required|numeric",

        ]);
          
        //image
     $image = Storage::putFile("products",$request->image);
        //create
        $product = Product::create([
            "name" => $request->name,
            "price" => $request->price,
            "quantity" => $request->quantity,
            "desc" => $request->desc,
            "image" => $image,
        ]);
        //redirect
        return response()->json([
            "msg" =>"product create "
            ],200  );    }

         //update
            public function update(Request $request,$id){
                //valid
             $product = Product::find($id);
             if($product == null)
             {
                return response()->json([
            "msg" =>"data not found"
                ],404);
             }
              //valid
        $error = Validator::make($request->all(),[
            'name' => "required|string|max:255",
            'desc' => "required|string",
            'price' => "required|numeric",
            'image' => "required|image|mimes:png,jpg,jpeg",
            'quantity' => "required|numeric",

        ]);
        if($error->fails()){
            return response()->json([
            "erroe"=> $error->errors()
            ],301  );
        }
         //image
         if($request->hasFile('image')){
            Storage::delete($product->image);
            $image = Storage::putFile("products",$request->image);
         }else{
            $image = Storage::putFile("products",$request->image);
            //update
        
        }
        $product->update([
            "name" => $request->name, 
            "price" => $request->price,
            "quantity" => $request->quantity,
            "desc" => $request->desc,
            "image" => $image,
        ]);
        //redirect
        return response()->json([
            "msg" =>"product update "
            ],200  );   

    }
        
        
            //delete
    public function delete($id){
        $product = Product::find($id);
        $product = Product::find($id);
        if($product){
           return  new ProductResource($product);
        }else{
           return response()->json([
               "msg" =>"data not found"
           ],404);
   
        }
        if($product->image !== null){

        Storage::delete($product->image);
        }
        $product->delete();
        return response()->json([
            "msg" =>"product delete"
        ],404);
    }
}
