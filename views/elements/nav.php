<div class="navbar-full-width">

    <nav class="navbar navbar-expand-lg">


        <div class="col-md-1 logo collapse navbar-collapse" id="navbarText">

            <a href="/"><img class="" src="/assets/photos/doily-logo.jpg" alt=""></a>

        </div>


        <div class="col-md-6 col-sm-3">

            <form class="ml-5" id="search_form" action="/search.php" method="GET">
                <div class="input-group ml-4">

                 

                        <input type="search" placeholder="Search for anything..." id="search" name="search" class="form-control searchb">
    
                        <div id="search_results">
    
                        </div>
            
                        <select name="category" class="custom-select searchb" id="inputGroupSelect01">
                            <option selected>All Categories</option>
                            <option value="ps">Playstation</option>
                            <option value="xb">Xbox</option>
                            <option value="n">Nintendo</option>
                            <option value="rt">Retro</option>
                        </select>
            
                        <button class="btns" type="submit"><i class="fas fa-search pr-3 pl-3"></i></button>          

                    

        
                </div>
            </form>

        </div>


        <div class="col-md-2 nav-button">
            
            <a href="<?= !empty($_SESSION["user_logged_in"]) ? "/newpost.php" : "/elements/login-form.php" ?>" class="btnn">Post an ad</a>     
            
        </div>


        <!-- Log in or user profile pic -->

        <?php
            if( isset($_SESSION["user_logged_in"]) ) {

                $u_model = new User;

                $user_id = (int)$_SESSION["user_logged_in"];

                $user = $u_model->get_by_id($user_id);

                
        ?>

                
                <div class="col-md-2 collapse navbar-collapse profile-nav" id="navbarText">

                    <div class="dropdown">
                        <div class="search-profile-pic" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?= $user["profile_pic"] ?>" alt="">
                        </div>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">

                            <a class="dropdown-item" href="/users/">View Profile</a>
                            <a class="dropdown-item" href="/users/logout.php">Log Out</a>

                        </div>
                    </div>

                </div>



        <?php

            } else {
        ?>

        <div class="col-md-2 profile-nav collapse navbar-collapse" id="navbarText">
            
            <p class="mt-3 pl-4"><a class="link" href="/elements/register-form.php">Register</a><p class="color mt-3 pl-1 pr-1">or</p><a class="link" href="/elements/login-form.php">Log In</a></p>   
            
        </div>

        <?php
            } // user logged in
        ?>


       

        <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        

    </nav>

</div>
