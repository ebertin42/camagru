<?php
  session_start();
  require_once "config/database.php";
  require_once "function.php";
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Camagru !</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/bulma.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  </head>
  <body>
    <header>
      <h1 class="title">C est le ptn de nom ! tammere</h1>
	  <div class="topnav" id="myTopnav">
      <center>
        <a href="index.php"><i class="fas fa-images"></i> Galery</a>
         <?php
            if (isset($_SESSION["username"]))
            {
                ?>
                <a href="shoot.php"> <i class="fa fa-camera"></i> New shoot / My Shoot</a>
                <a href="me.php"><i class="fas fa-address-card"></i> Profil -- <?php echo $user["username"]; ?></a>
                <a href="logout.php" class="active"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                <?php
            }
            else
            {
                ?>
                <a href="login.php"><i class="fas fa-sign-in-alt"></i> Log In</a>
                <a href="register.php"><i class="fas fa-door-open"></i> Register</a>
                <?php
            }
         ?>
        <a href="javascript:void(0);" style="font-size:15px;" class="icon" onclick="myFunction()">&#9776;</a>
      </center>
    </div>
  </header>
<div class="container">
  <br />
