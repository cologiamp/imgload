<?php
/*
#############################################################
##
##    funtion crear_Thumbnail() por Nicolás de Arregui (nicolas@e-start.com.ar)
##
##    La función crear_Thumbnail() crea una copia de una imagen a un tamaño menor definido por los parametros
##    $ancho_max y $alto_max que definen el ancho y alto máximos de la imagen resultante. El formato de esta
##    imagen es JPG y se puede elegir entre: 1) Guardar la imagen en el servidor, o 2) mostrar la imagen en
##    el navegador.
##    Además, existe la posibilidad de agregar una imagen en alguna esquina de la imagen. Esto es muy util si
##    se quiere por ejemplo, agregar una lupa indicando que se puede ver la imagen en tamaño real, o para
##    pisar nuestras imagenes con nuestra propia marca o logo. El argumento $posicion_marca indica la
##    posición que tendrá la marca, separada $margen pixel de los bordes. Los valores de $posicion_marca
##    pueden ser:
##    0 = Esquina Superior Izquierda
##    1 = Esquina Superior Derecha
##    2 = Esquina Inferior Izquierda
##    3 = Esquina Inferior Derecha
##    
#############################################################
*/
 
function abrir_Imagen($imagen) {
    if (@$info_imagen = getimagesize($imagen)) {
        switch ($info_imagen['mime']) {
        case "image/jpeg":
            if (!@$imagen_fuente = imagecreatefromjpeg($imagen)) {
                return 0;
            }
            break;
        case "image/gif":
            if (!@$imagen_fuente = imagecreatefromgif($imagen)) {
                return 0;
            }
            break;
        case "image/png":
            if (!@$imagen_fuente = imagecreatefrompng($imagen)) {
                return 0;
            }
            break;
        }
    } else {
        return 0;
    }
    return $imagen_fuente;
}
 
function crear_Thumbnail($imagen, $ancho_max = 200, $alto_max = 200, $calidad = 80, $destino = "", $marca = "", $posicion_marca = 0, $margen = 4) {
 
    if ($destino == "") {
        header('Content-type: image/jpeg');
    }
 
    //    OBTENGO LOS DATOS ORIGINALES DE LA IMAGEN Y CHEQUEO QUE SEA UNA IMAGEN VALIDA
    if (@$datos_img = getimagesize($imagen)) {
        $ancho = $datos_img[0];
        $alto = $datos_img[1];
        
        
        $ancho_orig = $ancho;
        $alto_orig = $alto;
        
        //    CALCULO ANCHO Y ALTO PROPORCIONALES
        if ($ancho > $ancho_max) {
            $proporcion = round(($ancho_max * 100) / $ancho);
            $ancho = $ancho_max;
            $alto = round(($alto * $proporcion) / 100);
        }
        if ($alto > $alto_max) {
            $proporcion = round(($alto_max * 100) / $alto);
            $alto = $alto_max;
            $ancho = round(($ancho * $proporcion) / 100);
        }
        
        //    CREO LA NUEVA IMAGEN
        $imagen_nueva = imagecreatetruecolor($ancho, $alto);
        
        //    ABRO LA IMAGEN FUENTE
        if (!$imagen_fuente = abrir_Imagen($imagen)) {
            return 0;
            exit;
        }
        
        //    COPIO LA IMAGEN FUENTE EN LA NUEVA
        imagecopyresampled($imagen_nueva, $imagen_fuente, 0, 0, 0, 0, $ancho, $alto, $ancho_orig, $alto_orig);
        
        //    CHEQUEO SI HAY QUE AGREGAR UNA MARCA
        if (($marca != "") && ($imagen_marca = abrir_Imagen($marca))) {
            list($ancho_marca, $alto_marca) = getimagesize($marca);
            $pos_x = $margen;
            $pos_y = $margen;
            switch ($posicion_marca) {
            case 1:
                $pos_x = ($ancho - $ancho_marca) - $margen;
                break;
            case 2:
                $pos_y = ($alto - $alto_marca) - $margen;
                break;
            case 3:
                $pos_x = ($ancho - $ancho_marca) - $margen;
                $pos_y = ($alto - $alto_marca) - $margen;
                break;
            }
            imagecopy($imagen_nueva, $imagen_marca, $pos_x, $pos_y, 0, 0, $ancho_marca, $alto_marca);
        }
        
        imagejpeg($imagen_nueva, $destino, $calidad);
        
        return 1;
    } else {
        //    HA OCURRIDO UN ERROR AL OBTENER LOS DATOS DE LA IMAGEN.
        //    PUEDE SER QUE EL ARCHIVO NO EXISTA, O QUE NO SEA UNA
        //    IMAGEN VALIDA.
        return 0;
    }
}
 
?>
