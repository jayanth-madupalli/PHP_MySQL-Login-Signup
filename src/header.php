<?php
  include('db.php');
  session_start();
  $is_online = false;
  if(isset($_SESSION['uid'])){
    $sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '".$_SESSION['uid']."' ");
    if(mysqli_num_rows($sql) == 1){
      $is_online = true;
      $udata = mysqli_fetch_assoc($sql);
      mysqli_query($conn, "UPDATE `users` SET `log_time`=NOW() WHERE `id` = '".$udata['id']."' ");
    }else
      session_destroy();
  }


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>[PHP_MySQL]Login - SignUp - JayanthM</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Login/SignUp</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMarkup" aria-controls="navbarMarkup" aria-expanded="false">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="index.php">Home</a>
          <?php if(!$is_online){ ?>
          <a class="nav-item nav-link" href="login.php">Login</a>
          <a class="nav-item nav-link" href="register.php">Register</a>
          <?php }else{ ?>
          <a class="nav-item nav-link" href="logout.php">Logout</a>
          <?php } ?>
        </div>
      </div>
    </nav>

