<?php
$title = "Home Page";

require_once("../controllers/includes.php");

require_once("elements/header.php");
require_once("elements/nav.php");

// session_destroy();
// session_start();

// print_r($_SESSION["user_logged_in"]);

$p_model = new Item;

$ads = $p_model->get_all_by_category();

$number_ads = count($ads);

// echo "<pre>";
// print_r($ads);

?>


<div class="container">
        
    <div class="row top-space">

        <div class="col-md-3">
                
            <div class="background-white p-3 pt-4 pb-5">

                <div class="mt-2">

                    <p class="text-muted">Category:</p>

                    <?php
                    if($_GET["category"] == "All Categories") {
                        ?>
                        <a href="/search.php?category=All+Categories" class="category-selection selected color">All Categories</a><br>
                        <?php
                    } else {
                        ?>
                        <a href="/search.php?category=All+Categories" class="category-selection color">All Categories</a><br>
                        <?php
                    }
                    ?>
                    <?php
                    if($_GET["category"] == "ps") {
                        ?>
                        <a href="/search.php?category=ps" class="category-selection color selected">Playstation</a><br>
                        <?php
                    } else {
                        ?>
                        <a href="/search.php?category=ps" class="category-selection color">Playstation</a><br>
                        <?php
                    }
                    ?>
                    <?php
                    if($_GET["category"] == "xb") {
                        ?>
                        <a href="/search.php?category=xb" class="category-selection color selected">Xbox</a><br>
                        <?php
                    } else {
                        ?>
                        <a href="/search.php?category=xb" class="category-selection color">Xbox</a><br>
                        <?php
                    }
                    ?>
                    <?php
                    if($_GET["category"] == "n") {
                        ?>
                        <a href="/search.php?category=n" class="category-selection color selected">Nintendo</a><br>
                        <?php
                    } else {
                        ?>
                        <a href="/search.php?category=n" class="category-selection color">Nintendo</a><br>
                        <?php
                    }
                    ?>
                    <?php
                    if($_GET["category"] == "rt") {
                        ?>
                        <a href="/search.php?category=rt" class="category-selection color selected">Retro</a>
                        <?php
                    } else {
                        ?>
                        <a href="/search.php?category=rt" class="category-selection color">Retro</a>
                        <?php
                    }
                    ?>

                    
                    
                    
                    

                    
                

                </div>
        
            </div>
                        
        </div>
        
        
        <div class="col-md-9">

            <div class="background-white bottom">
            
                <div class="row">
                    <p class="text-muted ad-titles p-3">showing <?= ($number_ads != 0) ? 1 : 0; ?>-<?= $number_ads ?> out of <?= $number_ads ?> ads</p>
                </div>
            
                <hr>




        <?php

        


        foreach($ads as $ad) {

                // echo "<pre>";
                // print_r($ad);


            ?>
                <div class="card">
                    <div class="card-body">

                        <div class="row">

                            <div class="col-3">

                                <div class="search-photo">
                                    <img class="" src="<?= $ad["file_url"] ?>" alt="">

                                </div>
    
                            </div> <!-- col-3 -->
    
                            <div class="col-9">
    
                                <!-- title and price -->
                                <div class="row ml-3">
                                    <a class="color" href="/posts/?id=<?= $ad["ad_id"] ?>&owner_id=<?= $ad["owner_id"] ?>"><h5 class="card-title"><?= $ad["title"] ?></h5></a>

                                    <h5 class="ml-auto mr-3">$<?= $ad["price"] ?></h5>

                                </div>

                                <p class="card-text ml-3 text-muted"><?= $ad["province"] ?>, <?= $ad["city"] ?>, <?= $ad["address"] ?> || <?= date("l, F d", strtotime($ad["time_posted"])) ?> </p>

                                <p class="card-text ml-3"><?= $ad["description"] ?></p>


                                <hr class="ml-3">

                                <!-- seller info -->
                                <div class="row ml-3">

                                    <!-- seller profile pic -->
                                    <div class="search-profile-pic">
                                        <img class="search-profile-pic" src="<?= isset($ad["profile_pic"]) ? $ad["profile_pic"] : '/assets/photos/profile-photo.jpg'  ?>" alt="">
                                    </div>

                                    <a class="link" href="/users/?id=<?= $ad["owner_id"] ?>"><p class="seller-info ml-2"><?= $ad["username"] ?></p></a>

                                    <p class="ml-auto mr-3 seller-info">Seller Rating:<i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></p>

                                </div>
                            
                            </div><!-- col-9 -->
                        </div> <!-- row -->
                    </div> <!-- card-body -->
                </div> <!-- card -->
                
                
                
                <?php
        } // end foreach
        ?>
        
        </div> <!-- background-white -->


        </div> <!-- col-md-9 -->


    </div> <!-- row -->
</div> <!-- container -->


<?php
    

require_once("elements/footer.php");

?>