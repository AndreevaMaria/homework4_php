<?php 
function connect($host="127.0.0.1:3306", $user="root", $pass="123456", $dbname="products") {
    $link = mysqli_connect($host, $user, $pass, $dbname);
    echo "<div class='row'> <div class='col-12 text-muted font-italic mb-3'>";
    if(!$link) {
        echo "Ошибка: невозможно установить соединение с MySQL";
        echo "Код ошибки errno: " . mysqli_connect_errno();
        echo "Текст ошибки errno: " . mysqli_connect_error();
        exit;
    }
    if(!mysqli_set_charset($link, "utf8")) {
        echo "Ошибка при загрузке кодировки символов utf8: " . mysqli_error($link);
        exit;
    }
    //echo "<div class='badge badge-success'>Connection successful</div>";
    echo "</div></div>";
    return $link;
}

function register($name, $pass, $email) {
    $pass = trim(utf8_encode(htmlspecialchars($pass)));
    $email = trim(utf8_encode(htmlspecialchars($email)));

    if ($name == "" || $pass == "" || $email == "") {
        echo "<h6 class='text-danger'>Заполните все поля</h6>";
        return false;
    }
    
    if(strlen($name) < 3 || strlen($name) > 30 || strlen($pass) < 3 || strlen($pass) > 30) {
        echo "<h6 class='text-danger'>От 0 до 30 символов</h6>";
        return false;
    }

    $pass = password_hash($pass, PASSWORD_BCRYPT);

    $ins = "INSERT INTO users(login, pass, email) VALUES('$name', '$pass', '$email')";
    $link = connect();
    mysqli_query($link, $ins);

    $err = mysqli_errno($link);

    if($err) {
        if($err == 1062) {
            echo "<h5 class='text-danger'>Пользователь с таким именем уже зарегистрирован!</h5>";
            return false;
        } else {
            echo "<h5 class='text-danger'>Error code ".$err."</h5>";
            return false;
        }
    }
    echo "<h6 class='text-success'>Пользователь добавлен</h6><br>";
    return true;

}

function login($login, $pass) {
    $name = trim(utf8_encode(htmlspecialchars($login)));
    $pass = trim(utf8_encode(htmlspecialchars($pass)));

    if ($name == "" || $pass == "") {
        echo "<h5 class='text-danger'>Заполните все поля</h5>";
        return false;
    }
    
    if(strlen($name) < 3 || strlen($name) > 20 || strlen($pass) < 3 || strlen($pass) > 20) {
        echo "<h5 class='text-danger'>От 3 до 20 символов</h5>";
        return false;
    }

    $sel = "SELECT login, pass, id FROM users WHERE login='$name'";
    $link = connect();
    $res = mysqli_query($link, $sel);

    while($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
        if($name == $row[0] && password_verify($pass, $row[1])) {
            $_SESSION['ruser'] = $name;
           // $_SESSION['login_time'] = time();
            $_SESSION['expire'] = $_SESSION['start'] + (60 * 60);
            $userid = $row[2];
            return true;
        } else {
            echo "<h6 class='text-danger'>Логин или пароль не совпадают</h6>";
            return false;
        } 
    }
}
?>

