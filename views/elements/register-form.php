<?php
require_once("../../controllers/includes.php");

require_once("header.php");
require_once("nav.php");
?>

<div class="container">

    <div class="row top-space">

        <div class="col-md-3 bump">
                
            <div class="background-white p-3 pt-5 pb-5">
    
                <div class="text-center">
                    
                    <h4>Already Registered?</h4>
        
                    <p class="mt-3 mb-3">Log In to post your ads!</p><br>
        
                    <a href="/elements/login-form.php" style="width: 100%;" class="btnn text-white">Log In</a>
    
                </div>
        
            </div>

            <div class="slide-up-login">
                
                <div class="text-center">
    
                <p><strong>Protect your account!</strong><br><br> Ensure that whenever you sign in to Doily, the web address in your browser starts with https://www.doily.ca/</p>
    
                </div>
                           
            </div>
                         
        </div>
        
        
        <div class="col-md-9">
        
            <div class="background-white bottom p-3">

                <h4 class="pt-3 mb-4">Register</h4>

                <form action="/users/add.php" method="POST" enctype="multipart/form-data" class="">
                
                    <label for="email">Email Address:</label>
                    <input type="text" class="form-control mb-3" name="email" placeholder="" required>

                    <label for="Username">Username:</label>
                    <input type="text" class="form-control mb-3" name="username" placeholder="" required>
                
                    <label for="password">Password (min. 8 characters):</label>
                    <input type="password" class="form-control mb-3" name="password" placeholder="" required>

                    <label for="repeat password">Repeat Password:</label>
                    <input type="password" class="form-control mb-3" name="password2" placeholder="" required>
                    

                    <label for="file upload">Upload Profile Photo (optional):</label><br>

                    <img src="" alt="" id="img-preview" class="w-100 mb-3">

                    <label class="btn btn-default btn-file mx-auto">

                        <span class="btnn mt-3">Upload New Photo</span> 
                        <input class="in_index" type="file" name="uploaded_profile_photo" id="file-with-preview" style="display: none;">

                    </label>


                    <div class="form-group pb-5">
                    <br>

                    <button class="btnn mt-2 float-button" type="submit">Register</button>
                    <br>
                        

                    </div>

                    
            
                </form>
            
            </div>
             
        </div>


    </div>

</div>


<?php

require_once("footer.php");

?>