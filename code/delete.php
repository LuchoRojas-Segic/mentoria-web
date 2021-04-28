<?php

    require "util/db.php";

    $db = connectDB();

    $id = $_GET['id'];

    $sql = "DELETE FROM users WHERE id = :id ";
    //statement

    $stmt = $db->prepare($sql);  

    $stmt->bindparam(':id',$id); 

    $stmt -> execute();
    $users = $stmt ->fetchAll(PDO::FETCH_ASSOC);

    session_start();

    $_SESSION["msg-delete"] = "El registro se eliminó correctamente";

    header("Location: index.php");