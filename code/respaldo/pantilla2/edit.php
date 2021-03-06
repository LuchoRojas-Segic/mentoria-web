<?php
	require "util/db.php";

	if (isset($_POST["Submit"])){

        $db = connectDB();
    
        $id = $_GET['id'];
        $nombre = $_POST['nombre'];

        $sql = "UPDATE users set full_name = :full_name WHERE id = :id ";
        //statement
    
        $stmt = $db->prepare($sql);  

        $stmt->bindparam(':full_name',$nombre);      
        $stmt->bindparam(':id',$id); 

        $stmt -> execute();
        $users = $stmt ->fetchAll(PDO::FETCH_ASSOC);
        //print_r($users);	

        header("Location: index.php");
	}	

    $db = connectDB();
    
    $id = $_GET['id'];
    $sql = "SELECT * FROM users WHERE id = :id ";
    //statement

    $stmt = $db->prepare($sql);   
    $stmt->bindparam(':id',$id);     
    $stmt -> execute();
    $users = $stmt ->fetchAll(PDO::FETCH_ASSOC);

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
                <form class="form-inline my-2 my-md-0">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                </form>
            </div>
        </nav>
    </div>
        
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <h1>Edit User</h1>
            <form action="" method="POST">
                <div class="form-group">

                    <?php foreach ($users as $user): ?>
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" name="nombre" value="<?=$user['full_name'] ?>" placeholder="Ingrese nombre">
                        <small class="form-text text-muted">Help message here.</small>                
                    <?php endforeach; ?>

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