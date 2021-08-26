<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php

    // CONEXION CON EL SERVIDOR

    $miconexion = mysqli_connect("localhost", "root", "", "bbddblog");

    /*Comprobar conexion*/

    if (!$miconexion) {

        echo "La conexion ha fallado: ";

        exit();
    }
    

    // POSIBLES ERRORES OCURRIDOS

    if ($_FILES['imagen']['error']) {

        switch($_FILES['imagen']['error']) {
            
            case 1: //Error exceso de tamaño de archivo php.ini

                echo "El tamaño del archivo excede lo permitido por el servidor";
                break;
            
            case 2: //Error tamaño archivo marcado desde formulario

                echo "El tamñano del archivo excede 2 MB";
                break;

            case 3: //Corrupcion de archivo

                echo "El envio de archivo se interrumpio";
                break;

            case 4: //No hay fichero

                echo "No se ha enviado ningn archivo";
                break;
        }

    } else {

        echo "Entrada subida correctamente<br>";

        if ((isset($_FILES['imagen']['error']) && ($_FILES['imagen']['error']==UPLOAD_ERR_OK))) {

            $destino_de_ruta = "imagenes/";

            move_uploaded_file($_FILES['imagen']['tmp_name'], $destino_de_ruta . $_FILES['imagen']['name']);

            echo "El archivo " . $_FILES['imagen']['error'] . " se ha copiado en el directorio de imagenes";
        } else {

            echo "El archivo no se ha podido copiar al directorio de imagenes";
        }
    }

    // INFORMACION DEL FORMULARIO

    $eltitulo = $_POST['campo_titulo'];
    $lafecha = date("Y-m-d H:i:s");
    $elcomentario = $_POST['area_comentarios'];
    $laimagen = $_FILES['imagen']['name'];

    // CONSULTA PARA INSERTAR DATOS EN LA TABLA EN MySQL

    $miconsulta = "INSERT INTO contenido (Titulo, Fecha, Comentario, Imagen) Values ('". $eltitulo ."', '" .$lafecha. "', '" .$elcomentario. "', '" .$laimagen. "')";

    // INSERTANDO LOS DATOS QUE SE COLOCAN EN EL FORM CON LA CONEXCION Y LA CONSULTA REALIZADA
    
    $resultado = mysqli_query($miconexion, $miconsulta);

    // CERRANDO CONEXION

    mysqli_close($miconexion);

    echo "<br/> Se ha agregado el comentario con exito <br/><br/>";


?>
    
    <a href="Formulario.php">Añadir nueva entrada</a> <br/>
    <a href="Blog.php">Ver BLOG</a>

</body>
</html>