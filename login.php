<?php
include "db/connection.php";
$obj  = new database();

$username = $_POST['username'];
$password = $_POST['password'];

$response = $obj->login(array($username));
if ($response != 0) {
    $stored_hashed_password = $response['password'];
    if (password_verify($password, $stored_hashed_password)) {
        $_SESSION['user']['id'] = $response['id'];
        $_SESSION['user']['name'] = $response['name'];
        $_SESSION['user']['level'] = $response['level'];
        $_SESSION['user']['msg'] = 'Login Success';
        header('location:dashboard.php');
        exit;
    } else {
        $_SESSION['user']['log']['alert-class'] = "danger";
        $_SESSION['user']['log']['msg'] = 'Invalid username or password';
        header('location:index.php');
        exit;
    }
} else {
    $_SESSION['user']['log']['alert-class'] = "danger";
    $_SESSION['user']['log']['msg'] = 'Invalid username or password';
    header('location:index.php');
    exit;
}
?>
