<?php

require_once("../../controllers/includes.php");

$u_model = new User;
$u_model->delete();

session_destroy();
unset($_COOKIE);

header("Location: /");




?>