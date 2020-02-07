<?php
require_once("../../controllers/includes.php");

require_once("../elements/header.php");
require_once("../elements/nav.php");

// echo "<pre>";
// print_r($_SESSION);

if( !empty($_GET["id"]) ) {

    $u_model = new User;

    $user_id = (int)$_GET["id"];

    $selected_user = $u_model->get_by_id($user_id);

} else {

    $selected_user = $current_user;
    
}

$p_model = new Item;
    $user_ads = $p_model->get_by_user_id($selected_user["id"]);

    // echo "<pre>";
    // print_r($user_ads);

    $number_ads = count($user_ads);


    // $r_model = new Review;

    //     $review_previews = $r_model->get_reviews();

// echo "<pre>";
// print_r($current_user);


?>

<div class="container">


    <?php

    if( empty($_GET["id"]) ) {

        // echo "<pre>";
        // print_r($selected_user);

    ?>

        <div class="background-white-r mt-4 col-2 ml-auto">
            <br>
            <div class="row">


                <form action="/users/edit.php" method="get" id="editProfile">

                    <input type="hidden" name="id" value="<?= $selected_user["id"] ?>">

                    <a class="edit-profile-icon color" href="javascript:$('#editProfile').submit();"><h4 class="fas fa-edit"></h4></a>

                </form>



                <form action="/users/delete.php" method="post" id="deleteProfile">

                    <input type="hidden" name="id" value="<?= $selected_user["id"]  ?>">

                    <a class="delete-profile-icon color" href="javascript:$('#deleteProfile').submit();"><h4 class="fas fa-trash-alt"></h4></a>

                </form>


            </div><br>

            <div class="row">

                <p class="text-muted inline edit-profile-text desc-profile-text">edit proile</p>
                <p class="text-muted ml-4 delete-profile-text desc-profile-text">delete profile</p>

            </div>
        </div>

    <?php
    }
    ?>

 
    
    
    <div class="background-white mt-3">

        <div class="row user">

            <div class="user-profile-pic ml-5 mt-4">
                <img class="" src="<?= $selected_user["profile_pic"] ?>" alt="">
            </div>
            
            <h3 class="user-username"><?= $selected_user["username"] ?></h3>

            <h3 class="ml-auto mr-5 user-rating">Seller Rating: <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></h3>

        </div>

        <hr>
        
        <div class="row">

            <div class="col-4 text-center border-right">

                <h4 class="color mb-4 mt-3">Number of Ads</h4>
                <h4 class=""><?= $number_ads ?></h4>

            </div>

            <div class="col-4 text-center border-right">

                <a href="/users/reviews.php"><h4 class="color mb-4 mt-3">Ratings & Reviews</h4></a>



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
                <h4 class=""><?= date("l, F d", strtotime($current_user["date_created"])) ?></h4>

            </div>
        </div>  <!-- row -->
        <br>

    </div> <!-- background-white -->




    

        <div class="background-white mt-3">
        
            <div class="row">
                <p class="text-muted ad-titles p-3">showing <?= ($number_ads != 0) ? 1 : 0; ?>-<?= $number_ads ?> out of <?= $number_ads ?> ads</p>
            </div>
        
            <hr>
    <?php
    

    $p_model = new Item;
    $user_ads = $p_model->get_by_user_id($selected_user["id"]);

    // echo "<pre>";
    // print_r($ads);


    foreach($user_ads as $ad) {

       


        // echo "<pre>";
        // print_r($ad);




        ?>

            <div class="card" id="project-<?= $ad["ad_id"] ?>">
                <div class="card-body">

                    <div class="row">

                        <div class="col-3">

                            <div class="search-profile-photo">
                                <img class="" src="<?= $ad["file_url"] ?>" alt="">

                            </div>

                        </div> <!-- col-3 -->

                        <div class="col-9">

                            <!-- title and price -->
                            <div class="row ml-3">
                                <a class="color" href="/posts/?id=<?= $ad["ad_id"] ?>&owner_id=<?= $ad["owner_id"] ?>"><h5 class="card-title"><?= $ad["title"] ?></h5></a>

                                <h5 class="ml-auto mr-3">$<?= $ad["price"] ?></h5>

                            </div>

                            <p class="card-text ml-3 text-muted"><?= $ad["address"] ?>, <?= $ad["city"] ?>, <?= $ad["province"] ?>   || <?= date("l, F d", strtotime($ad["time_posted"])) ?> </p>

                            <p class="card-text ml-3"><?= $ad["description"] ?></p>

                            <?php

                            if( empty($_GET["id"]) ) {

                            ?>

                                <div class="float-right mr-4">

                                    
                                    <div class="row mt-4" id="editingIcons">
        

                                        <a class="deleteButton color" item="<?= $ad["ad_id"] ?>" href="/posts/delete.php"><h4 class="fas fa-trash-alt ad-d-icon"></h4></a>

                                    </div>

        
                                    <div class="row mt-4">
        
                                        <p class="text-muted ml-4 edit-profile-text1 desc-profile-text">delete ad</p>
        
                                    </div>

                                </div>
                            <?php
                            }
                            ?>
                        
                        </div><!-- col-9 -->
                    </div> <!-- row -->
                </div> <!-- card-body -->
            </div> <!-- card -->
            
            
            
            <?php
    } // end foreach
    ?>

    </div> <!-- background-white -->

  
            
  

</div>


<?php

require_once("../elements/footer.php");

?>