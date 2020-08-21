<?php 
error_reporting(E_ALL) ;
include_once("functions.php");
$link = connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homework4 PHP</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="divcenter prod ">
        <div class="row">
          <div class="col-7 d-flex justify-content-between mb-4">
            <h4>Product adding</h4>
            <span>
                <input type="button" class="btn btn-outline-dark" name="to-main" value="Get back on main page" onclick="location.href='index.php'">
            </span>
          </div>
        </div>
        <div class="row content">  
            <div class="col-12">
            <form action='product.php' method='post' class='input-form' id='formproducts'>
                <div class='form-group row'>
                    <label for='name' class='col-2 col-form-label'>Name:</label>
                    <input type='text' name='prodname' id='name' class='col-6 form-control' onchange='check();'>
                    <div class="col-4 text-danger" id="nameerror"></div>
                </div>
                <div class='form-group row'>
                    <label for='price' class='col-2 col-form-label'>Price:</label>
                    <input type='text' name='price' id='price' class='col-6 form-control' onchange='check();'>
                    <div class="col-4 text-danger" id="priceerror"></div>
                </div>
            <?php
            echo '<div class="form-group row">
                    <label for="category" class="col-2 col-form-label">Category:</label>
                    <select name="category" id="category" class="col-6 form-control">';
            $res = mysqli_query($link, 'SELECT id, category FROM categories');
            while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                echo "<option value='$row[0]'>$row[1]</option>";
            }
            mysqli_free_result($res);
            echo "</select></div>";
            ?>
                <div class='form-group row'>
                    <label for='make' class='col-2 col-form-label'>Make:</label>
                    <input type='text' name='make' id='make' class='col-6 form-control' onchange='check();'>
                    <div class="col-4 text-danger" id="makeerror"></div>
                </div>
                <div class='form-group row'>
                    <label for='model' class='col-2 col-form-label'>Model:</label>
                    <input type='text' name='model' id='model' class='col-6 form-control' onchange='check();'>
                    <div class="col-4 text-danger" id="modelerror"></div>
                </div>
                <div class='form-group row'>
                    <label for='country' class='col-2 col-form-label'>Country:</label>
                    <input type='text' name='country' id='country' class='col-6 form-control' onchange='check();'>
                    <div class="col-4 text-danger" id="countryerror"></div>
                </div>
                <div class='form-group row'>
                    <label for='desc' class='col-2 col-form-label'>Description:</label>
                    <textarea name='desc' id='desc' class='col-6 form-control'></textarea>
                </div>
                <input type='submit' name='addproduct' value='Add' id='addprod' class='btn btn-primary col-8' disabled>
            </form>
<?php
            if(isset($_POST['addproduct'])) {
                $name = trim(htmlspecialchars($_POST['prodname']));
                $price = intval(trim(htmlspecialchars($_POST['price'])));
                $categoryid = $_POST['category'];
                $make = trim(htmlspecialchars($_POST['make']));
                $model = trim(htmlspecialchars($_POST['model']));
                $country = trim(htmlspecialchars($_POST['country']));
                if(isset($_POST['desc'])) {
                    $desc = trim(htmlspecialchars($_POST['desc']));
                } else $desc = "";

                $res_sect = mysqli_query($link, "SELECT sectorid FROM categories WHERE id=$categoryid");
                $row_sect = mysqli_fetch_array($res_sect, MYSQLI_NUM);
                $sectorid = $row_sect[0];
                mysqli_free_result($res_sect);


                $result = mysqli_query($link, "SELECT `product` FROM `products` WHERE `product`=$name");
                if(mysql_num_rows($result) <= 0) {
                    $ins = "INSERT INTO `products`(`product`, `price`, `categoryid`, `sectorid`, `make`, `model`, `country`, `info`) VALUES('$name', '$price', '$categoryid', '$sectorid', '$make', '$model', '$country', '$desc')";
                    mysqli_query($link, $ins);
                    
                    $err = mysqli_errno($link);
                    if($err) {
                        echo "<h5 class='text-danger'>Error code ".$err."</h5>";
                        exit;
                    }
                } else {
                    $upd = "UPDATE `products` SET price=$price, categoryid=$categoryid, sectorid=$sectorid, make=$make, model=$model, country=$country, info=$desc WHERE product=$name";
                    mysqli_query($link, $upd);
                    if(mysqli_error($link)) {
                        echo "Error text:". mysqli_error($link);
                        exit;
                    } else {
                        echo "<h5 class='text-success'>Данные по $name обновлены!</h5>";
                        exit;
                    }
                }
                echo '<script>window.location = document.URL</script>';
            }
            ?>
            </div>
        </div>   
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>
    let valid;
    var limit = "Not more than 20 chars";
    
    function check() {
        valid = 0;
        let name = document.querySelector('input#name').value.length;
        let nameerr = document.querySelector('#nameerror');
        if (name == 0) nameerr.innerText = "Name cannot be empty";
        if (name > 20) nameerr.innerText = limit;
        if (name != 0 & name < 21) {
            nameerr.innerText = "";
            valid++;
        }
       
        let price = document.querySelector('input#price').value
        if (price == "") {
            document.querySelector('#priceerror').innerText = "Price cannot be 0";
        } else {
            document.querySelector('#priceerror').innerText = "";
            valid++;
        }
        
        let make = document.querySelector('input#make').value.length;
        let makeerr = document.querySelector('#makeerror');
        if (make == 0) makeerr.innerText = "Make cannot be empty";
        if (make > 20) makeerr.innerText = limit;
        if (make != 0 & make < 21) {
            makeerr.innerText = "";
            valid++;
        }

        let model = document.querySelector('input#model').value.length;
        let modelerr = document.querySelector('#modelerror');
        if (model == 0) modelerr.innerText = "Model cannot be empty";
        if (model > 20) modelerr.innerText = limit;
        if (model != 0 & model < 21) {
            modelerr.innerText = "";
            valid++;
        }

        let country = document.querySelector('input#country').value.length;
        let countryerr = document.querySelector('#countryerror');
        if (country == 0) countryerr.innerText = "Model cannot be empty";
        if (country > 20) countryerr.innerText = limit;
        if (model != 0 & model < 21) {
            countryerr.innerText = "";
            valid++;
        }
        
        if (valid == 5) {
            $("#addprod").removeAttr("disabled");
        }
    }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>