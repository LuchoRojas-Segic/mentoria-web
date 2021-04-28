<?php

$id = $_GET["id"];

//hago las consultas

session_start();

$_SESSION["msg-delete"] = "El registro se eliminó correctamente";

header("Location: index.php");