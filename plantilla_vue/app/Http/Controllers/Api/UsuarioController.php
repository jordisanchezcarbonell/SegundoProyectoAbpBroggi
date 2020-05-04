<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Clases\Utilitat;

use  App\Http\Resources\usuarioResource;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Usuario = Usuario::all();
        return new usuarioResource($Usuario);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $usuaris = new Usuario();

        $usuaris->codi = $request->input('codi');
        $usuaris->nom = $request->input('nom');
        $usuaris->contrasenya = Hash::make($request->input('contrasenya'));
        $usuaris->rols_id = $request->input('rols_id');

        try {
            $usuaris->save();
            //$incidencia->pivot->1;



            //$incidencia->incidenciahasrecursos()->attach($Recusr[0]);

            $resposta = (new usuarioResource($usuaris))->response()->setStatusCode(201);

        } catch (QueryException $e) {
            $error = Utilitat::errorMessage($e);

            $resposta = response()->json(['error' => $error], 400);
        }

        return     $resposta;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alertant  $alertant
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $Usuario = Usuario::with('rol')->find($id);
        return new usuarioResource($Usuario);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alertant  $alertant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
        $usuaris = Usuario::find($id);

        $usuaris->codi = $request->input('codi');
        $usuaris->nom = $request->input('nom');
        $usuaris->contrasenya = Hash::make($request->input('contrasenya'));
        $usuaris->rols_id = $request->input('rols_id');

        try {
            $usuaris->save();
            //$incidencia->pivot->1;



            //$incidencia->incidenciahasrecursos()->attach($Recusr[0]);

            $resposta = (new usuarioResource($usuaris))->response()->setStatusCode(201);

        } catch (QueryException $e) {
            $error = Utilitat::errorMessage($e);

            $resposta = response()->json(['error' => $error], 400);
        }

        return     $resposta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alertant  $alertant
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id_ciudad)
    {
        //


        $usuaris = Usuario::find($id_ciudad);



        if ($usuaris != null) {
            try {


                $usuaris->delete();
                $respuesta = (new usuarioResource($usuaris))->response()->setStatusCode(200);
            } catch (QueryException $e) {
                $mensaje = Utilitat::errorMessage($e);
                $respuesta = response()->json(["error" => $mensaje], 400);
            }
        } else {
            $respuesta = response()->json(["error" => 'REGISTRO NO ENCONTRADO'], 404);
        }

        return $respuesta;
    }
    }

