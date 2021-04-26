<?php

    session_start();

    if(!isset($_SESSION['nombre'])){
        header("Location: index.php");
    }
    echo "Hola ".$_SESSION['nombre'];
    require "util/db.php";
    $db = connectDB();

    $sql = "SELECT * FROM users";
    //statement

    $stmt = $db->prepare($sql);
    $stmt -> execute();
    $users = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    //print_r($users);
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>

</head>
<body>
    <?"Hola, ". $_SESSION['nombre'];?>
    <a href="logout.php">(Salir)</a>

    <h1>Lista de Usuarios disponibles</h1>

    <table border="1">
        <tr>    
            <th>Full name</th>
            <th>Username</th>
            <th>Email</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['full_name'] ?></td>
                <td><?= $user['user_name'] ?></td>
                <td><?= $user['email'] ?? 'Sin correo'  ?></td>                
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>