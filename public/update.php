<?php 

$id=$_GET['id']??null;
if(!$id){
    header('location:index.php');
    exit;
}
// Update according to ID
$pdo = require_once '../database.php';
$statement=$pdo->prepare('SELECT * FROM forms WHERE id=:id');
$statement->bindValue(':id',$id);
$statement->execute();
$form=$statement->fetch(PDO::FETCH_ASSOC);

$errors=[];
$name=$form['name'];
$surname=$form['surname'];
$email=$form['email'];
// Check POST
if($_SERVER['REQUEST_METHOD']==='POST'){
  $name=$_POST['name'];
  $surname=$_POST['surname'];
  $email=$_POST['email'];
  // Check errors
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
  $state=$pdo->prepare("UPDATE forms SET name=:name,surname=:surname,email=:email WHERE id=:id");
  
  $state->bindValue(':name',$name);
  $state->bindValue(':surname',$surname);
  $state->bindValue(':email',$email);
  $state->bindValue(':id',$id);
//   $state->bindValue(':date',date('Y-m-d H:i:s'));
  
  $state->execute();
  header('Location:index.php');
} 

}

 
?>
<!--import header -->
<?php require_once '../views/partials/header.php'; ?>
<!-- import form -->
<?php require_once '../views/products/Form.php';?>

</body>
</html>










