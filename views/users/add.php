<?php

require_once("../../controllers/includes.php");

// check if all feilds are filled

if( !empty( $_POST["username"] ) && 
!empty( $_POST["email"] ) && 
!empty( $_POST["password"] ) && 
$_POST["password"] == $_POST["password2"]
) {
    
    // create new user object
    $user = new User;
    
    // check if the user alread exists in the database 
    
    $exists = $user->exists();
    
    if ( empty($exists) ) {
        // if not, add them to the database
        $new_user_id = $user->add();
        $_SESSION["user_logged_in"] = $new_user_id;
    } else {
        $_SESSION["create_account_msg"] = "<p class='text-danger'>User already exists</p>";
    }
    // redirect to home page once added

    if(!APP_DEBUG) header("Location: /");

}




?>