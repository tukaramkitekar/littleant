<?php
include '../database/dbconnect.php';
session_start();
if(isset($_POST['submit'])){
$email = mysqli_real_escape_string($conn, $_POST['email']);
$pass = mysqli_real_escape_string($conn, md5($_POST['password']));
$select = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');
if(mysqli_num_rows($select) > 0){
   $row = mysqli_fetch_assoc($select);
   $_SESSION['user_id'] = $row['id'];
   header('location: ../home.php');}
   else{
      $message[] = 'incorrect email or password!';}
}
?>



<!DOCTYPE html>
<html lang="en">
<Head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <title>littleant | Sigin</title>
    <style>
          *{margin:0; padding:0;}
          nav{background:black; height:65px; width:100%;}
          .form-container{width:350px; height:350px; background:blue; margin-inline:500px;}
          .formdiv1{width:350px; height:50px; background:blue;}
          .formdiv2{width:350px; height:300px; background:linear-gradient(orange,green); border-top-left-radius:15px; border-top-right-radius:15px;}
    </style>
</Head>


<Body>
<Header>
<nav>
    <center><img src="../assets/logo.png" width="100px" style="margin-top:4px;"></center>
</nav>
</Header>


<Main>
<h1 style="margin-inline:10px; margin-top:10px"><i class="fa-solid fa-arrow-left"></i></h1>
<br><br>
<div class="form-container">
     <form action="" method="post" enctype="multipart/form-data">
 <div class="formdiv1">
     <h1 align="center" style="color:white; font-family:cursive">Log In To Account</h1>
</div>
     <?php
         if(isset($message)){
         foreach($message as $message){
         echo '<div class="message">'.$message.'</div>';}}
     ?>
<div class="formdiv2">
    <br><br>
    <center>
     <input type="email" name="email" placeholder="enter email address...." class="box" required style="width:235px; height:35px; outline:none; border-color:black;"><br><br>
     <input type="password" name="password" placeholder="enter password...." class="box" required style="width:235px; height:35px; outline:none; border-color:black;"><br><br><br>
     <input type="submit" name="submit" value="login now" class="btn" style="width:130px; height:35px; border-radius:20px; font-size:20px;">
    </center><br>
     <p style="font-family:cursive; color:white; margin-inline:10px;">Don't have an account? <br>
     <button style="width:180px; height:30px;"><a href="signup.php" style="text-decoration:none; list-style:none; font-size:20px;">Create An Account</a></button></p>
</div>
</form>
</div>
</Main>
</Body>
</HTML>