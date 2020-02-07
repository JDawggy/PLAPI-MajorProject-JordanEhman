<?php
require_once("../../controllers/includes.php");

require_once("../elements/header.php");
require_once("../elements/nav.php");

if( $_SERVER["SERVER_NAME"] == "www.justjordan.ca") {

    $servername = "localhost";
    $username = "JDawwgy";
    $password = "y34Myj0@";
    $dbname = "doily";

} else {
    
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "doily";
}

$db = new mysqli($servername, $username, $password, $dbname);

// echo "<pre>";
// print_r($_SESSION);

if( !empty($_GET["id"]) ) {

    $i_model = new Item;

    $user_id = (int)$_GET["owner_id"];

    $selected_post = $i_model->get_post_info($user_id);


    // echo "<pre>";
    // print_r($selected_post);



    // view counter start

    // $v_model = new Item;

    // $views = $v_model->add_view($selected_post["ad_id"]);

    // print_r($views);


    // view counter start
    $sql = "UPDATE ads 
            SET views = " . ( $selected_post["views"] += 1 ) . "
            WHERE id = " . $selected_post["ad_id"];

    $view_results = $db->query($sql);

    // echo "<pre>";
    // print_r($selected_post);





} else {;

    header("Location: /");
    
}

?>

<div class="container">

    <div class="row top-space">

        <div class="col-5">
            
            <h3 class="color"><?= $selected_post["title"] ?></h3>
            
            <h4 class="ad-price mb-3">$<?= $selected_post["price"] ?></h4>

        </div>


        <?php

        if( $_SESSION["user_logged_in"] == $_GET["owner_id"] ) {

        ?>
        
        <div class="col-1">


        </div>

    
        <div class="col-2">

            <div class="background-white-r">
                <br>
                <div class="row ml-3">

                    <h4 class="far fa-eye ml-2 color"></h4>
                    <p class="mr-4 ml-1"><?= $selected_post["views"] ?></p>


                    <form class="edit-icon" action="/posts/edit.php" method="post" id="editProfile">

                        <input type="hidden" name="id" value="<?= $selected_post["ad_id"] ?>">

                        <a class="color" href="javascript:$('#editProfile').submit();"><h4 class="fas fa-edit"></h4></a>

                    </form>
                    


                </div>
                <div class="row ml-4">

                    <p class="text-muted views-text desc-text">views</p>
                    <p class="text-muted inline edit-text desc-text">edit ad</p>

                </div>
            </div>

        </div>

        


        <?php

        }

        ?>

        <div class="ml-auto ml-4 mt-1 col-md-4">
            <h5 class="text-muted">posted on <?= date("l, F d", strtotime($selected_post["time_posted"])) ?></h5>
            <h5><?= $selected_post["address"]?>, <?= $selected_post["city"] ?>, <?= $selected_post["province"] ?></h5>
        </div>

    </div>





    <div class="row">
        
        <div class="col-md-8">

            <div class="row">


                <div class="col-md-5">
        
                    <div class="main-photo">
                        <img class="" src="<?= $selected_post["file_url"] ?>" alt="">
        
                    </div>
                    
        
                </div> <!-- col-5 -->
        
        
                <div class="col-md-3 more-photos">
        
                    <div class="top-photo">
        
                        <img class="" src="<?= $selected_post["file_url_2"] ?>" alt="">
        
                    </div>
        
                    <div class="bottom-photo">
        
                        <img class="" src="<?= $selected_post["file_url_3"] ?>" alt="">
        
                    </div>
        
                </div> <!-- col-3 -->

            </div>


           

            <!-- The underneith main photos section -->

            <div class="background-white mt-5">

                <div class="row user">

                    <div class="owner-profile-pic ml-5 mt-4">

                        <?php
                        if (isset($selected_post["profile_pic"])){
                        ?>
                            <img src=" <?= $selected_post['profile_pic'] ?>" alt="">
                        <?php
                        } else {
                        ?>
                            <img src="/assets/photos/profile-photo.jpg" alt="">
                        <?php
                        }

                        $p_model = new Item;

                            $user_ads = $p_model->get_by_user_id($selected_post["owner_id"]);

                            // echo "<pre>";
                            // print_r($user_ads);

                            $number_ads = count($user_ads);
                        ?>

                    </div>
                    
                    <a class="link" href="/users?id=<?= $selected_post["user_id"] ?>"><h4 class="owner-username"><?= $selected_post["username"] ?></h4></a>



                    <!-- SELLER RATING MODAL -->
                    <!-- Button trigger modal -->

                    <a class="ml-auto mr-5 owner-rating color" href="" data-toggle="modal" data-target="#ratingModal"><h4 class="">Seller Rating: <i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></h4></a>

                   

                    <!-- Modal -->
                    <div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>



                        <div class="modal-body">

                            <form action="">

                                <div class="row love_options">
                                    <p class="mr-2 ml-3">Your rating: </p>
                                    <a href=""><i id="star1" class="far fa-star mt-1"></i></a>
                                    <a href=""><i id="star2" class="far fa-star mt-1"></i></a>
                                    <a href=""><i id="star3" class="far fa-star mt-1"></i></a>
                                    <a href=""><i id="star4" class="far fa-star mt-1"></i></a>
                                    <a href=""><i id="star5" class="far fa-star mt-1"></i></a>
                                </div>
    
                                <p>description:</p>
                                <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>

                            </form>    



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" id="submitReview" class="btn btn-primary" data-dismiss="modal">Submit Review</button>
                        </div>
                        </div>
                    </div>
                    </div>









                </div>

                <hr>
                
                <div class="row">

                    <div class="col-4 text-center border-right">

                        <a href="/users/index.php"><h4 class="color mb-4 mt-3">Number of Ads</h4></a>
                        <h4 class=""><?= $number_ads ?></h4>

                    </div>

                    <div class="col-4 text-center border-right">

                        <a href="/users/reviews.php"><h4 class="color mb-4 mt-3">Ratings & Reviews</h4></a>



                        <div class="row ml-3">

                            <p class="owner-info"><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></p>
            
                            <p class="owner-info ml-2">Great thing...</p>

                        </div>

                        <div class="row ml-3">

                            <p class="owner-info"><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i><i class="far fa-star"></i></p>
            
                            <p class="owner-info ml-2">Great item...</p>

                        </div>



                    </div>

                    <div class="col-4 text-center">

                        <h4 class="color mb-4 mt-3">Member Since</h4>
                        <h5 class=""><?= date("l, F d", strtotime($selected_post["date_created"])) ?></h5>
                        

                    </div>
                </div>  <!-- row -->
                <br>

            </div> <!-- background-white -->


        </div>




        <!-- Right Side -->

        <div class="col-md-4">

            <div class="background-white">

                <br>

                <h5 class="color ml-3">Description:</h5>

                <p class="mt-3 m-3"><?= $selected_post["description"] ?></p>
                <br> 

            </div>

            <div class="background-white text-center mt-3">


                <div class="col-12"><br>

                    <h5 class="color mt-3">Contact <?= $selected_post["username"] ?></h5>
    
                    <button class="btnf mb-3 mt-3">Is this still available?</button>
    
                    <button class="btnf mb-3">Are you free to meet?</button>
    
                    <button class="btnf mb-3">would you accept $____</button>
    
                    <textarea class="form-control" name="" id="" cols="30" rows="5" placeholder="write your own message here"></textarea><br>

                </div>


            </div> <!-- col-12 -->

        </div> <!-- col-4 -->


    </div> <!-- row -->

</div> <!-- container -->





<?php

require_once("../elements/footer.php");

?>