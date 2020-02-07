<?php 

class Item extends DB {

    /*
    * get_all()
    * Get all projects from the database
    * return array
    */

    public function get_all() {

        // $user_id = (int)$_SESSION["user_logged_in"];

        if( !empty($_GET["search"]) ) {

            $search_query = $this->params["search"];

            $sql_where = "WHERE ads.title LIKE '%$search_query%' OR users.username LIKE '%$search_query%'";
        } else {
            $sql_where = "";
        }


        $sql = "SELECT  ads.*, ads.id AS 'ad_id',
                        users.*, users.id AS 'user_id'
                FROM ads 
                LEFT JOIN users 
                ON ads.owner_id = users.id
                $sql_where
                ORDER BY ads.time_posted DESC";

        $ads = $this->select($sql);

        return $ads;

    }


    /*
    * get_all_by_category()
    * Get all projects from the database
    * return array
    */



    public function get_all_by_category() {

        // $user_id = (int)$_SESSION["user_logged_in"];

        if(isset($_GET["category"])) {
            $category = $_GET["category"];
        } else {
            $category = "all";
        }


        if( !empty($_GET["search"]) ) {

            $search_query = $this->params["search"];

             
            // && (ads.ps1 == 1 OR ads.ps2 == 1 OR ads.ps3 == 1 OR ads.ps4 == 1 OR ads.psp == 1)
            
            $sql_where = "WHERE ads.title LIKE '%$search_query%' OR users.username LIKE '%$search_query%'";
        } else {
            $sql_where = "";
        }


        $sql = "SELECT  ads.*, ads.id AS 'ad_id',
                        users.*, users.id AS 'user_id'
                FROM ads 
                LEFT JOIN users 
                ON ads.owner_id = users.id
                $sql_where
                ORDER BY ads.time_posted DESC";

        $ads = $this->select($sql);

        return $ads;

    }

    /*
    * get_by_id()
    * get a project by id
    * @param $id
    * return array
    */

    public function get_by_id($id) {

        $id = (int)$id; // check that value is an integer

        $sql = "SELECT ads.*, ads.id AS 'ad_id', ads.email AS 'ad_email', 
                        users.id AS 'user_id', users.email AS 'user_email', users.username
                FROM ads 
                LEFT JOIN users
                ON ads.owner_id = 'user_id' 
                WHERE ads.id = $id";



        $ad = $this->select($sql)[0];

        return $ad;

    }

    // $sql = "SELECT ads.*, ads.id AS 'ad_id', 
    //                     users.*, users.id AS 'user_id'
    //             FROM ads 
    //             LEFT JOIN users
    //             ON ads.owner_id = 'user_id' 
    //             WHERE ads.id = $ad_id";





    /*
    * get_by_user_id()
    * get a project by id
    * @param $user_id
    * return array
    */

    public function get_by_user_id($user_id) {

        $user_id = (int)$user_id; // check that value is an integer

        $sql = "SELECT ads.*, ads.id AS 'ad_id',
                        users.*, users.id AS 'user_id'
                FROM ads 
                LEFT JOIN users
                ON ads.owner_id = users.id
                WHERE owner_id = $user_id";

        $ads = $this->select($sql);

        return $ads;

    }



    /*
    * on the posts index
    * get_by_user_id()
    * get a project by id 
    * @param $user_id
    * return array
    */

    public function get_post_info($user_id) {

        $user_id = (int)$user_id; // check that value is an integer

        $ad_id = $_GET["id"];
        

        $sql = "SELECT ads.*, ads.id AS 'ad_id',
                        users.*, users.id AS 'user_id'
                FROM ads 
                LEFT JOIN users
                ON ads.owner_id = users.id
                WHERE owner_id = $user_id & ad_id = $ad_id";

        $ads = $this->select($sql)[0];

        return $ads;

    }



    /*
    * add()
    * Add new post(ad) to the database
    * return null
    */

