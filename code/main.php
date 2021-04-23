<?php

session_start();

if(isset($_SESSION['nombre'])){
    header("Locatio: index.php");
}
echo "Hola ".$_SESSION['nombre'];