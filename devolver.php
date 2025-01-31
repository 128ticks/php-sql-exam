<?php

$dni = $_POST['dni'];
$ciudad = $_POST['ciudad'];
$fecha = $_POST['fecha'];


$errores = "";

if(empty($dni)) {
    print "No se ha podido realizar el borrado de la reserva debido al siguiente error!";
    print "<ul><li>EL campo DNI es obligatorio para el borrado de la reserva, recuerde rellenarlo</li></ul>";
    print "<a href='index.php'> PULSA AQUI PARA VOLVER AL INICIO </a>";
    return;
}

$conexion = mysqli_connect('localhost','root','','agenda') or die("FALLO EN LA BBDD");
$consulta = "SELECT * FROM reservas WHERE ciudad = '$ciudad' AND fecha = '$fecha' AND dni = '$dni';";
$resultado = mysqli_query($conexion,$consulta);

if(mysqli_num_rows($resultado) > 0) {
    $borrar = "DELETE FROM reservas WHERE dni = '$dni' AND ciudad = '$ciudad' AND fecha = '$fecha';";
    mysqli_query($conexion,$borrar);
    $filas_afectadas = mysqli_affected_rows($conexion);
    print "RESERVA BORRADA <br/>";
    print "$filas_afectadas han sido borrados!!!<br/>";
    print "<a href='index.php'> PULSA AQUI PARA VOLVER AL INICIO </a>";
} else {
    print "No hay registros con esa caracteristicas!!<br/>";
    print "<a href='index.php'> PULSA AQUI PARA VOLVER AL INICIO </a>";
}



mysqli_close($conexion);
?>