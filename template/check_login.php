<?php 
if (isset($_COOKIE['id']) AND isset($_COOKIE['hash'])) {
    $query = mysqli_query($conn, "SELECT * FROM users WHERE id=".$_COOKIE['id']." LIMIT 1");
    $user = mysqli_fetch_assoc($query);
    if ($user['hash'] !== $_COOKIE['hash']) {
        mysqli_query($conn, "UPDATE users SET hash='".$hash."' WHERE id=".$row['id']);
        setcookie('id', $row['id'], time()-30*24*60*60, "./");
        setcookie('hash', $hash, time()-30*24*60*60, "./");
        header('Location: ./login.php');
    }
}
else {
    header('Location: ./login.php');
}
?>