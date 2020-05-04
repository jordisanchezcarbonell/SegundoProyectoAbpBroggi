<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recurs extends Model
{
    //

    protected $table = 'recursos';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;
    public function recursosid()
    {
        return $this->belongsTo('App\Models\tipusRecurs', 'tipus_recurs_id');
    }

    public function tipusIncident()
    {
        return $this->hasMany('App\Models\tipusIncident', 'id', 'tipus_recurs_id');
    }
    public function incidenciahasincidencias()
    {
        return $this->belongsToMany('App\Models\incidencias', 'incidencies_has_recursos', 'incidencies_id', 'recursos_id');
    }
}
