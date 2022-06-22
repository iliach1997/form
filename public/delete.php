<?php
$pdo = require_once '../database.php';
$id=$_POST['id']??null;
if(!$id){
    header('location:index.php');
    exit;
}
$statement=$pdo->prepare('DELETE FROM forms WHERE id = :id ');
$statement->bindValue(':id',$id);
$statement->execute();
header('location:index.php');
exit;
  echo '<pre>';
  var_dump($_GET);
  echo '<pre>';
?>