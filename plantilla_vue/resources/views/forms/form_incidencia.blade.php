@extends('templates.main')

@section('titol')
    Form incidencia
@endsection

@section('main')

    <h1 class="display-4 text_titol">
        NOVA INCIDÈNCIA
	</h1>
	<div id="app">
		<form-incidencia test= "{{$test}}" tipoaccion= "{{$tipoaccion}}"></form-incidencia>
	</div>	
	
    
@endsection