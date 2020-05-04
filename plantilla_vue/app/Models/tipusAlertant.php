<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tipusAlertant extends Model
{
    //

    protected $table = 'tipus_alertant';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;




    public function incidencias()
    {
        return $this->belongsTo('App\Models\incidencias');
    }

    public function alertants()
    {
        return $this->hasMany('App\Models\Alertant', 'tipus_alertant_id');
    }
}
