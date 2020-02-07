<?php

    require_once("../controllers/includes.php");

    // if query starts with @, get user model and return user results
    // else, get project modal and return project results

    $query = $_GET["search"];

    if( $query[0] == "@" ) {
        $u_model = new User;
        $user_results = $u_model->get_all();

        echo json_encode($user_results);


    } else {
        $p_model = new Item;
        $project_results = $p_model->get_all();

        echo json_encode($project_results);
    }
     
     
?>