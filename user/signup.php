<?php
include '../database/dbconnect.php';
if(isset($_POST['submit'])){
$name = mysqli_real_escape_string($conn, $_POST['name']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$mob = mysqli_real_escape_string($conn, $_POST['mob']);
$dob = mysqli_real_escape_string($conn, $_POST['dob']);
$address = mysqli_real_escape_string($conn, $_POST['address']);
$pass = mysqli_real_escape_string($conn, md5($_POST['password']));
$cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));


$image = $_FILES['image']['name'];
$image_size = $_FILES['image']['size'];
$image_tmp_name = $_FILES['image']['tmp_name'];
$image_folder = 'uploaded_img/'.$image;
$select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');
if(mysqli_num_rows($select) > 0){
   $message[] = 'user already exist'; }
   else{
if($pass != $cpass){
   $message[] = 'confirm password not matched!';}
   elseif($image_size > 2000000){
          $message[] = 'image size is too large!';}
   else{
        $insert = mysqli_query($conn, "INSERT INTO `user_form`(name, email, mob, dob, address, password, image) VALUES('$name', '$email', '$mob', '$dob', '$address', '$pass', '$image')") or die('query failed');
if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:signin.php');}
   else{
            $message[] = 'registeration failed!';}
}
}
}
?>



<!DOCTYPE html>
<html lang="en">
<Head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <title>Newtry</title>
    <style>
          *{margin:0; padding:0;}
          nav{background:black; height:65px; width:100%;}
    </style>
</Head>


<Body>
<Header>
<nav>
    <center><img src="../assets/logo.png" width="150px" style="margin-top:4px;"></center>
</nav>
</Header>

<Main>
<form action="" method="post" enctype="multipart/form-data">
   <h3>register now</h3>
   <?php
   if(isset($message)){
      foreach($message as $message){
         echo '<div class="message">'.$message.'</div>';
      }
   }
   ?>
   <input type="text" name="name" placeholder="enter username" class="box" required>
   <input type="email" name="email" placeholder="enter email" class="box" required>
   <input type="number" name="mob" placeholder="enter mobile" class="box" required>
   <input type="text" name="dob" placeholder="enter dob" class="box">
   <input type="text" name="address" placeholder="enter address" class="box">
   <input type="password" name="password" placeholder="enter password" class="box" required>
   <input type="password" name="cpassword" placeholder="confirm password" class="box" required>
   <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">

   <input type="submit" name="submit" value="register now" class="btn">
   <p>already have an account? <a href="signin.php">login now</a></p>
</form>
</Main>
</Body>
</HTML>