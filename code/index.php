<?php

    session_start();

    require "util/db.php";
    $db = connectDB();

    $sql = "SELECT * FROM users";
    //statement

    $stmt = $db->prepare($sql);
    $stmt -> execute();
    $users = $stmt ->fetchAll(PDO::FETCH_ASSOC);
    //print_r($users);

    function getFirstName($name) {
        return implode(' ', array_slice(explode(' ', $name), 0, -1));
    }    

    function getLastName($name) {
        return array_slice(explode(' ', $name), -1)[0];
    }  

    if(isset($_SESSION["msg-delete"])){
        $mensaje = $_SESSION["msg-delete"];
        $_SESSION["msg-delete"] = "";
        //unset($_SESSION["msg-delete"] );
    }
    

?>

<!doctype html>
<html lang="en" class="h-100">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">

    <title>Lista de Usuarios</title>
   
  </head>
  <body class="d-flex flex-column h-100">
    <?php if(isset($mensaje)): ?>
        <p><?=$mensaje ?></p>
    <?php endif; ?>
    
    <div class="container pt-4 pb-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <a class="navbar-brand" href="#">HTML CRUD Template</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="create.php">Create</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://pisyek.com/contact">Help</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-md-0" method="POST">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </nav>
    </div>
        
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1>Lista de Usuarios</h1>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>

                <?php foreach ($users as $key => $user): ?>
                    <tr>                 
                        <td><?= $key + 1 ?></td>
                        <td><?= $firstName = getFirstName($user['full_name']) ?></td>
                        <td><?= $lastName = getLastName($user['full_name']) ?></td>              
                        <td>
                            <a href="view.php?id=<?=$user['id']?>"><button class="btn btn-primary btn-sm">View</button></a>
                            <a href="edit.php?id=<?=$user['id']?>"><button class="btn btn-outline-primary btn-sm">Edit</button></a>
                            <!-- <button class="btn btn-sm">Delete</button>-->
                            <a href="delete.php?id=<?=$user['id']?>"><button class="btn btn-sm" name = "Borrar">Delete</button></a>    
                        </td>

                    </tr>
                <?php endforeach; ?>


            </table>
        </div>
    </main>
      
    <footer class="footer mt-auto py-3">
        <div class="container pb-5">
            <hr>
            <span class="text-muted">
                    Copyright &copy; 2021 | <a href="https://pisyek.com">Pisyek.com</a>
            </span>
        </div>
    </footer>

    
    <script src="assets/js/jquery-3.3.1.slim.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
  </body>
</html>