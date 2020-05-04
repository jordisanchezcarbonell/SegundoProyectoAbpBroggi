<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comarca extends Model
{
    //

    protected $table = 'comarques';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;


    public function municipis()
    {
        return $this->hasMany('App\Models\Municipi', 'comarques_id');
    }

    public function provincia()
    {
        return $this->belongsTo('App\Models\Provincia', 'provincies_id');
    }
}
