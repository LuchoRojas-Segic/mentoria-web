<?php
	require "util/db.php";

	if (isset($_POST["Submit"])){

        $db = connectDB();
    
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $pass=password_hash($password, PASSWORD_DEFAULT);

        $sql="INSERT INTO users (full_name, email, user_name, password)
                VALUES(:full_name, :email, :user_name, :password)";
        //statement
    
        $stmt = $db->prepare($sql);  
        
        $stmt->bindParam(':full_name',$nombre);
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':user_name',$username);
        $stmt->bindParam(':password',$pass);
     
        $stmt -> execute();
        $users = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        //print_r($users);	

        header("Location: index.php");
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
    
    <div class="container pt-4 pb-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <a class="navbar-brand" href="#">HTML CRUD Template</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarsExample09">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="create.php">Create</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="https://pisyek.com/contact">Help</a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-md-0">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </nav>
    </div>
        
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1>Crear Nuevo Usuario</h1>
            <form action="" method="POST">
                <div class="form-group">                                    
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre">
                    <small class="form-text text-muted">Help message here.</small>

                    <label for="name">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Ingrese Email">                        
                    <small class="form-text text-muted">Help message here.</small>

                    <label for="name">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese Username">
                    <small class="form-text text-muted">Help message here.</small>

                    <label for="name">Password</label>
                    <input type="text" class="form-control" id="password" name="password" placeholder="*****">
                    <small class="form-text text-muted">Help message here.</small>
                </div>
                <button type="submit" class="btn btn-primary" name = "Submit">Submit</button>
            </form>
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