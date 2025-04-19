<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
   public function index(){
  $products =Product::all();
  return view('user.home', compact('products'));
  }
public function show($id){
  $product =Product::findOrFail($id);
  return view('user.products.show', compact('product'));
}
//////addToCart
public function addToCart(Request $request,  $id){
$qty = $request->qty;
$product =Product::findOrFail($id);
$cart = session()->get('cart');
  if(!$cart){
   $cart =[
    $id =>[
      'name' => $product->name,
      'qty' => $qty,
      'price' => $product->price,
      'image' => $product->image
    ]
  ];
    session()->put('cart',$cart);
    return redirect()->back()->with('seccess','product added to cart successfully!');
  }else{
    //add to cart
   if( $cart[$id]){
     $cart[$id]['qty'] +=$qty;
      session()->put('cart',$cart);
      return redirect()->back()->with('seccess','product added to cart successfully!');
     }
     $cart[$id]=[
        'name' => $product->name,
        'qty' => $qty,
        'price' => $product->price,
        'image' => $product->image
     ];
      session()->put('cart',$cart);
      return redirect()->back()->with('seccess','product added to cart successfully!');
    }
  }
  ////////showCart
  public function showCart() {
    $cart = session()->get('cart', []); // إذا لم تكن السلة موجودة، سيتم تعيينها كمصفوفة فارغة
    return view('user.products.myCart', compact('cart'));
  }
/////////makeOrder
    public function makeOrder(Request $request) {
      // dd($request->all());
    $cart = session()->get('cart');
    // dd($cart);
      $user_id = Auth::user()->id;
    $order =Order::create([
      'user_id'=>$user_id,
      'requiredDate'=>$request->requiredDate,
      
    ]);
    foreach($cart as $id => $product){
     OrderDetails::Create([
      'order_id'=>$order->id,
      'product_id' => $id,
       'quantity'=>$product['qty'],
       'price' =>$product['price']
      ]);
     }
      return redirect()->back()->with('success');
    
    }

   }

