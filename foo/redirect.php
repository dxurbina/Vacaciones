<?php 
// comprovamos si se envió la imagen
var_dump($_POST['imagen']);
if (isset($_POST['imagen'])) { 
    echo"entro";
    // mostrar la imagen
    echo '<img src="'.$_POST['imagen'].'" border="1">';

    // funcion para gusrfdar la imagen base64 en el servidor
    // el nombre debe tener la extension
    function uploadImgBase64 ($base64, $name){
        // decodificamos el base64
        $datosBase64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
        // definimos la ruta donde se guardara en el server
        $path= $_SERVER['DOCUMENT_ROOT'].'/img/'.$name;
     //  $path = 'draw'
        // guardamos la imagen en el server
        print($path);
        if(!file_put_contents($path, $datosBase64)){
            // retorno si falla
            echo "error";
           // return false;
        }
        else{
            // retorno si todo fue bien
                echo "se subio";
                 //   return true;
        }
    }

    // llamamos a la funcion uploadImgBase64( img_base64, nombre_fina.png) 
    uploadImgBase64($_POST['imagen'], 'mi_imagen_'.date('d_m_Y_H_i_s').'.png' );
}
?>