
@extends('templates.main')



@section('main')

<div class="container">
    <div class="row text-center row justify-content-around" style="margin: auto; width: 60%;">
        <div class="col6">
            <h1 class="text_titol_max">
                404
            </h1>
            <h1 class=" display-4 text_titol">
                ERROR
            </h1>
            <div class="mt-4">
                <img src="https://image.flaticon.com/icons/svg/396/396818.svg" height="100px" alt="emergencia">
            </div>
            
        </div>
        <div class="col6 mt-4">
            <h3>
                Ostres això és una incidència de les grosses! <br>
                La pàgina que busques no existeix!        
            </h3>  
            
        </div>
    </div>
    <div class="row text-center justify-content-center mt-4">
        
            <a class="btn boto-secondari pt-3" href="{{ URL::previous() }}">
                <h5>
                    Tornar enrere
                </h5>   
            </a>
    
        
        
    </div>
    

</div>


@endsection
