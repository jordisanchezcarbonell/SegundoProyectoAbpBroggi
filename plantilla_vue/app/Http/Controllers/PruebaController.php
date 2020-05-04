<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alertant;
class PruebaController extends Controller
{

    public function index()
    {

        /**
         * INDICAREMOS LAS VARIABLES Y PASAREMOS LOS PARAMETROS INDICADOS DE LAS TABLAS
         */
        /*$api='alertant';
        $tipoaccion="alertant";
        $tablaccion ="alertant";
        $test="Prueba de pasar mas parametros";
        $nomtabla="nom";
        $datamunicipi="municipi.nom";
        $adreca='adreca';
        $telefon='telefon';
        $tipusalertant='tipus_alertant.tipus';
        $nombtablaalertant='Alertant';
        */
        $api='recurso';
        $test="Prueba de pasar mas parametros";
        $tipoaccion="recurso";
        $tablaccion ="recursos";
        $nomtabla="codi";
        $tipusalertant='recursosid.tipus';
        $nombtablaalertant='Recurs';
       // return view('welcome')->with('api',$api)->with('tipoaccion',$tipoaccion)->with('test',$test)->with('tablaccion',$tablaccion);
      return view('taules.taula_recursmovil', compact('api', 'test','tipoaccion', 'tipusalertant','tablaccion','nomtabla','nombtablaalertant'));

    }
    public function moostrarvip()
    {

        /**
         * INDICAREMOS LAS VARIABLES Y PASAREMOS LOS PARAMETROS INDICADOS DE LAS TABLAS
         */
        $api='alertant';
        $tipoaccion="alertant";
        $tablaccion ="alertant";
        $test="Prueba de pasar mas parametros";
        $nomtabla="nom";
        $datamunicipi="municipi.nom";
        $adreca='adreca';
        $telefon='telefon';
        $tipusalertant='tipus_alertant.tipus';
        $nombtablaalertant='Alertant';
        /*
        $api='recurso';
        $test="Prueba de pasar mas parametros";
        $tipoaccion="recurso";
        $tablaccion ="recursos";
        $nomtabla="codi";
        $tipusalertant='recursosid.tipus';
        $nombtablaalertant='Recurs';
        */
       // return view('welcome')->with('api',$api)->with('tipoaccion',$tipoaccion)->with('test',$test)->with('tablaccion',$tablaccion);
      return view('taules.taula_vip', compact('api', 'test','tipoaccion', 'tipusalertant','tablaccion','nomtabla','datamunicipi','adreca','telefon','nombtablaalertant'));

    }

    public function landingpage(){
        return view ('card');
    }

    public function landingpagerecurs(){
        return view ('recurscard');
    }

    public function formacio(){
        return view ('login.formacio');
    }
/*
    public function index()
    {
        $alertants = Alertant::all();

        return \view('francisco', \compact('alertants'));
    }*/
}
