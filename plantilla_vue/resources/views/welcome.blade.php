<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.18/vue.min.js"></script>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>PRUEBA</title>

        <!-- Fonts -->

        <!-- Styles -->

    </head>
    <body>
        <div id="app">
            <!-- <example-component></example-component> -->
        <tablecomplexa  tablaccion= "{{$tablaccion}}" api="{{$api}}"></tablecomplexa>

        <probademodal></probademodal>
        <modal-post test= "{{$test}}" tipoaccion= "{{$tipoaccion}}"></modal-post>
            <p>{{$tipoaccion}} {{$test}}</p>
        </div>
    </body>
    <script src="{{asset('js/app.js')}}"></script>
</html>
