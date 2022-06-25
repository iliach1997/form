<?php 

if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $surname=$_POST['surname'];
    $email=$_POST['email'];
  
     $errorsurname;
     $erroremail;
     $errorname;
    if(empty($name)){
      $errorname='User Name is required !!!';
      
        
    }
    if(empty($surname)){
     $errorsurname= 'User LastName is required !!!';
    }
    if(empty($email)){
        $erroremail='User Email is requared !!!';
    }

   
}


?>
