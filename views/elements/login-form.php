<?php
require_once("../../controllers/includes.php");

require_once("header.php");
require_once("nav.php");
?>

<div class="container">

    <div class="row top-space">

        <div class="col-md-3">
                
            <div class="background-white p-3 pt-4 pb-5">
    
                <div class="text-center mt-2">
    
                    <h4>New to Doily?</h4>
        
                    <p class="mt-3">Register now to post, edit, and manage ads. It’s quick, easy, and free!</p><br>

                    <a class="btnn mt-4" style="width: 100%;" href="/elements/register-form.php">Register</a>

    
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

                <h4 class="pt-3 mb-4">Log In</h4>

                <form action="/users/login.php" method="POST">
                
                    <label for="email">Email Address or Username:</label>
                    <input type="text" class="form-control mb-3" name="username" placeholder="" required>
                
                    <label for="password">Password (min. 8 characters):</label>
                    <input type="password" class="form-control mb-3" name="password" placeholder="" required>

                    <div class="form-group">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Remember Me</label>
                    </div>

                    <div class="form-group pb-5">

                        <button class="btnn mt-2 float-button" type="submit">Login</button><br>
                        
                    </div>

                </form>
            
            </div>
             
        </div>


       


    </div>

</div>

<?php

require_once("footer.php");

?>