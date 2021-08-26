<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG-Sandra</title>
</head>
<body>

    <h2>MY BLOG</h2>
    <hr/>
    <a href="Formulario.php">Ingresar Nota</a>
    <br/>
<?php

     // CONEXION CON EL SERVIDOR

     $miconexion = mysqli_connect("localhost", "root", "", "bbddblog");

     /*Comprobar conexion*/
 
     if (!$miconexion) {
 
         echo "La conexion ha fallado: ";
 
         exit();
     }

    //  TRAEMOS LAS FECHAS DE LAS MA NUEVA A LA MAS VIEJA

     $miconsulta = "SELECT * FROM contenido ORDER BY FECHA DESC";

    //  EXTRAEMOS LAS CONSULTAS

     if ($resultado = mysqli_query($miconexion, $miconsulta));

        while($registro = mysqli_fetch_assoc($resultado)){
            echo "<h3>" . $registro['Titulo'] ."</h3>";

            echo "<h4>" . $registro['Fecha'] ."</h4>";
            
            echo "<div style ='width:400px'>" . $registro['Comentario'] ."</div><br/><br/>";
                
            if($registro['Imagen'] != ""){

                echo "<img src='imagenes/" . $registro['Imagen'] . "' width='300px' />";

            }

            echo "<hr/>";

        }

?>
    
</body>
</html>