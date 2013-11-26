<?php

$username = $_GET['username'];
$password = $_GET['password'];

$securePassword = crypt(
md5(strip_tags($password)),
md5(strip_tags($username))
);

echo $securePassword;

?>
