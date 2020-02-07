<?php

require_once("../../controllers/includes.php");

// check if all feilds are filled

if( !empty( $_POST["title"] ) && 
!empty( $_POST["description"] ) && 
!empty( $_POST["province"] ) && 
!empty( $_POST["city"] ) && 
!empty( $_POST["address"] ) && 
!empty( $_POST["price"] ) && 
!empty( $_POST["email"] ) ) {
    
    // create new user object
    $post = new Item;
    
    // check if the user alread exists in the database 

    $new_post_id = $post->add();

    
    // $exists = $post->exists();
    
    // if ( empty($exists) ) {
    //     // if not, add them to the database
    //     $new_post_id = $post->add();

    // } else {
    //     $_SESSION["create_account_msg"] = "<p class='text-danger'>post already exists</p>";
    // }
    // redirect to home page once added

    if(!APP_DEBUG) header("Location: /");


}




?>