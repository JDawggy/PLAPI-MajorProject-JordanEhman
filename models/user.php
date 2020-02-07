<?php

// Defined the class of User
class User extends DB {

    /*
    * delete()
    * deletes user
    * @returns null
    */

    public function delete() {

        if(APP_DEBUG) echo "exists()<br>";

        // check the database to see if the user exists
        $id = $this->data["id"];

        // print_r($id);
        // exit;

    
        $sql = "DELETE FROM users WHERE id = $id"; 

        // print_r($sql);
        // exit;

        $this->execute($sql);
    
    }


    /*
    * get_all()
    * get all users data from the databse
    * @params none
    * @returns array
    */

    public function get_all() {

        if( !empty($_GET["search"]) ) {
            $search_query = $this->params["search"];

            $search_query = str_replace("@", "", $search_query);

            $sql_where = "WHERE users.username LIKE '%$search_query%' OR users.email LIKE '%$search_query%'";
        } else {
            $sql_where = "";
        }

        $sql = "SELECT * FROM users $sql_where";

        $user = $this->select($sql);

        foreach($user AS $key => $person) {
            $user[$key]["title"] = $person["first_name"] . " " .$person["last_name"];
        }

        return $user;

    }



    /*
    * get_by_id()
    * gets a users data from the database by ID
    * @params $user_id
    * @returns array
    */

    public function get_by_id($user_id) {

        $sql = "SELECT * FROM users WHERE id = $user_id";

        $user = $this->select($sql)[0];

        return $user;

    }




    /*
    * get_ad_owner()
    * gets a users data from the database by ID
    * @params $user_id
    * @returns array
    */

    public function get_ad_owner($ad_id) {

        $sql = "SELECT ads.*, ads.id AS 'ad_id',
                        users.*, users.id AS 'user_id'
                FROM ads
                LEFT JOIN users
                ON ads.owner_id = 'user_id'
                WHERE 'ad_id' = $ad_id";

        $user = $this->select($sql);

        return $user;

    }

    // $sql = "SELECT users.*, users.id AS 'user_id', 
    // ads.*, ads.id AS 'ad_id'
    //         FROM users
    //         LEFT JOIN ads
    //         ON ";





    /*
    * exists()
    * checks if the user already exists in the database 
    * @returns array
    */

    public function exists() {

        if(APP_DEBUG) echo "exists()<br>";

        // check the database to see if the user exists
        $username = $this->data["username"];
        $email = $this->data["email"];
    
        $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email' LIMIT 1"; 

        $user = $this->select($sql);

        return $user;
    
    }


    /*
    * add()
    * adds the new user to the database 
    * @returns int
    */

    public function add() {

        if(APP_DEBUG) echo "add()<br>";

        $username = $this->data["username"];
        $email = $this->data["email"];
        $password = password_hash( trim($_POST["password"]), PASSWORD_DEFAULT );
        $profile_pic = $_FILES["uploaded_profile_photo"]["name"];
        $current_time = date("Y-m-d H:i:s", time());

        
        $sql = "INSERT INTO users (username, email, password, date_created) VALUES ('$username', '$email', '$password', '$current_time')";

        $new_user_id = $this->execute_return_id($sql);
        
        $_SESSION["user_logged_in"] = $new_user_id;
        
        
        // echo "<pre>";
        // print_r($_SESSION);
        // exit;
        
        
        // $_FILES["fileToUpload"]["name"]

        if( !empty($_FILES["uploaded_profile_photo"]["name"]) ) { // check if new photo was uploaded

            $util = new Util;
            $file_upload = $util->file_upload(APP_ROOT . "/views/uploads/", "uploaded_profile_photo"); // Upload the new file
            
            $filename = $file_upload["filename"];
            
            // print_r($sql);
            // exit;
            
            if( $file_upload["file_upload_error_status"] == 0 ) { 
                
                $sql = "UPDATE users SET profile_pic = '$filename' WHERE id = $new_user_id";
                
                $update = $this->execute($sql);

                // return $new_user_id;

            }

        }


         return $new_user_id;
    }



    /*
    * edit()
    * edit current user
    * @returns null
    */

    public function edit() {
        $id = (int)$_SESSION["user_logged_in"];
        $username = $this->data["username"];
        $email = $this->data["email"];
        $new_password = password_hash( trim($_POST["password"]), PASSWORD_DEFAULT );

        if( !empty($_FILES["fileToUpload"]["name"]) ) { // check if new photo was uploaded

            $util = new Util;
            $file_upload = $util->file_upload(); // Uplload the new file
            $filename = $file_upload["filename"];

            if( $file_upload["file_upload_error_status"] == 0 ) { // gets the old image

                $old_profile_image = $this->get_by_id($id)["profile_pic"];

                $sql = "UPDATE users SET profile_pic = '$filename' WHERE id = $id";

                $this->execute($sql);

                // delete the previous file from the folder
                if( !empty($old_profile_image) ) {
                    if( file_exists( APP_ROOT . "/views" . $old_profile_image) ) { 
                        
                        unlink( APP_ROOT . "/views" . $old_profile_image );

                    } // file_exists
                } // !empty

            }

        }



        
        if ( $_POST["password"] == "" ) {

            $sql = "UPDATE users SET username = '$username', email = '$email' WHERE id = $id";

        } else {

            $sql = "UPDATE users SET username = '$username', email = '$email', password = '$new_password' WHERE id = $id";  

        }

        $this->execute($sql);
    }


    
    
    
    /*
    * login()
    * logs in the user
    * @returns null
    */
    
    public function login() {
        
        $_SESSION = array(); // empty the session first to start fresh

        $username = $this->data["username"];

        $sql = "SELECT * FROM users WHERE username = '$username' OR email = '$username' LIMIT 1";

        $user = $this->select($sql)[0];

        // print_r($user);
        // exit;

        if( password_verify( trim($_POST["password"]), $user["password"] ) ) {
            
            $_SESSION["user_logged_in"] = $user["id"];

            // if remember is set, set the cookie of user_logged_in
            if( !empty($_POST["remember"]) ) {
                                                        // time()   // days 
                                                                        //hours of a day 
                                                                            // minutes of an hour 
                                                                                // seconds in a minute
                setcookie("user_logged_in", $user["id"], time() + (7 * 24 * 60 * 60), "/");
            }
        } else {
            $_SESSION["login_attempt_msg"] = "<p class='text-danger'>Incorrect username or password</p>";
        }
    }
    
    
}
?>