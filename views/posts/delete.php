<?php

require_once("../../controllers/includes.php");

$i_model = new Item;
$i_model->delete();

header("Location: /users/");


?>