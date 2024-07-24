<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request){
        try{
            $body = $request->all();
            
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|',
            ]);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }

            $name = $body["name"];
            $email = $body["email"];
            $password = $body["password"];

            if (!isset($name)){
                return response()->json(
                    [
                        'error'=>1,
                        'message'=>'Debe digitar un nombre'
                    ],400
                );
            }
            else if (!isset($email)){
                return response()->json(
                    [
                        'error'=>1,
                        'message'=>'Debe digitar un correo'
                    ],400
                );                
            }

            else if (!isset($password)){
                return response()->json(
                    [
                        'error'=>1,
                        'message'=>'Debe digitar la contraseña'
                    ],400
                );
            }

            $encryptedPassword = Hash::make($password);


            $result = DB::table('users')->insert(
                [
                    'name'=>$name,
                    'email'=>$email,
                    'password'=>$encryptedPassword
                ]
            );

            return response()->json(
                [
                    'error'=>0,
                    'result'=>$result
                ]
            );


        }
        catch(Exception $e){
            return response()->json(
                [
                    'error'=>1,
                    'message'=>$e->getMessage()
                ],400
                );
        }
    }
}
