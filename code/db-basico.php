<?php

$dbname = "registro";
$dbuser = "registro-user";
$dbpassword = "registro-user";

try{
   $dsn =  "mysql:host=localhost;dbname=$dbname";
   $db = new PDO($dsn, $dbuser, $dbpassword);
} catch(PDOException $e) {
       echo $e->getMessage();

       
//Preparar consulta

/*$sql="INSERT INTO users 
               (full_name, email, user_name, password)
      VALUES(:full_name, :email, :user_name, :password)";

      //statemest

$stmt = $db->prepare($sql);

$full_name = 'Juan Perez';
$email = 'juan.perez@segic.cl';
$user_name = 'juan.perez';
$password= password_hash('juan123', PASSWORD_DEFAULT);

$stmt->bindParam(':full_name',$full_name);
$stmt->bindParam(':email',$email);
$stmt->bindParam(':user_name',$user_name);
$stmt->bindParam(':password',$password);

$stmt -> execute();*/

//delete

/*$id = 3;

$stmt = $db->prepare("DELETE FROM users WHERE id=:id");
$stmt->bindparam(':id',$id);
$stmt->execute();*/


//Insert masivo

$users = [
   [ 'name'=>'Miguel Perez', 
     'email'=>'miguel.perez@segic.cl', 
     'user_name'=>'miguel.perez',
     'password'=>'miguel123'
   ],      
   [ 'name'=>'Andrea Perez', 
     'email'=>'andrea.perez@segic.cl', 
     'user_name'=>'andrea.perez',
     'password'=>'andrea123'
   ],
];

$sql="INSERT INTO users (full_name, email, user_name, password)
      VALUES(:full_name, :email, :user_name, :password)";

//statemest

$stmt = $db->prepare($sql);

foreach($users as $user){
   $full_name = $user['name'];
   $email = $user['email'];
   $user_name = $user['user_name'];
   $password = password_hash($user['password'], PASSWORD_DEFAULT);
   

   $stmt->bindParam(':full_name',$full_name);
   $stmt->bindParam(':email',$email);
   $stmt->bindParam(':user_name',$user_name);
   $stmt->bindParam(':password',$password);

   $stmt -> execute();
}




