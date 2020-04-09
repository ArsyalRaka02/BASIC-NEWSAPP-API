<?php

namespace App\Http\Controllers;

use App\users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {


    public function view(){
        $data = users::all();
        return response($data);
    }

    public function viewId($id){
        $data = users::where('id_user', $id)->first();

        if ($data) {
            return response()->json([
                'success' => true,
                'massage' => 'user found !!',
                'data'    => $data
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'massage' => 'user not found !!',
                'data'    => ''
            ], 400);
        }
    }

    public function login(Request $request){
        
        $hasher = app()->make('hash');
        $username = $request->input('username');
        $password = $request->input('password');

        $user = users::where('username', $username)->first();

        if($hasher->check($password, $user->password)){
            $apiToken = $this->generateRandomString();
            
        users::where('id_user',$user->id_user)->update([
                'api_token' => $apiToken
            ]);

            return response()->json([
                'succes'  => true,
                'message' => 'login sukses cuy',
                'data'    => [
                        'username' => $user->username,
                        'api_token' => $apiToken
                ]
            ], 201);
        }else {
            return response()->json([
                'succes'  => false,
                'massage' => 'login gagal bro harap coba lagi',
                'data'    => ''
            ], 400);
        }
    }

    public function register(Request $request){
        
        $hasher = app()->make('hash');
        $username = $request->input('username');
        $password = $hasher->make($request->input('password'));

        $register = users::create([
            'username' => $username,
            'password' => $password,
            'api_token'=> '',
            'id_role'  => '3'
        ]);

        if($register) {
            return response()->json([
                'success' => true,
                'massage' => 'register berhasil',
                'data'    => $register 
            ], 200);
        }else {
            return response()->json([
                'success' => false,
                'massage' => 'register gagal harap coba lagi'
            ], 400);
        }

    }

    public function destroy($id){
        $data = users::where('id_user',$id);
        if ($data->delete()){
            return response()->json([
                'succes'  => true,
                'massage' => 'Delete Sukses'
            ]);
        }
        else {
            return response()->json([
                'succes'  => false,
                'massage' => 'delete gagal'
            ]);
        }
    }

    public function generateRandomString($length = 32)
    {
        $karakter = "1234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM";
        $panjang_karakter = strlen($karakter);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $karakter[rand(0, $panjang_karakter - 1)];
        }
        return $str;
    }

}
