<?php

namespace App\Http\Controllers\Api;

use App\Models\Alertant;
use App\Models\Municipi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Clases\Utilitat;

use  App\Http\Resources\alertantResource;
use Illuminate\Database\QueryException;

class alertantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        try{
        $Alertant = Alertant::with('municipi','tipus_alertant')->get();
        }
        catch(QueryException $e) {
        $error = Utilitat::errorMessage($e);

        return response()->json(['error' => $error], 403);

         }
        return  alertantResource::collection($Alertant);

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
        $Alertant = new Alertant();


        $Alertant->nom = $request->input('nom');

        $Alertant->adreca = $request->input('adreca');


        $Alertant->municipis_id = $request->input('municipis_id');

        $Alertant->telefon = $request->input('telefon');

        $Alertant->tipus_alertant_id = $request->input('tipus_alertant_id');




        try {
            $Alertant->save();
            //$incidencia->pivot->1;



            //$incidencia->incidenciahasrecursos()->attach($Recusr[0]);

            $resposta = (new alertantResource($Alertant))->response()->setStatusCode(201);

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
    public function show(Alertant $alertant)
    {
        //

        $alertant = Alertant::with('municipi')->with('tipusAlertant')->find($alertant->id);

        return new alertantResource($alertant);
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
        $Alertant =  Alertant::find($id);


        $Alertant->nom = $request->input('nom');

        $Alertant->adreca = $request->input('adreca');


        $Alertant->municipis_id = $request->input('municipis_id');

        $Alertant->telefon = $request->input('telefon');

        $Alertant->tipus_alertant_id = $request->input('tipus_alertant_id');




        try {
            $Alertant->save();
            //$incidencia->pivot->1;



            //$incidencia->incidenciahasrecursos()->attach($Recusr[0]);

            $resposta = (new alertantResource($Alertant))->response()->setStatusCode(201);

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

        $alertant = Alertant::find($id_ciudad);



        if ($alertant != null) {
            try {


                $alertant->delete();
                $respuesta = (new alertantResource($alertant))->response()->setStatusCode(200);
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
