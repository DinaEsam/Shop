<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
   public function index() {
       //
   }

   public function addToWishlist(Request $request, $id) {
       $product = Product::findOrFail($id);

       // جلب قائمة الأمنيات الحالية
       $Wishlist = session()->get('Wishlist', []);

       // التحقق إذا كان المنتج مضاف مسبقًا
       if (isset($Wishlist[$id])) {
           return redirect()->back()->with('success', 'المنتج موجود بالفعل في قائمة الأمنيات!');
       }

       // إضافة المنتج إلى قائمة الأمنيات
       $Wishlist[$id] = [
           'name'  => $product->name,
           'price' => $product->price,
           'image' => $product->image
       ];

       // تحديث الجلسة
       session()->put('Wishlist', $Wishlist);

       return redirect()->back()->with('success', 'تمت إضافة المنتج إلى قائمة الأمنيات بنجاح!');
   }

   public function showWishlist() {
       $Wishlist = session('Wishlist', []); // تأكد من أنها مصفوفة
       return view('user.products.myWishlist', compact('Wishlist'));
   }
}
