<?php



class Util extends DB {

    public function file_upload($target_dir = APP_ROOT . "/views/uploads/", $inputNameAttr = "fileToUpload") {

        // return an aray of errors, or the filename on success

        $file_upload = array(
            "file_upload_error_status" => 0,
            "errors" => array(),
            "filename" => ""
        );

        // Check if the $_FILES input exists
        if( !empty($_FILES[$inputNameAttr]["name"]) ) {
            // echo "<pre>";
            // print_r($_FILES);
            // exit;

            // Check if user folder exists
            if(!file_exists( $target_dir . $_SESSION["user_logged_in"] )) {
                // mkdir = make directory
                mkdir($target_dir . $_SESSION["user_logged_in"]);
            }

            $filename = time() . basename($_FILES[$inputNameAttr]["name"]);
            $target_file = $target_dir . $_SESSION["user_logged_in"] . "/" . $filename;
            // echo "<pre>";
            // print_r($target_file);
            // exit;

            // checks the image size, BUT, if not an image, will return an error
            $check = getimagesize($_FILES[$inputNameAttr]["tmp_name"]);
            // echo "<pre>";
            // print_r($check);
            // exit;

            if($check !== false) {

                $file_upload["file_upload_error_status"] = 0;

            } else {

                $file_upload["file_upload_error_status"] = 1;
                $file_upload["errors"][] = "File is not an image";
            }

            // If file exists
            if(file_exists($target_file)) {

                $file_upload["file_upload_error_status"] = 1;
                $file_upload["errors"][] = "File already exists";
            }

            // Check the file size
            if($_FILES[$inputNameAttr]["size"] > 10000000000000) {
                
                $file_upload["file_upload_error_status"] = 1;
                $file_upload["errors"][] = "File limit is " . ($allowedSize / 10000000000000) . "MB";
            }

            // Check the file type
            $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $valid_file_types = array("jpg", "png", "jpeg", "gif");

            if(!in_array($file_type, $valid_file_types)) {

                $file_upload["file_upload_error_status"] = 1;
                $file_upload["errors"][] = "Only JPG PNG or GIF files are allowed";
            }


            // If no errors, UPLOAD TO DATABASE!!!

            if($file_upload["file_upload_error_status"] == 0) {

                if(move_uploaded_file($_FILES[$inputNameAttr]["tmp_name"], $target_file)) {
                    $file_upload["filename"] = mysqli_real_escape_string($this->conn(), str_replace(APP_ROOT . "/views", "",  $target_file) );

                    return $file_upload;
                }

            } else {
                $_SESSION["errors"] = $file_upload["errors"];
            }

            return $file_upload;

        } // !empty($_FILES)
 
    } // public function file upload


} // class Util

?>