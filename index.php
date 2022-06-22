
<?php 
$pdo=new PDO('mysql:host=localhost;dbname=forms-crud','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$statement=$pdo->prepare('SELECT * FROM forms ORDER BY create_date DESC');
$statement->execute();
$forms=$statement->fetchAll(PDO::FETCH_ASSOC);

$errors=[];
$name='';
$surname='';
$email='';

if($_SERVER['REQUEST_METHOD']==='POST'){
  $name=$_POST['name'];
  $surname=$_POST['surname'];
  $email=$_POST['email'];
  
  if(!$name){
    $errors[]='User Name is required';
  }
  if(!$surname){
    $errors[]='User LastName is required';
  }
  if(!$email){
    $errors[]='User Email is required';
  }
  if(empty($errors)){ 
  $state=$pdo->prepare("INSERT INTO forms (name,surname,email,create_date)
  VALUE(:name,:surname,:email,:date)");
  
  $state->bindValue(':name',$name);
  $state->bindValue(':surname',$surname);
  $state->bindValue(':email',$email);
  $state->bindValue(':date',date('Y-m-d H:i:s'));
  
  $state->execute();
} 
  //  echo '<pre>';
  //  var_dump($errors);
  //  echo '<pre>';
}










?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    
    <title>Document</title>
</head>

<body class="body-box">
    <section id="ilo">
<div class="box">

<form  class="name-form" method="post">
    <label>First Name</label>
    <input type="text" placeholder="" name="name" value="<?php echo $name?>">
    <label>Last Name</label>
    <input type="text" placeholder="" name="surname" value="<?php echo $surname?>">
    <label>Email</label>
    <input type="email" placeholder="" name="email" value="<?php echo $email?>">
    <button type="submit"  class="submit">Submit</button>
</form>

</div>
</section>
<section>
<div class="table-box">
    <table className="table">
        <thead>
          <tr>
             <td >#</td>
            <td scope="col">Name</td>
            <td scope="col">LastName</td>
            <td scope="col">Email</td>
      
          </tr>
      
        </thead>
        <tbody> 
          <?php foreach ($forms as $i => $form){ ?>

           <tr>
            <th><div class="th-div"><?php echo $i ?></div></th>
            <td><div class="th-div"><?php echo $form['name'] ?></div></td>
            <td><div class="th-div"><?php echo $form['surname'] ?></div></td>
            <td><div class="th-div"><?php echo $form['email'] ?></div></td>
            <td>
                <button class="edit-button" >Edit</button>
            <form method="post" action="delete.php" class="button-form">
                <input type="hidden" name="id" value="<?php echo $form['id']?>"/>
                <button  class="delete-button">Delete</button>
            </form>
              
            </td>
          </tr>

          <?php } ?>

        </tbody>
      </table>
</div>
</section>


</body>
</html>