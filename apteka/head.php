<?php
session_start();
	
if (!isset($_SESSION['logged']))
{
    header('Location: index.php');
    exit();
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="fav.ico" type="image/ico">
    <link rel="stylesheet" href="style.css">
  
</head>
<body class="text-center">

<nav class="navbar fixed-top navbar-expand-lg navbar-dark  bg-dark ">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="main.php">Apteczka</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="enterform.php">Wprowadź lek</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="giveform.php">Wydaj lek</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="utilization.php">Utylizuj</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#"> <?php echo($_SESSION['name']." ".$_SESSION['lname'])?> </a>
      </li>
        <li class="nav-item">
            <a class="nav-link " href="logout.php">Wyloguj</a>
          </li>
      </ul>
  </nav>

  <div class="container mt-5 pt-5">
    <div class="row">