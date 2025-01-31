<?php

$conexion = mysqli_connect('localhost','root','','agenda') or die("FALLO EN LA BBDD");
$tabla = "CREATE TABLE gira (
    ciudad VARCHAR(50),
    fecha DATE,
    precio FLOAT,
    entradas INT
);";

mysqli_query($conexion,$tabla);
print "<p>Tabla gira creada con exito!</p>";

$tabla = "CREATE TABLE reservas (
    dni VARCHAR(20),
    ciudad VARCHAR(50),
    fecha DATE,
    entradas_compradas INT
);";

mysqli_query($conexion,$tabla);
print "<p>Tabla reservas creada con exito!</p>";

$datos = "INSERT INTO gira VALUES
    ('bilbao','2024-12-20',20,100),
    ('bilbao','2025-06-22',20,100),
    ('madrid','2025-07-02',25,100),
    ('barcelona','2025-07-27',30,100);";

mysqli_query($conexion,$datos);
print "<p>Inserts creados con exito</p>";

mysqli_close($conexion);
?>