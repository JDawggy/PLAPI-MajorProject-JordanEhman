<?php

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);

if( !isset($_SESSION) ) session_start();

// print_r($_COOKIE);

// create a constant variable to hold the path to the root directory of the project

define( "APP_ROOT", substr(__DIR__, 0, strrpos(__DIR__, DIRECTORY_SEPARATOR)) );

define( "APP_NAME", "doily" );

define( "APP_DEBUG", false ); // false to disable, true to enable

// echo APP_ROOT;


require_once(APP_ROOT . "/controllers/db.php");
require_once(APP_ROOT . "/controllers/util.php");


// *****************************************************
// Automatically include all files in the /MODELS folder

spl_autoload_register(function($class){
    // add any .php file extension with the class name to match, but must be lower case

    $filename = strtolower($class) . ".php";

    // check if the class file exists and is in the model folder

    if ( file_exists( APP_ROOT . "/models/" . $filename ) ) {
        require_once( APP_ROOT . "/models/" . $filename );
    }

});


if(!empty($_COOKIE["user_logged_in"])) {

    $_SESSION["user_logged_in"] = $_COOKIE["user_logged_in"];
}

if(!empty($_SESSION["user_logged_in"])) {

    $user= new User;
    $current_user = $user->get_by_id($_SESSION["user_logged_in"]);

}


?>