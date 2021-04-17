<?php
require "../vendor/autoload.php";
use Clases\Datos;
$usuarios = new Datos('users', 50);
echo "<h2>Usuarios Creados Correctamente</h2>";