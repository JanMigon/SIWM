<?php

include('head.php');

?>

<div class="col-sm">
    <form class="form-signin" action="enter.php" method="POST">
        <img class="mb-4" src="logo.jpg" alt="" width="72">
        <h1 class="h3 mb-3 font-weight-normal">Wprowadź nowe lekarstwo</h1>
        <label for="inputName" class="sr-only">Nazwa</label>
        <input type="text" id="inputName" name="name" class="form-control" placeholder="Nazwa" required>
        <label for="inputQty" class="sr-only">Ilość</label>
        <input type="number" id="inputQty" name="quantity" class="form-control" placeholder="Ilość" required>
        <label for="inputPrice" class="sr-only">Cena</label>
        <input type="number" id="inputPrice" name="price" class="form-control" placeholder="Cena" required>
        <label for="inputExpDate" class="sr-only">Data ważności</label>
        <input type="date" id="inputExpDate" name="expirationDate" class="form-control" placeholder="Data ważności" required>
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