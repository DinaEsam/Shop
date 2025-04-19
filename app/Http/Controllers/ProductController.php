<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //
    public function index(){
        //products
        $products = Product::paginate(9);
        return  view('Admin.products.index',compact('products'));
    }

    public function create(){
        //products
        return  view('admin.products.create');
    }

    public function store(Request $request){
        //valid
        $data = $request->validate([
            'name' => "required|string|max:255",
            'desc' => "required|string",
            'price' => "required|numeric",
            'image' => "required|image|mimes:png,jpg,jpeg",
            'quantity' => "required|numeric",

        ]);

        //image

        $data['image'] = Storage::putFile("products",$request->image);

        //create
        $product = Product::create($data);

        //redirect
        return redirect(url('product/create'))->with('success',"product created successffly");
    }


    public function delete($id){
        $product = Product::findOrFail($id);

        Storage::delete($product->image);

        $product->delete();

        return redirect(url('products'))->with("success","Product deleted succss");

    }
}
