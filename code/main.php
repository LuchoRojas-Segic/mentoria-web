<?php

session_start();

if(isset($_SESSION['nombre'])){
    header("Location: index.php");
}
echo "Hola ".$_SESSION['nombre'];