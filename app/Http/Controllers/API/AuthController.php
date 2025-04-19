<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\Cast\String_;

class AuthController extends Controller
{
      //register
    public function register(Request $request){
        $error = Validator::make($request->all(),[
            'name' => "required|string|max:255",
            'email' => "required|email",
            'password' => "required|string|min:6|confirmed",
        ]);
        if($error->fails()){
            return response()->json([
            "erroe"=> $error->errors()
            ],301  );
        } 
        $access_token = String::random(65);
        $password = bcrypt($request->Password);
        $user =User::create([
            'name'=>$request->name,
            'email' =>$request->email,
            'password' => $password,
            'access_token' =>$access_token,

        ]);
        return response()->json([
            "msg" =>"product update",
            "access_token" =>$access_token,
            ],200  );   
    }
    //login
    public function login(Request $request){
        $error = Validator::make($request->all(),[
            'email' => "required|email",
            'password' => "required|string|min:6",
        ]);

        if($error->fails()){
            return response()->json([
            "erroe"=> $error->errors()
            ],301  );
        } 
        $user = User::where('email',$request->email)->first();
         if($user){
           $isvalid =Hash::check($request->password,$user->password);
         if($isvalid){
           $access_token = String::random(65);
           $user->update([
            "access_token" => $access_token
           ]);
           return response()->json([
            "msg" =>"user login success",
            ],200  );   
        }else{
            return response()->json([
                "msg" =>"password is not correct",
                ],404  );   
         }
        }else{
            return response()->json([
                "msg" =>"email is not correct",
                ],404  );   
        }
      }
      //logout
      public function logout(Request $request){
       $access_token = $request->header("access_token");
      if($access_token){ 
        $user=User::where("access_token",$access_token)->first();
       if($user){
       $user->update([
        "access_token"=>null,
       ]);
       return response()->json([
        "msg" =>"user logout",
        ],404  );   
       }else{
        return response()->json([
            "msg" =>"access_token is not correct",
            ],404  );  
       }
      }else{
        return response()->json([
            "msg" =>"access_token is not found",
            ],404  );   
       }
      }
    }

 
