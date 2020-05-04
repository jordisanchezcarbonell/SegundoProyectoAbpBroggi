@extends('templates.main')
@section('main')
<div class="container containercard">
  <div class="card-deck" >
      <div class="card text-center" id="card-boostrap">
        <img class="card-img-top" src="https://www.consalud.es/uploads/s1/11/67/95/0/servicios-emergencia-comunidad-de-madrid.jpeg" alt="Card image cap">
        <div class="card-body">
          <button type="button" class="btn boto-secondari"  onclick="window.location='{{ url('/taula_incidencia_recursmovil') }}'" action>
            <h5 class="card-title mt-2">INCIDÈNCIES ASSIGNADES</h5>
          </button>
        </div>
      </div>
    <div class="card text-center" id="card-boostrap">
      <img class="card-img-top" src="https://www.serviciosemergencia.es/images/galerias/portada/5ab4b35ee554f.jpg" alt="Card image cap">
      <div class="card-body">        
        <button type="button" class="btn boto-secondari"  onclick="window.location='{{ url('/Recursos') }}'" action>
          <h5 class="card-title mt-2">INCIDÈNCIES OBERTES</h5>
        </button>
      </div>
    </div>
</div>
@endsection