<?php 
error_reporting(E_ALL) ;
include_once("functions.php");
?>

<div class="modal fade" id="to-cabinet" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="authLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="white-bg modal-header">
        <h5 class="modal-title" id="authLabel">Authorization</h5>
        <button type="button" class="close ml-auto mr-2" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <section id="content1"> 
            <form method="POST" class="login-form" id="Login">
                <input name="login" placeholder="Login" type="text" required="required" class="d-block my-1">
                <input name="pass" placeholder="Password" type="password" required="required" class="d-block mb-2">
                <input type="submit" name="check-log" value="Log in" class="btn btn-success btn-block">
            </form>
        </section>
        <section id="content2">
            <form method="POST" class="login-form" id="Register">
                <input name="login" placeholder="Login" type="text" required="required" class="d-block my-1">
                <input name="email" type="email" required="required" placeholder="E-mail" class="d-block mb-1">
                <input name="pass" placeholder="Password" type="password" required="required" class="d-block mb-1">
                <input name="pass-rpt" placeholder="Repeat password" type="password" class="d-block mb-2">
                <input type="submit" name="reg" value="Sign up" class="btn btn-success btn-block">
            </form>
        </section>
      </div>
      <div class="modal-footer">
        <div class="d-inline-block justify-content-between tabs">
            <input type="submit" id="signin" value="Log in" class="btn btn-light btn-outline-dark">
            <input type="submit" id="signup" value="Registration" class="btn btn-light btn-outline-dark">
        </div>
      </div>
    </div>
  </div>
</div>
 
<?php
if(isset($_POST['check-log'])) {
    if(login($_POST['login'], $_POST['pass'])) {
        echo '<span><form method="post">';
        echo '<h6>Hello, '.$_SESSION['ruser'].'!</h6>';
        echo '<input type="submit" name="exit" value="Log out" class="btn btn-outline-secondary btn-sm">';
        echo '</form></span>';

        if(isset($_POST['exit'])) {
            unset($_SESSION['ruser']);
            echo '<script>window.location.reload()</script>';
        } 

        echo '<script>window.location.reload()</script>';
    } else {
        echo '<button type="button" class="btn btn-info my-2" data-toggle="modal" data-target="#to-cabinet">Authorization</button>';
    }
} else {
    //session_destroy();
    //echo '<script>window.location.reload()</script>';
    echo '<button type="button" class="btn btn-info my-2" data-toggle="modal" data-target="#to-cabinet">Authorization</button>';
}

if(isset($_POST['reg'])) {
    register($_POST['login'], $_POST['pass'], $_POST['email']);
    echo '<script>window.location.reload()</script>';
}


?>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
    $("#signin").addClass("active");
    $('#content2').hide();
    $( "#signin" ).click(function() {
        $("#signin").addClass("active");
        $("#signup").removeClass("active");
        $('#content1').show();
        $('#content2').hide();
    });
    $( "#signup" ).click(function() {
        $("#signup").addClass("active");
        $("#signin").removeClass("active");
        $('#content1').hide();
        $('#content2').show();
    });
</script>

   