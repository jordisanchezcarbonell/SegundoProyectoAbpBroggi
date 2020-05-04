@extends('templates.main')

@section('titol')
    Taula Recurs
@endsection

@section('main')

    <h1 class="display-4 text_titol">
        Recurs mòbil
    </h1>

    {{--
        tablecomplexa: component vue, li passem accio i api corresponent
        (per a + info, mirar a Controllers\IncidienciaController)
    --}}
    <div id="app" class="mt-5">
        <div class="card p-3" style="margin-bottom: 100px;">
            <div card-body>
                <modal-post test= "{{$test}}" tipoaccion= "{{$tipoaccion}}"></modal-post>

                </a>
            </div>
        </div>
        <!-- <example-component></example-component> -->
        <!-- EN CADA COMPONENTE PONDREMOS LAS VARIABLES INDICADA PARA CREAR LA  TABLA CON SU CAMPOS CORRESPONDIENTES-->
    <tablecomplexa  tablaccion= "{{$tablaccion}}" api="{{$api}}" nomtabla="{{$nomtabla}}"

    tipusalertant="{{ $tipusalertant }}"
    nombtablaalertant="{{ $nombtablaalertant }}"



    ></tablecomplexa>
     </div>

@endsection
