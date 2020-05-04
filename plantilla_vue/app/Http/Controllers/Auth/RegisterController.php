<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use  App\Http\Resources\RegisterResource;
use App\Models\Usuario;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Clases\Utilitat;
use Illuminate\Database\QueryException;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    public function create(Request $request)
    {
        Usuario::create([
            'codi' => $request->input('correo'),

            'nom' => $request->input('nombre'),


            'contrasenya' => Hash::make($request->input('contrasenya')),
            'rols_id' => $request->input('cbxTemas'),

        ]);
        return redirect('login')->withInput();
    }
    public function store(Request $request)
    {
        $usuario = new Usuario();


        $usuario->codi = $request->input('codi');
        $usuario->nom = $request->input('nom');
        $usuario->contrasenya = $request->input('contrasenya');
        $usuario->rols_id = $request->input('rols_id');


        try {
            $usuario->save();
            $respuesta =  (new RegisterResource($usuario))->response()->setStatusCode(201);
        } catch (QueryException $e) {
            $mensaje = Utilitat::errorMessage($e);
            $respuesta = response()->json(["error" => $mensaje], 400);
        }
        return $respuesta;
    }
    public function index()
    {
        //
        $Usuario=Usuario::all();
        return new RegisterResource($Usuario);
    }

}


