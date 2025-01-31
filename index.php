<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INDICE</title>
</head>
<body>
<h1>GIRA MIKELDI - Temporada 2024-2025</h1>
<?php
$conexion = mysqli_connect('localhost','root','','agenda') or die("FALLO EN LA BBDD");
$consulta = "SELECT * FROM gira;";
$resultado = mysqli_query($conexion,$consulta);

print "<table border='1'>";
    print "<tr>";
        print "<th>Ciudad</th>";
        print "<th>Fecha</th>";
        print "<th>Precio</th>";
        print "<th>Entradas</th>";
    print "</tr>"; // 

while ($filas = mysqli_fetch_array($resultado)) {
    print "<tr>";
        print "<td>" . $filas['ciudad'] . "</td>";
        print "<td>" . $filas['fecha'] . "</td>";
        print "<td>" . $filas['precio'] . "</td>";
        print "<td>" . $filas['entradas'] . "</td>";
    print "</tr>";
}
print "</table>";
?>

<h3>COMPRA ENTRADAS </h3>
<form action="comprar.php" method="post">
    DNI: <input type="text" name="dni">
    Ciudad: 
    <select name="ciudad">
        <?php 
        $conexion = mysqli_connect('localhost','root','','agenda') or die("FALLO EN LA BBDD");
        $consulta = "SELECT DISTINCT(ciudad) FROM gira;";
        $resultado = mysqli_query($conexion,$consulta);
        while ($filas = mysqli_fetch_array($resultado)) {
            print "<option value='" . $filas['ciudad']. "'> ". $filas['ciudad'] . "</option>";
        }
    print "</select>";
    print " Fecha:";
    print "<select name='fecha'>";
        $conexion = mysqli_connect('localhost','root','','agenda') or die("FALLO EN LA BBDD");
        $consulta = "SELECT * from gira;";
        $resultado = mysqli_query($conexion,$consulta);
        while ($filas = mysqli_fetch_array($resultado)) {
            print "<option value='" . $filas['fecha']. "'> ". $filas['fecha'] . "</option>";
        }
    print "</select>";    
    ?>    
    N Entradas :<input type="radio" name="entrada" value="1">1
                <input type="radio" name="entrada" value="2">2
                <input type="radio" name="entrada" value="3">3
                <input type="radio" name="entrada" value="4">4
    
    <input type="submit" value="Comprar">
    <input type="reset" value="Limpiar">
</form>

<h3>DEVOLUCION DE ENTRADAS </h3>
<p> Rellene los siguientes campos: </p>
<form action="devolver.php" method="post">
    DNI: <input type="text" name="dni">
    Ciudad: 
    <select name="ciudad">
        <?php 
        $conexion = mysqli_connect('localhost','root','','agenda') or die("FALLO EN LA BBDD");
        $consulta = "SELECT DISTINCT(ciudad) FROM gira;";
        $resultado = mysqli_query($conexion,$consulta);
        while ($filas = mysqli_fetch_array($resultado)) {
            print "<option value='" . $filas['ciudad']. "'> ". $filas['ciudad'] . "</option>";
        }
    print "</select>";
    print " Fecha:";
    print "<select name='fecha'>";
        $conexion = mysqli_connect('localhost','root','','agenda') or die("FALLO EN LA BBDD");
        $consulta = "SELECT * from gira;";
        $resultado = mysqli_query($conexion,$consulta);
        while ($filas = mysqli_fetch_array($resultado)) {
            print "<option value='" . $filas['fecha']. "'> ". $filas['fecha'] . "</option>";
        }
    print "</select>";    
    ?>    
    
    <input type="submit" value="Devolucione">
    <input type="reset" value="Limpiar">
</form>
<?php
mysqli_close($conexion);
?>
</body>
</html>