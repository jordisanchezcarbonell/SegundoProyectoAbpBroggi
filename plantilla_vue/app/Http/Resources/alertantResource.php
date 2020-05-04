<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\municipiResource;
class alertantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return parent::toArray($request);
     /* return [
        "id" => $this->id,
        "nom" => $this->nom,
        "adreca" => $this->adreca,

        "municipi"=>$this->municipi,
        "telefon"=>$this->telefon,
        "tipus_alertant"=>$this->tipus_alertant
    ];*/


    }
}
