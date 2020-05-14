<?php

	session_start();
	
	if (isset($_SESSION['logged']))
	{
    unset($_SESSION['err']);
    header('Location: main.php');
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
  
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      html,
        body {
        height: 100%;
        }

        body {
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
        }
    </style>
  </head>
  <body class="text-center">

    <form class="form-signin" action="verify.php" method="POST">
        <img class="mb-4" src="logo.jpg" alt="" width="72">
        <h1 class="h3 mb-3 font-weight-normal">Zaloguj się</h1>
        <label for="inputEmail" class="sr-only">Adres email</label>
        <input type="email" id="inputEmail" name="mail" class="form-control" placeholder="Adres email" required>
        <label for="inputPassword" class="sr-only">Hasło</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Hasło" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Zaloguj</button>
    </form>

    <button class="btn" onclick="Redirect('signup')">Zarejestruj się</button>

    <br>
    <p class="text-danger">
    <?php
	    if(isset($_SESSION['err']))	{echo($_SESSION['err']); unset($_SESSION['err']);}
    ?>
    </p>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>
</html>
