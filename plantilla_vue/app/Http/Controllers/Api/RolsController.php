<?php

namespace App\Http\Controllers\Api;

use App\Models\Rols;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Clases\Utilitat;

use  App\Http\Resources\RolsResource;

class RolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Rols=Rols::all();
        return new RolsResource($Rols);
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

        $Rols = new Rols();


        $Rols->nom = $request->input('nom');


        try {
            $Rols->save();
            //$incidencia->pivot->1;



            //$incidencia->incidenciahasrecursos()->attach($Recusr[0]);

            $resposta = (new RolsResource($Rols))->response()->setStatusCode(201);

        } catch (QueryException $e) {
            $error = Utilitat::errorMessage($e);

            $resposta = response()->json(['error' => $error], 400);
        }

        return     $resposta;    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alertant  $alertant
     * @return \Illuminate\Http\Response
     */
    public function show(Alertant $alertant)
    {
        //
;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alertant  $alertant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alertant $alertant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alertant  $alertant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alertant $alertant)
    {
        //
    }
}
