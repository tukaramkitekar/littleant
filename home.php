<?php
include 'database/dbconnect.php';
session_start();
$user_id = $_SESSION['user_id'];
if(!isset($user_id)){
   header('location:user/signin.php');
};
if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:user/signin.php');
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
    <title>Newtry | Home</title>
    <style>
          *{margin:0; padding:0;}
          nav{background:black; height:65px; width:100%;}
          .navleft{float:left; width:20%;}
          .navcenter{float:left; width:65%;}
          
                 ul{margin:20px; margin-inline:60px; margin-top:15px;}
                   ul li{display:inline-block; margin:0 20px;}
                      ul li a{text-decoration:none; list-style:none; color:white; font-size:20px; font-family:Dubai;}
         .navright{float:left; width:10%;}
          .navright2{float:right; width:5%;}
           .navright2 img{
  
  margin-top: 12px;
  margin-inline:13px;
  width: 40px;
  height: 40px;
  border-radius: 100%;
  overflow: hidden;
  background-color: blue;

   object-fit: cover;}
    </style>
</Head>


<body>
<Header>
<nav>
    <div class="navleft">
                        <img src="assets/logo.png" width="100px" style="margin-inline:40px; margin-top:4px;">
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
    <h2><i class="fa-solid fa-magnifying-glass" style="color:white; margin-top:20px;"></i> <i class="fa-solid fa-cart-plus" style="color:white; margin-top:20px; margin-inline:35px;"></i></h2>
           </div>


    <div class="navright2">
    <a href="user/account.php">
    <?php
         $select = mysqli_query($conn, "SELECT * FROM `users` WHERE id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select) > 0){
            $fetch = mysqli_fetch_assoc($select);
         }
         if($fetch['image'] == ''){
            echo '<img src="assets/default-avatar.png">';
         }else{
            echo '<img src="user/uploaded_img/'.$fetch['image'].'">' ;
         }
         
      ?>
    </div>
      

</nav>  
</Header>



</body>
</html>