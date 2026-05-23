<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/config/main.php';

$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : '';
$password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';

if(isset($username) ?? isset($password)){
    Auth::loginForMobile($username, $password);
}
?>