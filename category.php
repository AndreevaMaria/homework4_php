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
    <div class="divcenter cat">
        <div class="d-flex justify-content-between mb-4">
            <h4>Category adding</h4>
            <span>
                <input type="button" class="btn btn-outline-dark" name="to-main" value="Get back on main page" onclick="location.href='index.php'">
            </span>
        </div>
        <?php
        $res = mysqli_query($link, 'SELECT * FROM sectors');
        echo "<form action='index.php' method='post' class='input-form' id='formsectors'>";
        echo "<div class='form-group row'><label for='category' class='col-5 col-form-label'>Category Name:</label><input type='text' name='category' id='category' class='col-7 form-control'></div>";
        echo '<div class="form-group row"><label for="sector" class="col-5 col-form-label">Sector:</label><select name="sector" id="sector" class="col-7 form-control">';
        while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
            echo "<option value='$row[0]'>$row[1]</option>";
        }
        echo "</select></div>";
        echo "<input type='submit' name='addcategory' value='Add' id='addcat' class='btn btn-primary btn-block' disabled>";
        echo "</form>";
        mysqli_free_result($res);

        if(isset($_POST['addcategory'])) {
            $category = trim(htmlspecialchars($_POST['category']));
            if($category == "") exit;
            $sectorid = $_POST['sector'];
            $ins = "INSERT INTO categories(category, sectorid) VALUES('$category', '$sectorid')";
            mysqli_query($link, $ins);
            
            if(mysqli_error($link)) {
                echo "Error text:". mysqli_error($link);
                exit;
            }
            echo '<script>window.location = document.URL</script>';
        }
        ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script>
    var inputs = $("form#formsectors input, form#formsectors select");
    var validateInputs = function validateInputs(inputs) {
        inputs.each(function(index) {
            if ($(this).val() === "") return false;
        });
        return true;
    }
    inputs.change(function() {
        if (validateInputs(inputs)) {
            $("#addcat").removeAttr("disabled");
        }
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>