<?php 
error_reporting(E_ALL) ;
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homework4 PHP</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <header class="d-flex flex-row-reverse bg-light">
        <div class="row mx-1 header">
            <div class="col-3 d-flex flex-row justify-content-between">
                <?php include_once("autorization.php"); ?>
            </div>
        </div>
    </header>
    <?php 
    if (!isset($_SESSION['user'])) {
        ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-warning" role="alert">
                <strong>Необходимо авторизоваться!</strong>
            </div>
        </div>
    </div>
    
    <div class="divcenter main">
        <div class="row">
            <input type="button" class="btnclass btn-primary" name="addSector" value="Add Sector">
        </div>
        <div class="row">
            <input type="button" class="btnclass btn-secondary" name="addCategory" value="Add Category" onclick="location.href='category.php'">
        </div>
        <div class="row">            
            <input type="button" class="btnclass btn-secondary" name="addProduct" value="Add Product" onclick="location.href='product.php'">
        </div>
        <div class="row">
            <form method="POST">
                <div style="width: 100%">
                    <input type="button" class="btnclass btn-primary" name="logout" value="Log Out">
                </div>
            </form>
        </div>
    </div>
    <?php
}
else {
    $now = time();
    if ($now > $_SESSION['expire']) {
        session_destroy();
        echo '<script>window.location.reload()</script>';
    }
}

    if(isset($_POST['logout'])) {
        if(isset($_SESSION['ruser'])) {
            //session_destroy();
            unset($_SESSION['ruser']);
            echo $_SESSION['ruser'];
            echo '<script>window.location.reload()</script>';
        }
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>