<?php
require_once("../../controllers/includes.php");

require_once("../elements/header.php");
require_once("../elements/nav.php");
?>

<div class="container">

 
    
    
    <div class="background-white mt-5">

        <div class="row user">

            <div class="user-profile-pic ml-5 mt-4">
                <img class="" src="/assets/photos/profile-photo.jpg" alt="">
            </div>
            
            <h3 class="user-username">Seller Name</h3>

            <h3 class="ml-auto mr-5 user-rating">Seller Rating: <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></h3>

        </div>

        <hr>
        
        <div class="row">

            <div class="col-4 text-center border-right">

                <a href="/users/index.php"><h4 class="color mb-4 mt-3">Number of Ads</h4></a>
                <h4 class="">18</h4>

            </div>

            <div class="col-4 text-center border-right">

                <h4 class="color mb-4 mt-3">Ratings & Reviews</h4>



                <div class="row ml-3">

                    <p class="seller-info"><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></p>
    
                    <p class="seller-info ml-2">Great thing i got from this...</p>

                </div>
                
                <div class="row ml-3">

                    <p class="seller-info"><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></p>
    
                    <p class="seller-info ml-2">Great thing i got from this...</p>

                </div>



            </div>

            <div class="col-4 text-center">

                <h4 class="color mb-4 mt-3">Member Since</h4>
                <h4 class="">date of memberness</h4>

            </div>
        </div>  <!-- row -->
        <br>

    </div> <!-- background-white -->




    

        <div class="background-white mt-5">
        
            <div class="row">
                <p class="text-muted ad-titles p-3">showing 1 of 1 review</p>
            </div>
        
            <hr>
   


            <div class="card">
                <div class="card-body">

                    <div class="row">

                        <div class="col-3">

                        <h3 class="ml-auto mr-5 user-rating ml-3"><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></h3>

                        </div> <!-- col-3 -->

                        <div class="col-9">

                            <!-- title and price -->
                            <div class="row ml-3">
                                <h5 class="card-title"> review text here</h5>

                                <h5 class="ml-auto mr-3"></h5>

                            </div>

                            <div class="row float-right review-section">

                                <h6 class="card-text text-muted mt-3">review left by: </h6>
    
                                 <!-- seller profile pic -->
                                 <div class="search-profile-pic ml-3">
                                    <img class="search-profile-pic" src="/assets/photos/profile-photo.jpg" alt="">
                                </div>
    
                                <h5 class="seller-info ml-2 color mr-3">username here</h5>

                            </div>



                            
                        
                        </div><!-- col-9 -->
                    </div> <!-- row -->
                </div> <!-- card-body -->
            </div> <!-- card -->
            
        </div> <!-- background-white -->


   

  
            
  

</div>


<?php

require_once("../elements/footer.php");

?>