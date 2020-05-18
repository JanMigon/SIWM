<?php

include('head.php');

?>

<div class="col-sm">
    <form class="form-signin" action="create_new.php" method="POST">
        <img class="mb-4" src="logo.jpg" alt="" width="72">
        <h1 class="h3 mb-3 font-weight-normal">Wprowadź nazwę apteczki</h1>
        <label for="inputName" class="sr-only">Nazwa</label>
        <input type="text" id="inputName" name="tableName" class="form-control" placeholder="Nazwa apteczki" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Zatwierdź</button>
    </form>
</div>
</div>

<div class="row">
    <div class="col-sm">
        <p class="text-danger">
            <?php
                if(isset($_SESSION['err']))	{ echo($_SESSION['err']); unset($_SESSION['err']);}
            ?>
        </p>
        <p class="text-success">
            <?php
                if(isset($_SESSION['success_msg']))	{ echo($_SESSION['success_msg']); unset($_SESSION['success_msg']);}
            ?>
        </p>
    </div>
</div>

<?php

include('foot.html');

?>