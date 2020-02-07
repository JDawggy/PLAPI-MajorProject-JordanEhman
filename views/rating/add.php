<?php

require_once("../../controllers/includes.php");

$rating_data = array("error" => true);

if( !empty($_POST["stars"]) ) {
    // Add new project

    $rating = new Rating;

    $rating->add($rating_data);
    
    header("Location: /");

}


?>