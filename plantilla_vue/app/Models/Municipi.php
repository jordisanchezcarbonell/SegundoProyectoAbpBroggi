<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipi extends Model
{
    //

    protected $table = 'municipis';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function comarca()
    {
        return $this->belongsTo('App\Models\Comarca', 'comarques_id');
    }
    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia', 'provincies_id');
    }

    public function Afectats()
    {
        return $this->belongsTo('App\Models\Afectats');
    }
    public function alertants()
    {
        return $this->hasMany('App\Models\Alertant', 'municipis_id');
    }
}
