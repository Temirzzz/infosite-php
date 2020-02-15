<?php
require_once('core/config.php');
require_once('core/functions.php');
$conn = connect();
require_once('template/header.php');



if (isset($_POST['password']) AND $_POST['password'] != '') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $query = mysqli_query($conn, "SELECT id, password FROM users WHERE email='".$email."'LIMIT 1");
    $row = mysqli_fetch_assoc($query);
    
    if ($row['password'] == md5($_POST['password'])) {
        $hash = genHash (20);
        mysqli_query($conn, "UPDATE users SET hash='".$hash."' WHERE id=".$row['id']);
        setcookie('id', $row['id'], time()+30*24*60*60);
        setcookie('hash', $hash, time()+30*24*60*60, null, null, null, true);
        header('Location: ./admin.php');
        exit();
    }
    else {
        echo "Вы ввели не верные данные!";
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form method="POST">
                <div class="form-group mt-5">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email"  name="email" >
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password"  name="password">
                </div>                
                <button type="submit" class="btn btn-primary mb-2">Войти</button>
            </form>
        </div>
    </div>
</div>