<?php

namespace App\Http\Controllers\Api;

use App\Models\incidencias;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Clases\Utilitat;
use App\Models\Usuario;
use App\Models\Afectats;
use DateTime;
use DateTimeZone;
use Carbon\Carbon;

use  App\Http\Resources\incidenciaResource;
use App\Models\Recurs;
class incidenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    $incidencias = incidencias::with('Municipi','EstatIncidencia','tipusIncident','tipusAlertant','Alertants','incidenciaspruebaderecursos')->get();
        return  incidenciaResource::collection($incidencias);
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
        $incidencia = new incidencias();

        // selecciona el recurs en el form a partir de la id
        $Recurs = Recurs::find($request->input('recurs_mobil_id'));
        // agafem les usuaris
        $Usuario = Usuario::all();
        // agafem l'ultim afectat introduit a la base de dades
        $afectat = Afectats::all()->last();

        $incidencia->num_incidencia = $request->input('num_incidencia');
        $incidencia->telefon_alertant = $request->input('telefon_alertant');
        $incidencia->data = $request->input('data');
        $incidencia->hora = $request->input('hora');
        $incidencia->adreca = $request->input('adreca');
        $incidencia->complement_adreca = $request->input('complement_adreca');
        $incidencia->descripcio = $request->input('descripcio');
        $incidencia->municipis_id = $request->input('municipis_id');
        $incidencia->tipus_incident_id = $request->input('tipus_incident_id');
        $incidencia->estats_incidencia_id = $request->input('estats_incidencia_id');
        $incidencia->tipus_alertant_id = $request->input('tipus_alertant_id');
        $incidencia->alertants_id = $request->input('alertants_id');
        ///$now = Carbon::now();
       //
       $UTC =new DateTimeZone("UTC");
       $now=new DateTime();
       $mytime = Carbon::now();
       $mytime->setTimezone('UTC');

        try {
            $incidencia->save();
            //$incidencia->pivot->1;
            $incidencia->Usuario()->attach($Usuario[0]);
            $incidencia->Afectats()->attach($afectat);
            $incidencia->incidenciahasrecursos()
            ->attach($Recurs,['prioritat' => 1,
            'hora_acitvacio' => $now  ,
            'hora_mobilitzacio' => $now,
            'hora_assistencia' => $now,
            'hora_transport' => $now,
            'hora_arribada_hospital' => $now,
            'hora_transferencia' => $now,
            'hora_finalitzacio' => $now]
        );



            //$incidencia->incidenciahasrecursos()->attach($Recusr[0]);

            $resposta = (new incidenciaResource($incidencia))->response()->setStatusCode(201);

        } catch (QueryException $e) {
            $error = Utilitat::errorMessage($e);

            $resposta = response()->json(['error' => $error], 400);
        }

        return $resposta;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\incidencias  $incidencias
     * @return \Illuminate\Http\Response
     */
    public function show($incidencias)
    {
        //


        $incidencias = incidencias::with('tipusAlertant')
            ->with('tipusIncident')
            ->with('EstatIncidencia')
            ->with('Municipi')
            ->with('incidenciaspruebaderecursos')->find($incidencias);
        return new incidenciaResource($incidencias);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\incidencias  $incidencias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        //
          // millorar (seleccionar el recurs en el form)
          $Recurs = Recurs::all();

        $incidencia = incidencias::find($id);

        $incidencia->estats_incidencia_id = $request->input('estats_incidencia_id');

        $incidencia->incidenciaspruebaderecursos->hora_acitvacio =$request->input('hora_acitvacio');
        $incidencia->incidenciaspruebaderecursos->hora_mobilitzacio =$request->input('hora_mobilitzacio');
        $incidencia->incidenciaspruebaderecursos->hora_assistencia =$request->input('hora_assistencia');
        $incidencia->incidenciaspruebaderecursos->hora_transport =$request->input('hora_transport');
        $incidencia->incidenciaspruebaderecursos->hora_arribada_hospital =$request->input('hora_arribada_hospital');
        $incidencia->incidenciaspruebaderecursos->hora_transferencia =$request->input('hora_transferencia');
        $incidencia->incidenciaspruebaderecursos->hora_finalitzacio =$request->input('hora_finalitzacio');


        $UTC =new DateTimeZone("UTC");
        $now=new DateTime();
        $mytime = Carbon::now();
        $mytime->setTimezone('UTC');
        $incidencia->incidenciahasrecursos()
        ->detach($Recurs[0],['prioritat' => 1,
        'hora_acitvacio' => $now  ,
        'hora_mobilitzacio' => $now,
        'hora_assistencia' => $now,
        'hora_transport' => $now,
        'hora_arribada_hospital' => $now,
        'hora_transferencia' => $now,
        'hora_finalitzacio' => $now]
    );
        try {

            $incidencia->save();
            //$incidencia->pivot->1;


            $incidencia->incidenciahasrecursos()
            ->attach($Recurs[0],['prioritat' => 1,
            'hora_acitvacio' => $incidencia->incidenciaspruebaderecursos->hora_acitvacio  ,
            'hora_mobilitzacio' =>  $incidencia->incidenciaspruebaderecursos->hora_mobilitzacio,
            'hora_assistencia' =>   $incidencia->incidenciaspruebaderecursos->hora_assistencia ,
            'hora_transport' =>  $incidencia->incidenciaspruebaderecursos->hora_transport,
            'hora_arribada_hospital' => $incidencia->incidenciaspruebaderecursos->hora_arribada_hospital,
            'hora_transferencia' => $incidencia->incidenciaspruebaderecursos->hora_transferencia,
            'hora_finalitzacio' => $incidencia->incidenciaspruebaderecursos->hora_finalitzacio ]
        );



            //$incidencia->incidenciahasrecursos()->attach($Recusr[0]);

            $resposta = (new incidenciaResource($incidencia))->response()->setStatusCode(201);

        } catch (QueryException $e) {
            $error = Utilitat::errorMessage($e);

            $resposta = response()->json(['error' => $error], 400);
        }

        return     $resposta;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\incidencias  $incidencias
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_ciudad)
    {
        //

        $incidencias = incidencias::find($id_ciudad);
        $incidencias->incidenciahasrecursos()
            ->detach();






            $incidencias->Usuario()->detach();
            $incidencias->Afectats()->detach();
        if ($incidencias != null) {
            try {
                $incidencias->delete();
                $respuesta = (new incidenciaResource($incidencias))->response()->setStatusCode(200);
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
