<?php

require_once("../../controllers/includes.php");


        
$project_id = $_POST["id"];

$p_model = new Item; // Start project model

$project = $p_model->get_by_id($project_id);

require_once("../elements/header.php");
require_once("../elements/nav.php");



// echo "<pre>";
// print_r($project);

?>
<div class="container">

<div class="row">

    <div class="col-md-8 top-space mx-auto background-white">
        <h2 class="mt-3">Edit Post</h2>

        <form action="/posts/run_edit.php" method="POST" enctype="multipart/form-data">

            <input type="hidden" name="id" value="<?= $project["ad_id"] ?>">

            <div class="form-group">
                <label for="username">Title</label>
                <input type="text" id="username" class="form-control new-form" value="<?= $project["title"] ?>" name="title">
            </div>

            <div class="form-group mt-3">
                <label for="repeat password">Item Description</label>
                <textarea name="description" class="form-control new-form" placeholder="<?= $project["description"] ?>" id="" cols="30" rows="10"><?= $project["description"] ?></textarea>                              
            </div>

            <div class="form-group">
                <label for="password">price</label>
                <input type="text" class="form-control new-form" value="<?= $project["price"] ?>" name="price">
            </div>

            <div class="form-group">
                <label for="password">email</label>
                <input type="text" class="form-control new-form" value="<?= $project["email"] ?>" name="email">
            </div>

            <div class="form-group">
                <label for="password">Province</label>
                <input type="text" class="form-control new-form" value="<?= $project["province"] ?>" name="province">
            </div>

            <div class="form-group">
                <label for="password">City</label>
                <input type="text" class="form-control new-form" value="<?= $project["city"] ?>" name="city">
            </div>

            <div class="form-group">
                <label for="password">Address</label>
                <input type="text" class="form-control new-form" value="<?= $project["address"] ?>" name="address">
            </div>

            

            <div class="text-right">
                <button type="submit" class="btnn">Update Ad</button>
            </div><br>
        </form>

    </div> <!-- background-white -->
</div> <!-- row -->
<br>

</div> <!-- container -->


<?php

require_once("../elements/footer.php");

?>