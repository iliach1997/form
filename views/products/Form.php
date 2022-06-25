<div class="box">
<?php require_once 'mail.php' ?>
<form id="form_id"  class="name-form" method="POST" >
    <label>First Name</label>
    <input type="text"name="name" id="name_id" value="<?php echo $name?>"
     placeholder="<?php if(empty($errorname)){echo 'Enter User Name';}else{echo $errorname; }?>">
    <label>Last Name</label>
    <input type="text"  name="surname" id="surname_id" value="<?php echo $surname?>"
    placeholder="<?php if(empty($errorsurname)){echo 'Enter User LastName';}else{echo $errorsurname; }?>">
    <label>Email</label>
    <input type="email"  name="email" id="email_id" value="<?php echo $email?>"
    placeholder="<?php if(empty($erroremail)){echo 'Enter User Email';}else{echo $erroremail; }?>">
    <button  type="submit" name="submit"  class="submit" id="submit_id">Submit</button>


</form>

</div>

