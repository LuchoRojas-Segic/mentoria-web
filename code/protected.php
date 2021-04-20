<?php

session_start();

if (ISSET($_SESSION['válido'])){
    header("location: index.php");

}

echo "Info super secreta";