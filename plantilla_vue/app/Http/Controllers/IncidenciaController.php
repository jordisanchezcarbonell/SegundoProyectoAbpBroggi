<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncidenciaController extends Controller
{
    /**
     * Comentar més trad....
    **/
    public function mostrarTaula()
    {
        $api='incidencias';
        $tipoaccion="incidencias";
        $tablaccion ="incidencias";
        $test="Prueba de pasar mas parametros";
        $nomtabla="num_incidencia";
        $datamunicipi="municipi[0].nom";
        $adreca='data';
        $telefon='hora';
        $tipusalertant='descripcio';
        $nombtablaalertant='descripcio';
        $col23='municipis_id';
        $col24 = 'tipus_incident_id';
        $col25 = 'estats_incidencia_id';
        $col26 = 'tipus_alertant_id';
        $col27 = 'alertants_id';
        $col28="alertants.nom";
        $col29="tipus_alertant[0].tipus";
        $col30="tipus_incident[0].tipus";
        $col31="estat_incidencia[0].estat";
        $col32="municipi[0].nom";




        // tornem la vista
        //return view('taules.taula_incidencia', compact('api', 'tipoaccion', 'tipusalertant','tablaccion','nomtabla','nombtablaalertant'));

        return view('taules.taula_incidencia',
            compact('api', 'test','tipoaccion', 'tipusalertant','tablaccion',
                    'nomtabla','datamunicipi','adreca','telefon','nombtablaalertant',
                    'col23', 'col24', 'col25', 'col26', 'col27','col28','col29','col30','col31','col32'));

    }

    public function mostrarForm()
    {
        $tipoaccion ="alertant";
        $test="Prueba de pasar mas parametros";


        return view('forms.form_incidencia', compact('tipoaccion', 'test'));
    }





    public function mostrarTaulaIncidenciaxRecurs()
    {
        $api='incidencias';
        $tipoaccion="incidencias";
        $tablaccion ="incidencias";
        $test="Prueba de pasar mas parametros";
        $nomtabla="num_incidencia";
        $datamunicipi="municipi[0].nom";
        $adreca='data';
        $telefon='hora';
        $tipusalertant='descripcio';
        $nombtablaalertant='descripcio';
        $col23='municipis_id';
        $col24 = 'tipus_incident_id';
        $col25 = 'estats_incidencia_id';
        $col26 = 'tipus_alertant_id';
        $col27 = 'alertants_id';
        $col28="alertants.nom";
        $col29="tipus_alertant[0].tipus";
        $col30="tipus_incident[0].tipus";
        $col31="estat_incidencia[0].estat";
        $col32="municipi[0].nom";




        // tornem la vista
        //return view('taules.taula_incidencia', compact('api', 'tipoaccion', 'tipusalertant','tablaccion','nomtabla','nombtablaalertant'));

        return view('taules.taula_incidencia_recursmovil',
            compact('api', 'test','tipoaccion', 'tipusalertant','tablaccion',
                    'nomtabla','datamunicipi','adreca','telefon','nombtablaalertant',
                    'col23', 'col24', 'col25', 'col26', 'col27','col28','col29','col30','col31','col32'));

    }
}
