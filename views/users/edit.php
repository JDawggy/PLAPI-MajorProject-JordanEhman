<?php
require_once("../../controllers/includes.php");

// check if the form was submitted
if( !empty($_POST) ) {
    $user->edit();
    header("Location: /users/");
    exit;
}

$title = "Editing " . $current_user["username"];

require_once("../elements/header.php");
require_once("../elements/nav.php");

// echo "<pre>";
// print_r($current_user);


?>

<div class="container">

    <div class="row">

        <div class="col-md-8 top-space mx-auto background-white">
            <h2 class="mt-3">Edit Profile</h2>

            <form action="" method="POST" enctype="multipart/form-data">


                <img id="img-preview" class="w-100 mb-3" src="<?= $current_user["profle_pic"] ?>" alt="">

                <label class="btf btn-default btn-file mx-auto mb-4 mt-3">
                
                    <span class="btnn mt-3">Upload new profile photo</span> 
                    <input class="in_index" type="file" name="fileToUpload" id="file-with-preview" style="display: none;">
                
                </label>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" class="form-control new-form" value="<?= $current_user["username"]; ?>" name="username">
                </div>

                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" id="firstName" class="form-control new-form" value="<?= $current_user["email"]; ?>" name="email">
                </div>

                <div class="form-group">
                    <label for="password">Change Password (optional)</label>
                    <input type="text" id="password" class="form-control new-form" value="" name="password">
                </div>

                <div class="form-group">
                    <label for="repeat password">Confirm Password</label>
                    <input type="text" id="password2" class="form-control new-form" value="" name="password2">
                </div>

                <div class="text-right">
                    <button type="submit" class="btnn">Update Profile</button>
                </div><br>
            </form>

        </div> <!-- background-white -->
    </div> <!-- row -->
    <br>
    
</div> <!-- container -->



<?php

require_once("../elements/footer.php");

?>

    