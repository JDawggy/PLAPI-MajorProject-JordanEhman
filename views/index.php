<?php
$title = "Home Page";

require_once("../controllers/includes.php");

require_once("elements/header.php");
require_once("elements/nav.php");

// session_destroy();
// session_start();

// print_r($_SESSION["user_logged_in"]);



    //print_r($_SESSION);
    ?>
<div class="container">
    <div class="row mt-5">

    
        <!-- PLAYSTATION -->
        <div class="accordion col-3" id="psAccordion">
            <div class="card">

                <img class="card-img-top card-photo" data-toggle="collapse" data-target="#psOptions" src="/assets/photos/ratchet.jpg" alt="Card image cap">

                <div class="card-header" data-toggle="collapse" data-target="#psOptions">
                    <h5 class="card-title text-center mt-2 color">Playstation</h5>
                </div>

                <div class="card-body collapse" data-parent="#psAccordion" id="psOptions">
                    <h5 class="color">Playstation 1</h5>
                    <hr>    
                    <h5 class="color">Playstation 2</h5>
                    <hr>
                    <h5 class="color">Playstation 3</h5>
                    <hr>
                    <h5 class="color">Playstation 4</h5>
                    <hr>
                    <h5 class="color">PSP</h5>
                </div>

            </div>
        </div> <!-- accordion -->



        <!-- Xbox -->
        <div class="accordion col-3" id="xbAccordion">
            <div class="card">

                <img class="card-img-top card-photo" data-toggle="collapse" data-target="#xbOptions" src="/assets/photos/halo.jpg" alt="Card image cap">

                <div class="card-header" data-toggle="collapse" data-target="#xbOptions">
                    <h5 class="card-title text-center mt-2 color">Xbox</h5>
                </div>

                <div class="card-body collapse" data-parent="#xbAccordion" id="xbOptions">
                    <h5 class="color">Xbox Original</h5>
                    <hr>    
                    <h5 class="color">Xbox 360</h5>
                    <hr>
                    <h5 class="color">Xbox One</h5>
                </div>

            </div>
        </div> <!-- accordion -->



        <!-- NINTENDO -->
        <div class="accordion col-3" id="nAccordion">
            <div class="card">

                <img class="card-img-top card-photo" data-toggle="collapse" data-target="#nOptions" src="/assets/photos/mario.jpg" alt="Card image cap">

                <div class="card-header" data-toggle="collapse" data-target="#nOptions">
                    <h5 class="card-title text-center mt-2 color">Nintendo</h5>
                </div>

                <div class="card-body collapse" data-parent="#nAccordion" id="nOptions">
                    <h5 class="color">NES</h5>
                    <hr>    
                    <h5 class="color">Super NES</h5>
                    <hr>
                    <h5 class="color">N64</h5>
                    <hr>
                    <h5 class="color">Gamecube</h5>
                    <hr>
                    <h5 class="color">Wii</h5>
                    <hr>
                    <h5 class="color">Wii U</h5>
                    <hr>
                    <h5 class="color">Switch</h5>
                    <hr>
                    <h5 class="color">Gameboy</h5>
                </div>

            </div>
        </div> <!-- accordion -->



        <!-- RETRO GAMES -->
        <div class="accordion col-3" id="rtAccordion">
            <div class="card">

                <img class="card-img-top card-photo" data-toggle="collapse" data-target="#rtOptions" src="/assets/photos/megaman.jpg" alt="Card image cap" >

                <div class="card-header" data-toggle="collapse" data-target="#rtOptions">
                    <h5 class="card-title text-center mt-2 color">Retro</h5>
                </div>

                <div class="card-body collapse" data-parent="#rtAccordion" id="rtOptions">
                    <h5 class="color">Atari</h5>
                    <hr>    
                    <h5 class="color">Sega</h5>
                </div>

            </div>
        </div> <!-- accordion -->
        
    </div> <!-- row -->

    <?php

    if ( empty($_SESSION["user_logged_in"]) ) {
        // show the listings relevant to the users search
        ?>


        <!-- DOILY BANNER -->
        <div class="row">
            <div class="join-banner text-center mt-5 col-12">
                <div class="banner-text">

                    <h5 class="text-white">Doily’s even better when your a member!</h5>

                    <p class="text-white mt-3">See listings more relevant to you, find what your looking for faster and more! </p>

                    <a href="/elements/register-form.php" class="btnw mt-3">Register Now</a>

                </div>
            </div> <!-- banner -->
        </div> <!-- row -->


        <?php
    } else { // else not logged in, show the do i love you games banner
        ?>


        <!-- DOILY BANNER -->
        <div class="row">
            <div class="join-banner text-center mt-5 col-12">
                <div class="banner-text">

                    <h5 class="text-white">Not sure what to search for?</h5>

                    <p class="text-white mt-3">Start here and see all our listings!</p>

                    <a href="/search.php?+" class="btnw mt-3">Search All</a>

                </div>
            </div> <!-- banner -->
        </div> <!-- row -->


        <?php
    }
    ?>


</div> <!-- Container -->

<?php


require_once("elements/footer.php");

?>