<?php

namespace App\Http\Controllers\Api;

use App\Models\Recurs;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Clases\Utilitat;

use  App\Http\Resources\recursoResource;

class recursoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Recurs = Recurs::with('recursosid')->get();
        return  recursoResource::collection($Recurs);
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
        $Recurs = new Recurs();


        $Recurs->codi = $request->input('codi');

        $Recurs->tipus_recurs_id = $request->input('tipus_recurs_id');






        try {
            $Recurs->save();
            //$incidencia->pivot->1;



            //$incidencia->incidenciahasrecursos()->attach($Recusr[0]);

            $resposta = (new recursoResource($Recurs))->response()->setStatusCode(201);

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
        $Recurs = Recurs::with('tipusIncident')->find($id);
        return new recursoResource($Recurs);
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

        $Recurs =  Recurs::find($id);


        $Recurs->codi = $request->input('codi');

        $Recurs->tipus_recurs_id = $request->input('tipus_recurs_id');






        try {
            $Recurs->save();
            //$incidencia->pivot->1;



            //$incidencia->incidenciahasrecursos()->attach($Recusr[0]);

            $resposta = (new recursoResource($Recurs))->response()->setStatusCode(201);

        } catch (QueryException $e) {
            $error = Utilitat::errorMessage($e);

            $resposta = response()->json(['error' => $error], 400);
        }

        return     $resposta;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recurs  $alertant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_ciudad)
    {
        //


        $Recurs = Recurs::find($id_ciudad);



        if ($Recurs != null) {
            try {


                $Recurs->delete();
                $respuesta = (new recursoResource($Recurs))->response()->setStatusCode(200);
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
