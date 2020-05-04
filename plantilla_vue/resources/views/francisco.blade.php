<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href=" {{ asset('css/app.css') }} ">
</head>
<body>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>Tipus Alertant</th>
                    <th>Nom</th>
                    <th>Adreça</th>
                    <th>Municipi</th>
                    <th>Comarca</th>
                    <th>Provincia</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($alertants as $alertant)
                    <tr>
                        <td>{{$alertant->tipus_alertant->tipus}}</td>
                        <td>{{$alertant->nom}}</td>
                        <td>{{$alertant->adreca}}</td>
                        <td>{{$alertant->municipi->nom}}</td>
                        <td>{{$alertant->municipi->comarca->nom}}</td>
                        <td>{{$alertant->municipi->comarca->provincia->nom}}</td>

                        <td>
                            <button
                            class="btn btn-sm btn-outline-secondary"
                        >
                            Editar
                        </button>
                        <button
                            class="btn btn-sm btn-outline-danger"
                        >
                            Esborrar
                        </button>
                        <button
                            class="btn btn-sm btn-outline-info"
                        >
                            Usuari
                        </button>
                    </td>






                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
<script src=" {{ asset('js/app.js') }} "></script>
</html>