    public function add() {

        // ad owner information

        $title = $this->data["title"];
        $description = $this->data["description"];
        $province = $this->data["province"];
        $city = $this->data["city"];
        $address = $this->data["address"];
        $price = $this->data["price"];
        $phone = $this->data["phone"];
        $email = $this->data["email"];
        $current_time = date("Y-m-d H:i:s", time());
        $owner_id = $_SESSION["user_logged_in"];

        // Categories start

        // playstation selectors
        $ps1 = isset($this->data["ps1"]);
        $ps2 = isset($this->data["ps2"]);
        $ps3 = isset($this->data["ps3"]);
        $ps4 = isset($this->data["ps4"]);
        $psp = isset($this->data["psp"]);
        // xbox selectors
        $xb = isset($this->data["xb"]);
        $xb360 = isset($this->data["xb360"]);
        $xb1 = isset($this->data["xb1"]);
        // Nintendo selectors
        $nes = isset($this->data["nes"]);
        $snes = isset($this->data["snes"]);
        $n64 = isset($this->data["n64"]);
        $gc = isset($this->data["gc"]);
        $wii = isset($this->data["wii"]);
        $wiiu = isset($this->data["wiiu"]);
        $switch = isset($this->data["switch"]);
        $gb = isset($this->data["gb"]);
        // Retro selectors
        $sega = isset($this->data["sega"]);
        $atari = isset($this->data["atari"]);

        $main_photo = $_FILES["main_photo"]["name"];
        $photo_2 = $_FILES["photo_2"]["name"];
        $photo_3 = $_FILES["photo_3"]["name"];

        
        // echo "<pre>";
        // print_r($this->data);
        // exit;
        
        // Get the Util object class from util.php 
        $util = new Util;
        // Use the file_upload method of the Util class to upload our image 
        $main_photo = $util->file_upload(APP_ROOT . "/views/uploads/",  "main_photo");
        $photo_2 = $util->file_upload(APP_ROOT . "/views/uploads/",  "photo_2");
        $photo_3 = $util->file_upload(APP_ROOT . "/views/uploads/",  "photo_3");
        
        $main_photo = $main_photo["filename"];
        $file_url_2 = $photo_2["filename"];
        $file_url_3 = $photo_3["filename"];
        
        // echo "<pre>";
        // print_r($main_photo);
        // exit;
        // echo "<pre>";
        // print_r($file_url);
        // exit;

        // if a category was selected run the appropriate insert for that category
        
        if( $file_upload["file_upload_error_status"] == 0 && $ps1 == 1 ) {

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, ps1) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$ps1')";
    
            $this->execute($sql);
    
        } else if( $file_upload["file_upload_error_status"] == 0 && $ps2 == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, ps2) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$ps2')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $ps3 == 1 ){ 

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, ps3) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$ps3')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $ps4 == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, ps4) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$ps4')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $psp == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, psp) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$psp')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $xb == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, xb) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$xb')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $xb360 == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, xb360) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$xb360')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $xb1 == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, xb1) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$xb1')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $nes == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, nes) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$nes')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $snes == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, snes) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$snes')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $n64 == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, n64) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$n64')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $gc == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, gc) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$gc')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $wii == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, wii) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$wii')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $wiiu == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, wiiu) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$wiiu')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $switch == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, switch) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$switch')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $gb == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, gb) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$gb')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $atari == 1 ){

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, atari) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$atari')";
    
            $this->execute($sql);

        } else if( $file_upload["file_upload_error_status"] == 0 && $sega == 1 ){ 

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3, sega) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3', '$sega')";
    
            $this->execute($sql);

        } else if ( $file_upload["file_upload_error_status"] == 0 ) {

            $sql = "INSERT INTO ads (title, description, time_posted, province, city, address, price, phone, email, owner_id, file_url, file_url_2, file_url_3) 
                    VALUES ('$title', '$description', '$current_time', '$province', '$city', '$address', $price, '$phone', '$email', $owner_id, '$main_photo', '$file_url_2', '$file_url_3')";
    
            $this->execute($sql);
        }


    }

    /*
    * edit()
    * edit project from database
    * @param $project_id
    * return void
    */

    public function edit($id) {

        $project_id = (int)$id;

        // print_r($project_id);
        // exit;

        // $this->check_ownership($project_id);

        // process form data and update database
        $title = $this->data["title"];
        $price = $this->data["price"];
        $city = $this->data["city"];
        $province = $this->data["province"];
        $address = $this->data["address"];
        $email = $this->data["email"];
        $description = $this->data["description"];
        $current_user_id = (int)$_SESSION["user_logged_in"];

        // is there a new [image][with a name]
        $sql = "UPDATE ads 
                    SET title = '$title', description = '$description', price = '$price', city = '$city', province = '$province', email = '$email'
                    WHERE id = $project_id AND owner_id = $current_user_id";

        // print_r($sql);
        // exit;

        $this->execute($sql);

    }


       /*
    * add_view($id)
    * add 1 view to the ad in database
    * @param 
    * return views
    */

    // public function add_view($id) {

    //     $new_views = (int)$id["views"] += 1 

    //     $sql = "UPDATE ads SET ads.views = $new_views WHERE id = $id";

    //     $this->execute($sql);

        
    // }
    


    /*
    * delete()
    * delete a project form the database
    * return void
    */

    public function delete() {
        
        $current_user_id = (int)$_SESSION["user_logged_in"];

        $ad_id = (int)$_POST["id"];

        
        // $this->check_ownership($ad_id);
        
        // $ad_image = $this->get_by_id($ad_id)["file_url"];
        
        // if(!empty($ad_image)) {
        //     if( file_exists(APP_ROOT . "/views" . $ad_image) ) {
                
        //         unlink( APP_ROOT . "/views" . $ad_image );
        //         // UNLINK will remove the file from the folders 
        //     }
        // }
        
        $sql = "DELETE FROM ads WHERE id = $ad_id AND ads.owner_id = $current_user_id";
        
        // echo "<pre>";
        // print_r($sql);
        // exit;

        $this->execute($sql);
    }

    /*
    * check_ownership()
    * check if user is the owner of project
    * @parm $project_id
    * return boolean
    */

    public function check_ownership($project_id) {

        $project_id = (int)$project_id;

        $sql = "SELECT * FROM projects WHERE id = $project_id";

        $project = $this->select($sql)[0];

        if( $project["user_id"] == $_SESSION["user_logged_in"] ) {
            return true;
        } else {
            header("Location: /");
            exit();
        }

    }
}

?>