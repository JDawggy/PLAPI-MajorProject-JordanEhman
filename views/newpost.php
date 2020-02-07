<?php
$title = "Home Page";

require_once("../controllers/includes.php");

require_once("elements/header.php");
require_once("elements/nav.php");


$info = new User;

$user_info = $info->get_by_id($_SESSION["user_logged_in"]);

// echo "<pre>";
// print_r($user_info);



?>

<div class="container">

<form action="/posts/add.php" method="POST" enctype="multipart/form-data">


    <!-- 1 -->

    <div class="background-white mt-5">
        <div class="row">
            <div class="numbers ml-5 mt-3">
                <h5 class="number">1</h5>
            </div>

            <h5 class="color ad-titles">Ad Details</h5>
        </div>

        <hr>

        <div class="row">

            <div class="col-md-6">
    
                <div class="row">
    
                    <div class="col-3">
                        <p class="text-right">Ad Title:</p>
                    </div>
    
                    <div class="col-9">
                        <input type="text" class="new-form" name="title">
                    </div>
                    
                </div> <!-- row -->
    
                <div class="row">
    
                    <div class="col-3">
                        <p class="text-right">Description:</p>
                    </div>
    
                    <div class="col-9">
                        <textarea class="new-form mb-3" name="description" id="" cols="30" rows="10"></textarea>
                    </div>
                    
                </div><!-- row -->
    
            </div><!-- col-6 -->




            <div class="col-md-6">
                
                <div class="accordion mr-4" id="psAccordion">
                    <div class="card">
        
                        <div class="card-header" data-toggle="collapse" data-target="#psOptions">
                            <h5 class="card-title text-center mt-2 color">Playstation</h5>
                        </div>
        
                        <div class="card-body collapse" data-parent="#psAccordion" id="psOptions">
                            <input type="checkbox" name="ps1" value="1" class="color">Playstation 1</input>
                            <hr>    
                            <input type="checkbox" name="ps2" value="1" value="1" value="1" value="1" class="color">Playstation 2</input>
                            <hr>
                            <input type="checkbox" name="ps3" value="1" value="1" value="1" value="1" class="color">Playstation 3</input>
                            <hr>
                            <input type="checkbox" name="ps4" value="1" value="1" value="1" value="1" class="color">Playstation 4</input>
                            <hr>
                            <input type="checkbox" name="psp" value="1" value="1" value="1" value="1" class="color">PSP</input>
                        </div>
        
                    </div>
                </div> <!-- accordion -->

                <div class="accordion mr-4" id="xbAccordion">
                    <div class="card">
        
                        <div class="card-header" data-toggle="collapse" data-target="#xbOptions">
                            <h5 class="card-title text-center mt-2 color">Xbox</h5>
                        </div>
        
                        <div class="card-body collapse" data-parent="#xbAccordion" id="xbOptions">
                            <input type="checkbox" name="xb" value="1" value="1" value="1" class="color">Xbox Original</input>
                            <hr>    
                            <input type="checkbox" name="xb360" value="1" value="1" value="1" class="color">Xbox 360</input>
                            <hr>
                            <input type="checkbox" name="xb1" value="1" value="1" value="1" class="color">Xbox One</input>
                        </div>
        
                    </div>
                </div> <!-- accordion -->

                <div class="accordion mr-4" id="nAccordion">
                    <div class="card">
        
                        <div class="card-header" data-toggle="collapse" data-target="#nOptions">
                            <h5 class="card-title text-center mt-2 color">Nintendo</h5>
                        </div>
        
                        <div class="card-body collapse" data-parent="#nAccordion" id="nOptions">
                            <input type="checkbox" name="nes" value="1" value="1" class="color">NES</input>
                            <hr>    
                            <input type="checkbox" name="snes" value="1" value="1" class="color">Super NES</input>
                            <hr>
                            <input type="checkbox" name="n64" value="1" value="1" class="color">N64</input>
                            <hr>
                            <input type="checkbox" name="gc" value="1" value="1" class="color">Gamecube</input>
                            <hr>    
                            <input type="checkbox" name="wii" value="1" value="1" class="color">Wii</input>
                            <hr>
                            <input type="checkbox" name="wiiu" value="1" value="1" class="color">Wii U</input>
                            <hr>
                            <input type="checkbox" name=switch value="1" value="1" class="color">Switch</input>
                            <hr>    
                            <input type="checkbox" name="gb" value="1" value="1" class="color">Gameboy</input>
                        </div>
        
                    </div>
                </div> <!-- accordion -->

                <div class="accordion mr-4" id="rtAccordion">
                    <div class="card">
        
                        <div class="card-header" data-toggle="collapse" data-target="#rtOptions">
                            <h5 class="card-title text-center mt-2 color">Retro</h5>
                        </div>
        
                        <div class="card-body collapse" data-parent="#rtAccordion" id="rtOptions">
                            <input type="checkbox" name="atari" value="1" class="color">Atari</input>
                            <hr>    
                            <input type="checkbox" name="sega" value="1" class="color">Sega</input>
                        </div>
        
                    </div>
                </div> <!-- accordion -->
                <br>
    
            </div><!-- col-6 -->

        </div><!-- row -->
    </div> <!-- background-white -->







    <!-- 2 -->


    <div class="background-white mt-5">
        
        <div class="row">
            <div class="numbers ml-5 mt-3">
                <h5 class="number">2</h5>
            </div>

            <h5 class="color ad-titles">Photos</h5>
        </div>

        <hr>

        <p class="ml-3">Add photos to gain more interest and show its condition, include up to 3 photos</p>

        <div class="row">

            <div class="col-4 mt-auto">
    
                <img src="" alt="" id="img-preview" class="w-100 mb-3">
        
                <label class="btf btn-default btn-file mx-auto mb-4">
        
                    <span class="btnn mt-3">Upload Main Photo</span> 
                    <input class="in_index" type="file" name="main_photo" id="file-with-preview" style="display: none;">
        
                </label>
    
            </div>
    
    
    
            <div class="col-4 mt-auto">

                <img src="" alt="" id="img-preview-two" class="w-100 mb-3">
    
                <label class="btf btn-default btn-file mx-auto mb-4">
                
                    <span class="btnn mt-3">Upload Second Photo</span> 
                    <input class="in_index" type="file" name="photo_2" id="file-with-preview-two" style="display: none;">
                
                </label>
            
            </div>
    
    
    
            <div class="col-4 mt-auto">

                <img src="" alt="" id="img-preview3" class="w-100 mb-3">
    
                <label class="btf btn-default btn-file mx-auto mb-4">
        
                    <span class="btnn mt-3">Upload Third Photo</span> 
                    <input class="in_index" type="file" name="photo_3" id="file-with-preview3" style="display: none;">
        
                </label>
            
            </div>

        </div>    





    </div><!-- background-white -->






    <!-- 3 -->


    <div class="background-white mt-5">

        <div class="row">
            <div class="numbers ml-5 mt-3">
                <h5 class="number">3</h5>
            </div>

            <h5 class="color ad-titles">Location</h5>
        </div>

        <hr>
        
        <div class="col-md-6">

            <div class="row">

                <div class="col-3">
                    <p class="text-right">Province:</p>
                </div>

                <div class="col-9">
                    <input type="text" class="new-form" name="province">
                </div>
                
            </div> <!-- row -->

            <div class="row">

                <div class="col-3">
                    <p class="text-right">City:</p>
                </div>

                <div class="col-9">
                    <input type="text" class="new-form" name="city">
                </div>
                
            </div> <!-- row -->

            <div class="row">

                <div class="col-3">
                    <p class="text-right">Address:</p>
                </div>

                <div class="col-9">
                    <input type="text" class="new-form" name="address">
                </div>
                
            </div> <!-- row -->

            

        </div><!-- col-6 -->

    </div><!-- background-white -->






    <!-- 4 -->


    <div class="background-white mt-5">

        <div class="row">
            <div class="numbers ml-5 mt-3">
                <h5 class="number">4</h5>
            </div>

            <h5 class="color ad-titles">Price</h5>
        </div>

        <hr>
        
        <div class="col-md-6">

            <div class="row">

                <div class="col-3">
                    <p class="text-right">Price: $</p>
                </div>

                <div class="col-9">
                    <input type="text" class="new-form" name="price">
                </div>
                
            </div> <!-- row -->

            

        </div><!-- col-6 -->


    </div><!-- background-white -->






    <!-- 5 -->


    <div class="background-white mt-5">

        <div class="row">
            <div class="numbers ml-5 mt-3">
                <h5 class="number">5</h5>
            </div>

            <h5 class="color ad-titles">Contact Info</h5>
        </div>

        <hr>
        
        <div class="col-md-6">

            <div class="row">

                <div class="col-3">
                    <p class="text-right">Phone:</p>
                </div>

                <div class="col-9">
                    <input type="text" class="new-form" name="phone">
                </div>
                
            </div> <!-- row -->

            <div class="row">

                <div class="col-3">
                    <p class="text-right">Email:</p>
                </div>

                <div class="col-9">
                    <input type="text" class="new-form" name="email" value="<?= $user_info["email"] ?>">
                </div>
                
            </div> <!-- row -->

            

        </div><!-- col-6 -->


    </div><!-- background-white -->


    <div class="row mt-5 ml-3">

        <button class="btnn mr-4">Post Your Ad</button>
        <button class="btnw">Preview</button>

    </div>




</form>



</div> <!-- Container -->


<?php

require_once("elements/footer.php");

?>