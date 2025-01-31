<?php

$dni = $_POST['dni'];
$ciudad = $_POST['ciudad'];
$fecha = $_POST['fecha'];

if(isset($_POST['entrada'])) {
    $entrada = $_POST['entrada'];
}

$errores = "";

if(empty($dni)) {
    $errores .= "<li>EL campo DNI es obligatorio para la comrpa de entradas, recuerde rellenarlo</li>";
}

if(empty($entrada)) {
    $errores .= "<li>El numero de entradas son obligatorios, recuerde rellenarlo</li>";
}

if(!empty($errores)) {
    print "No se han podido comprar las entradas debido a los siguientes errores:";
    print "<ul>$errores</ul>";
    print "<br/><a href='index.php'> INICIO </a>";
    return;
}

$conexion = mysqli_connect('localhost','root','','agenda') or die("FALLO EN LA BBDD");
$consulta = "SELECT * FROM gira WHERE ciudad = '$ciudad' AND fecha = '$fecha';";
$resultado = mysqli_query($conexion,$consulta);

$filas = mysqli_fetch_array($resultado);

// $precio = $filas['precio'];
// $numentradas = $filas['entradas'];

if(mysqli_num_rows($resultado) > 0) {
    $precio = $filas['precio'];
    $numentradas = $filas['entradas'];
    print "<p>HAY UN CONCIERTO EN ESA CIUDAD Y ESA FECHA!!!!</p>";
    print "<p>Comprobamos si hay entradas disponibles para ese concierto...</p>";
    print "<p>Nume de entradas disponibles para ese concierto $numentradas</p>";
    
    if($entrada > $numentradas) {
        print "Lo siento, no tenemos ese stock de entradas, has solicitado --> $entrada";
        print "<br/><a href='index.php'> INICIO </a>";
    } else {
        print "Hay entradas disponibles. DATOS RESERVA:";
        print "<table border='1'>";
            print "<tr>";
                print "<td>$dni</td>";
            print "</tr>";
            print "<tr>";
                print "<td>$ciudad</td>";
            print "</tr>";
            print "<tr>";
                print "<td>$fecha</td>";
            print "</tr>";
            print "<tr>";
                print "<td>$entrada entradas</td>";
            print "</tr>";
            print "<tr>";
                print "<td>Precio total= " . ($precio * $entrada). "</td>";
            print "</tr>";
        print "</table>";
        print "RESERVA GUARDADA......... NUMER DE ENTRADAS DISPONIBLES ACTUALIZADO TAMBIEN!!!!!<br/>";
        print "<a href='index.php'> PULSA AQUI PARA VOLVER AL INICIO </a>";

        $insercion = "INSERT INTO reservas VALUES 
            ('$dni','$ciudad','$fecha','$entrada')";
        mysqli_query($conexion,$insercion);

        $actualizar = "UPDATE gira SET entradas = entradas - '$entrada' WHERE ciudad = '$ciudad' AND fecha = '$fecha';";
        mysqli_query($conexion,$actualizar);
    }
} else {
    print "No hay un concierto el dia $fecha en la ciudad $ciudad";
    print "<br/><a href='index.php'> PULSA AQUI PARA VOLVER AL INICIO </a>";
}

mysqli_close($conexion);
?>