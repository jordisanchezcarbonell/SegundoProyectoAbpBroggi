@extends('templates.main')

@section('titol')
    Formació
@endsection

@section('main')



  <img src="{{ asset('assets/images/adults.png')}}" usemap="#planetmap" class="imagen">

  <map name="planetmap">
    <area  class="1" id="1" shape="rect" data-clips="1"  data-titulo="Victima cau a terra" data-src="{{ asset('assets/video/CLIP1.mp4')}}"   coords="40,30,800,90"  alt="clip1"  href="#">
    <area class="2" shape="rect" coords="50,105,900,180" alt="clip2" data-titulo="Avaluem la conciencia " href="#" data-src="{{ asset('assets/video/CLIP2.mp4')}}">
    <area class="3" shape="rect" coords="70,205,1800,370" alt="clip3" data-titulo="Avaluem si respira:Veura,Sentir,Escoltar" href="#" data-src="{{ asset('assets/video/CLIP3.mp4')}}">
    <area class="7" shape="rect" coords="524, 505, 376, 302" alt="clip4" href="#" data-titulo="un ritme per 100 compressions per minut"  data-src="{{ asset('assets/video/CLIP7.mp4')}}">
    <area class="4" shape="rect" coords="524, 505, 376, 402" alt="clip4" href="#" data-src="{{ asset('assets/video/CLIP4.mp4')}}">

    <area shape="circle" coords="124,58,8" alt="Venus" href="#">
  </map>



 {{--
  <video id="sampleMovie" width="640" height="360" preload controls>
    <source src="{{ asset('assets/video/CLIP6.mp4')}}"  />

</video>
--}}

<div>
    <h1 id="titulo" class="text_titol  margentitulo"></h1>
</div>

<video  width="50%" height="50%"  class="videoclcik esconder " id ="videosdeprueba" src="{{ asset('assets/video/CLIP6.mp4')}}" controls type="video/mov">

  </video>

 {{--
   <video id="video" width="320" height="240"></video>
--}}

{{--  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/Jfrjeg26Cwk" data-target="#myModal">
  Play Video 1 - autoplay
</button>

   <!-- Button trigger modal -->
<button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/IP7uGKgJL8U" data-target="#myModal">
  Play Video 2
</button>


   <!-- Button trigger modal -->
<button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="https://www.youtube.com/embed/A-twOC3W558" data-target="#myModal">
  Play Video 3
</button>


     <!-- Button trigger modal -->
<button type="button" class="btn btn-primary video-btn" data-toggle="modal" data-src="https://player.vimeo.com/video/58385453?badge=0" data-target="#myModal">
  Play Vimeo Video
</button>
 --}}
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">


      <div class="modal-body">

       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <!-- 16:9 aspect ratio -->
<div class="embed-responsive embed-responsive-16by9">
  <iframe class="embed-responsive-item" src="" id="video"  allowscriptaccess="always" allow="autoplay"></iframe>
</div>


      </div>

    </div>
  </div>
</div>





@endsection


<script>
      ;
document.addEventListener("DOMContentLoaded", function(event) {
      //var video = document.getElementById('video');
       /* var source = document.createElement('source');

        var totales= document.querySelectorAll("area");
        console.log(totales);

var x = document.getElementById("1");
    x.addEventListener("click", function(event) {


       // source.setAttribute('src', x.getAttribute("data-src"));



        var video = document.getElementById("videosdeprueba");

        video.src = x.getAttribute("data-src");
        video.classList.remove('esconder');
        video.autoplay = true;
        document.body.appendChild(video);

    });*/



    document.body.addEventListener("click", function (event) {
  if (event.target.classList.contains("1")) {
    cargarvideo( event.target.getAttribute('data-src'), event.target.getAttribute('data-titulo'));

  }
  else if(event.target.classList.contains("2")){
    cargarvideo( event.target.getAttribute('data-src'), event.target.getAttribute('data-titulo'));


     }
     else if(event.target.classList.contains("2")){
        cargarvideo( event.target.getAttribute('data-src'), event.target.getAttribute('data-titulo'));


     }
     else if(event.target.classList.contains("3")){
        cargarvideo( event.target.getAttribute('data-src'), event.target.getAttribute('data-titulo'));


     }
     else if(event.target.classList.contains("4")){
        cargarvideo( event.target.getAttribute('data-src'), event.target.getAttribute('data-titulo'));


     }
     else if(event.target.classList.contains("5")){
        cargarvideo( event.target.getAttribute('data-src'), event.target.getAttribute('data-titulo'));


     }
     else if(event.target.classList.contains("6")){
        cargarvideo( event.target.getAttribute('data-src'), event.target.getAttribute('data-titulo'));


     }
     else if(event.target.classList.contains("7")){
        cargarvideo( event.target.getAttribute('data-src'), event.target.getAttribute('data-titulo'));


     }

});

function cargarvideo(SRCVIDEO,titulvideo){

        var video = document.getElementById("videosdeprueba");
        var titulo = document.getElementById("titulo");

    video.src=SRCVIDEO;
      video.classList.remove('esconder');
      video.autoplay = true;


      titulo.innerHTML=titulvideo;

    }


/*
$(document).ready(function() {

// Gets the video src from the data-src on each button

var $videoSrc;
$('.video-btn').click(function() {
    $videoSrc = $(this).data( "src" );
});
console.log($videoSrc);



// when the modal is opened autoplay it
$('#myModal').on('shown.bs.modal', function (e) {

// set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
$("#video").attr('src',$videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" );
})



// stop playing the youtube video when I close the modal
$('#myModal').on('hide.bs.modal', function (e) {
    // a poor man's stop video
    $("#video").attr('src',$videoSrc);
})






// document ready
});

});

*/
});


</script>
<style type="text/css">

     </style>
