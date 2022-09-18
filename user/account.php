<?php
include '../database/dbconnect.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:signin.php');
};
if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:signin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<Head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.css">
    <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
    <title>Newtry | Home</title>
    <style>
          *{margin:0; padding:0;}
          nav{background:black; height:65px; width:100%;}
          .navleft{float:left; width:20%;}
          .navcenter{float:left; width:65%;}
          .navright{float:right; width:15%;}
          ul{margin:20px; margin-inline:60px; margin-top:15px;}
          ul li{display:inline-block; margin:0 20px;}
          ul li a{text-decoration:none; list-style:none; color:white; font-size:20px; font-family:Dubai;}

          .navright{float:right; width:10%;}
           .navright img{
  
  margin-top: 14px;
  margin-inline:13px;
  width: 40px;
  height: 40px;
  border-radius: 100%;
  overflow: hidden;
  background-color: blue;

   object-fit: cover;}

   .imagediv img{
    margin-top: 23px;
  margin-inline:13px;
  width: 180px;
  height: 180px;
  border-radius: 100%;
  overflow: hidden;
  background-color: blue;

   object-fit: cover;
   }



   .personal{width:1200px; height:500px; background:linear-gradient(#43cea2, #185a9d); margin-top:50px; margin-inline:70px; border-radius:10px;}
   .personal1{float:left; width:400px;}
   .personal2{float:right; width:800px;}
    </style>
</Head>


<body>
<Header>
<nav>
    <div class="navleft">
                        <img src="../assets/logo.png" width="100px" style="margin-inline:40px; margin-top:4px;">
    </div>
    <div class="navcenter">
                          <ul>
                             <li><a href="#"><i class="fa-solid fa-mobile" style="color:white"></i> Mobiles</a></li>
                             <li><a href="#"><i class="fa-solid fa-computer" style="color:white"></i> Computers</a></li>
                             <li><a href="#"><i class="fa-solid fa-radio" style="color:white"></i> Speakers</a></li>
                             <li><a href="#"><i class="fa-regular fa-clock" style="color:white"></i> Watch</a></li>
                             <li><a href="#"><i class="fa-solid fa-book" style="color:white"></i> Books</a></li>
                          </ul>
    </div>
    <div class="navright">

    <?php
         $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="assets/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">' ;
         }
         
      ?>
                         
    </div>
</nav>  
</Header>



<div class="personal">

<div class="personal1">

<div class="imagediv">
    <br><br><br><br>
<center>
<?php
         $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="images/default-avatar.png">';
         }else{
            echo '<img src="uploaded_img/'.$fetch['image'].'">';
         }
      ?>
         </a>
        </center>
                 <br>
                <center> <h1 style="font-family:Dubai"><?php echo $fetch['name']; ?></h1></center>
        </div>
</div>



<div class="personal2">





   <div class="profile">
 <h1 align="center">Personal Information</h1>
 <button style="float:right">Update Profile</button>
        <br><br><br><br>

        <h2 style="font-family:Dubai">Name:<?php echo $fetch['name']; ?></h2>
        <h2 style="font-family:Dubai">Email:<?php echo $fetch['email']; ?></h2>
        <h2 style="font-family:Dubai">Mobile:<?php echo $fetch['mob']; ?></h2>
        <h2 style="font-family:Dubai">DOB:<?php echo $fetch['dob']; ?></h2>
        <h2 style="font-family:Dubai">Address:<?php echo $fetch['address']; ?></h2>
        <a href="../index.php">logout</a>
  
   </div>


</div>

</div>

    

