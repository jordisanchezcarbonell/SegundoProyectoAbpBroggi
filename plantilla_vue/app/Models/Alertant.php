<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alertant extends Model
{
    //

    protected $table = 'alertants';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    public function municipi()
    {
        return $this->belongsTo('App\Models\Municipi', 'municipis_id');
    }

    public function tipus_alertant()
    {
        return $this->belongsTo('App\Models\TipusAlertant', 'tipus_alertant_id');
    }

/*
    public function municipi()
    {
        return $this->belongsTo('App\Models\Municipi', 'municipis_id');
    }

    public function tipusAlertant()
    {
        return $this->hasMany('App\Models\tipusAlertant', 'id', 'tipus_alertant_id');
    }
    *//*
    public function incidencias()
    {
        return $this->belongsTo('App\Models\incidencias');
    }*/

    /*
      public function tipus_alertant()
    {
        return $this->belongsTo('App\Models\TipusAlertant', 'tipus_alertant_id');
    } */
}
