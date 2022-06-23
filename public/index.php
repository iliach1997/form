<?php
// starting public folder localhost:8080

$pdo = require_once '../database.php';

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
    // Check errors
  if(!$name){
    $errors[]='User Name is required !!!';
  }
  if(!$surname){
    $errors[]='User LastName is required !!!';
  }
  if(!$email){
    $errors[]='User Email is required !!!';
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
  
}



?>
<!-- errors alert -->
<?php if (!empty($errors)):?>

<?php foreach($errors as $error): ?>
   <div class="error-div"><?php echo $error ?></div>
  <?php endforeach;?> 
  
  <?php endif ?>
  <!-- import header -->
<?php require_once '../views/partials/header.php'; ?>


<!-- import form -->
 <?php require_once '../views/products/Form.php'; ?>
</section>
<!-- table section -->
<section>
<div class="table-box">
    <table className="table">
        <thead>
          <tr >

            <td class="table_td"></td>
            <td class="table_td">Name</td>
            <td class="table_td">LastName</td>
            <td class="table_td">Email</td>
           
   
      
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
                <div class="div-buttom">
                <button class="edit-button" ><a href="update.php?id=<?php echo $form['id']?>">Edit</a></button>
            <form method="post" action="delete.php" class="button-form">
                <input type="hidden" name="id" value="<?php echo $form['id']?>"/>
                <button  class="delete-button">Delete</button>
            </form>
              </div>
            </td>
          </tr>

          <?php } ?>

        </tbody>
      </table>
</div>
</section>


</body>
</html>