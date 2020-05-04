@extends('templates.main')

@section('titol')
    Taula incidència
@endsection

@section('main')

    <h1 class="display-4 text_titol">
        INCIDÈNCIES
    </h1>
    <div class="card p-3">
        <div card-body>
            <a href="{{ action('IncidenciaController@mostrarForm')}}" class="btn boto-terciari">

                <span>
                    NOVA INCIDÈNCIA
                </span>
            </a>
        </div>
    </div>
    {{--
        tablecomplexa: component vue, li passem accio i api corresponent
        (per a + info, mirar a Controllers\IncidienciaController)
    --}}
    <div id="app" class="mt-5">
        <tablecomplexa  tablaccion= "{{$tablaccion}}" api="{{$api}}" nomtabla="{{$nomtabla}}"
        datamunicipi="{{ $datamunicipi }}"
        adreca="{{ $adreca }}"
        telefon="{{ $telefon }}"

        tipusalertant="{{ $tipusalertant }}"
        nombtablaalertant="{{ $nombtablaalertant }}"
        col23= "{{ $col23 }}"
        col24= "{{ $col24 }}"
        col25= "{{ $col25 }}"
        col26= "{{ $col26 }}"
        col27= "{{ $col27 }}"
        col28= "{{ $col28 }}"
        col29= "{{ $col29 }}"
        col30= "{{ $col30 }}"
        col31= "{{ $col31 }}"
        col32= "{{ $col32 }}"

        ></tablecomplexa>  
    </div>

@endsection
