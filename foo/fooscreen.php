<?php
    $data;
    $success 
 ?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

<style>
@font-face {
    font-family: "helvetica";
    src: url('font/HelveticaRounded-Bold.otf') format("truetype");
}
/*
body  {
    background-image: url("diaria.jpg");
    background-repeat:no-repeat;
-webkit-background-size:cover;
-moz-background-size:cover;
-o-background-size:cover;
background-size:cover;
/*background-position:center;*/
     /* Nos aseguramos que la imagen de fondo este centrada vertical y
    horizontalmente en todo momento */
  /*background-position: center center;*/
  /* La imagen de fondo no se repite */
  /*background-repeat: no-repeat;*/
  /* La imagen de fondo est� fija en el viewport, de modo que no se mueva cuando
     la altura del contenido supere la altura de la imagen. */
   /*background-attachment: fixed;*/
  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana del navegador */
 /*background-size: cover;*/
  /* Fijamos un color de fondo para que se muestre mientras se est�
    cargando la imagen de fondo o si hay problemas para cargarla  */
  /*background-color: #464646;

  @media only screen and (max-width: 767px) {
  body {
    background-image: url(images/background-photo-mobile-devices.jpg);
  }
    }

} */

    .fullscreen{
	 position: absolute:
     
	}

    ._container{
        float: left;
        margin: 0 auto;
       
    }

    ._container_free{
        position: absolute;
        margin-top: 38%;
       
    }

    ._centrado{
        margin-left: 38%;
        margin-top: 0%;
    }

    ._espaciado{
        margin-left: 5%;
    }

    ._espaciado_numeros{
        margin-left: 20.7%;
    }

    .mifuente{
        font-weight: bold; font-size: 120px;
    }

    .mifuente2{
        font-weight: bold; font-size: 70px;
    }

    @media (max-width: 720px) {
        ._centrado{
        margin-left: 38%;
        margin-top: 3.5%;
    }
    }

    #position2{
   position: relative;
    /*margin-right: 250px;*/
   /* margin-right: 250px;*/
   /* margin-left: 60%;*/
  /* margin-top: -2%;*/
    height: 1080px;
    width: 1920px;
 }


    body{
        height: 1080px;
        width: 1920px;
    }
</style>
</head>
<body>
<form id='formCanvas' method='post' action='redirect.php' ENCTYPE='multipart/form-data'>
<input type='hidden' name='imagen' id='imagen' />
<div id="position2">
	<img src= 'img/diaria_1.jpg' style= 'position: absolute;' height="100%" width="100%"></img>
	<!-- <a id="download" style="visibility:hidden">Tomar screenshot y descargar</a> -->
    
                
                <div class="" style="position: absolute; margin-top: 5.5%; margin-left: 39.2%"><h1 class="mifuente" style=""><?php echo 88 ?> </h1></h1></div>
                <div class="" style="position: absolute; margin-top: 5.5%; margin-left: 51.2%"><h1 class="mifuente" style=""><?php echo 88 ?> </h1></div>
   


    

    <!-- Lunes -->
<div class="" style="position: absolute; margin-top:31.3%; margin-left: 20.7%;"><h1 class="mifuente2" style="">88</h1></div>
<div class="" style="position: absolute; margin-top: 37.8%; margin-left:20.7%;"><h1 class="mifuente2" style="">88</h1></div>

    <!-- Martes -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 31.5%;"><h1 class="mifuente2" style=""></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 31.5%;"><h1 class="mifuente2" style=""></h1></div>  

    <!-- Miercoles -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 42.5%;"><h1 class="mifuente2" style=""></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 42.5%;"><h1 class="mifuente2" style=""></h1></div>  

    <!-- Jueves -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 53.1%;"><h1 class="mifuente2" style=""></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 53.1%;"><h1 class="mifuente2" style=""></h1></div>  

    <!-- Viernes -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 63.9%;"><h1 class="mifuente2" style=""></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 63.9%;"><h1 class="mifuente2" style=""></h1></div>  

    <!-- Sabado -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 74.7%;"><h1 class="mifuente2" style=""></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 74.7%;"><h1 class="mifuente2" style=""></h1></div>  

    <!-- Domingo -->
    <div class="" style="position: absolute; margin-top: 31.3%; margin-left: 85.5%;"><h1 class="mifuente2" style=""></h1></div>
    <div class="" style="position: absolute; margin-top: 37.8%; margin-left: 85.5%;"><h1 class="mifuente2" style=""></h1></div> 
    </div>
</form>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
  <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
     <script>
  /* Variables de Configuracion */
  var idCanvas='canvas';
  var idForm='formCanvas';
  $(document).ready(function(){
		/*html2canvas($('#position2'), {
		onrendered (canvas) {
		    var link = document.getElementById('download');;
		    var image = canvas.toDataURL();
		    link.href = image;
		    link.download = 'screenshot.png';
		    link.click();
		}
        });*/
        


        downloadCanvas('position2', 'imagen.jpeg');
    });
    /*
    function GuardarTrazado(){
       // imagen.value=document.getElementById(idCanvas).toDataURL('image/png');
        document.forms[idForm].submit();
        }*/

    function downloadCanvas(canvasId, filename) {
    // Obteniendo la etiqueta la cual se desea convertir en imagen
    var domElement = document.getElementById(canvasId);
    
    // Utilizando la función html2canvas para hacer la conversión
    html2canvas(domElement, {
        onrendered: function(domElementCanvas) {
            // Obteniendo el contexto del canvas ya generado
            var context = domElementCanvas.getContext('2d');
            
            // Creando enlace para descargar la imagen generada
            var link = document.createElement('a');
            link.href = domElementCanvas.toDataURL("image/png");
            dataImagen = domElementCanvas.toDataURL("image/png");
            //imagen = dataImagen.replace('data:image/jpeg;base64,', '');
            //imagen = imagen.replace(' ', '+');
            //console.log(imagen);
            imagen.value = domElementCanvas.toDataURL("image/png");
            //console.log(imagen.value);
            document.forms[idForm].submit();
            /*
            link.download = filename;
            
            
 
            // Chequeando para browsers más viejos
            if (document.createEvent) {
                var event = document.createEvent('MouseEvents');
                // Simulando clic para descargar
                event.initMouseEvent("click", true, true, window, 0,
                    0, 0, 0, 0,
                    false, false, false, false,
                    0, null);
                link.dispatchEvent(event);
            } else {
                // Simulando clic para descargar
                link.click();
            } */
        }
    });
}


	
    </script>
   
   

  
</body> 
</html>