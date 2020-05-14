<?php

session_start();

?>
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

<form class="form-signin" action="saveuser.php" method="POST">
    <img class="mb-4" src="logo.jpg" alt="" width="72">
    <h1 class="h3 mb-3 font-weight-normal">Zarejestruj się</h1>

    <label for="inputName" class="sr-only">Imię</label>
    <input type="text" id="inputName" name="name" class="form-control" placeholder="Imię" required>

    <label for="inputLName" class="sr-only">Nazwisko</label>
    <input type="text" id="inputLName" name="lname" class="form-control" placeholder="Nazwisko" required>

    <label for="inputEmail" class="sr-only">Adres email</label>
    <input type="email" id="inputEmail" name="mail" class="form-control" placeholder="Adres email" required>

    <label for="inputPassword" class="sr-only">Hasło</label>
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Hasło" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Dodaj</button>
</form>

<br>
    <p class="text-danger">
    <?php
	    if(isset($_SESSION['err']))	{ echo($_SESSION['err']); unset($_SESSION['err']);}
    ?>
    </p>

<?php

include('foot.html');

?>