<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    //

    protected $table = 'provincies';
    public $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = false;

    public function municipis()
    {
        return $this->hasMany('App\Models\Provincia', 'provincies_id');
    }
}
