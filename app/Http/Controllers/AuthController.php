<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    //user  ,  admin
    //view user , view admin
    public function redirect(){
        if(Auth::user()->role =="admin"){
            return view('admin.home');
        }else{
            $products =Product::all();
            $cart =session()->get('cart');
            return view('user.home',compact('products'));

        }
    }
}
