<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return \view ('login.login');
    }

    public function showRegister(){
        return \view ('login.register');
    }

    public function login(Request $request){

        $codi = $request->input('codi');
        $contrasenya = $request->input('contrasenya');
        $user = Usuario::where('codi', $codi)->first();

        if($user != null && Hash::check($contrasenya, $user->contrasenya)){

            Auth::login($user);

            if($user->rols_id ==1){
                return redirect('/landingpage');
            }else{
                return redirect('/recurscard');
            }

        }else{
            return redirect('/login')->withInput();
        }

    }

    public function logout(){
        Auth::logout();

        return redirect('/login');
    }
}
