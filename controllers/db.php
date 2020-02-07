<?php

class DB {

    public $data = array();

    public $params = array();

    function __construct() {
        // runs as soon as DB class is called upon

        //store all our $_POST data in the $data variable
        if( !empty($_POST)) {

            $conn = $this -> conn();

            $escPost = array();

            foreach( $_POST as $key => $value ) {
                $escPost[$key] = trim( mysqli_real_escape_string($conn, $value) );
            }

            $conn -> close();

            $this -> data = $escPost;

        }

        // store all our $_GET data in $params variable
        if( !empty($_GET)) {

            $conn = $this->conn();

            $escGet = array();

            foreach( $_GET as $key => $value ) {
                $escGet[$key] = trim( mysqli_real_escape_string($conn, $value) );
            }

            $conn->close();

            $this->params = $escGet;

        }
    }


    /*
    *
    * conn()
    * connects to the database
    *
    */

    protected function conn() {

        if(APP_DEBUG) echo "conn()<br>";


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

        $conn = new mysqli($servername, $username, $password, $dbname);

        if($conn->connect_error){
            die("Connection Failed: " . $conn->connect_error);
        }

        return $conn;
    }

    /*
    *
    * select
    * run a mysql select statement and return the results
    *
    */

    public function select($sql) {

        if(APP_DEBUG) echo "select()<br>";

        $conn = $this->conn();

        $result = $conn->query($sql);


        // Store the XSS cleaned data
        // XSS = cross-site scripting attack
        $xssArr = array();

        if( $result->num_rows > 0 ) {

            $x = 0;

            while ($row = $result->fetch_assoc()) {

                foreach ( $row as $column => $value ) {
                    $xssArr[$x][$column] = htmlspecialchars($value, ENT_QUOTES);
                }
                $x++;

            }

        } else {
            $_SESSION["errors"][] = "Error selecting from database: $sql";
        }

        $conn->close();
        return $xssArr;

    }


    /*
    * execute()
    * @params $sql
    *
    * Executes sql
    * @returns null
    */

    public function execute($sql) {
        $conn = $this -> conn();
        if($conn -> query($sql) !== true) {

            echo "Your statement: " . $sql . "<br> Error: " . $conn -> error;

            die("Error with the sql statement");

        }
    }





    /*
    * execute_return_id
    * @params $sql
    *
    * Executes sql query and returns the last inserted id
    * @returns int
    */

    public function execute_return_id($sql) {

        if(APP_DEBUG) echo "execute_return_id()<br>";

        $conn = $this -> conn();
        if ( $conn -> query($sql) !== TRUE ) {

            echo "Your statement: " . $sql . "<br> Error: " . $conn -> error;

            die("Error wiht the sql statement");

        }

        $last_id = $conn -> insert_id;

        $conn -> close();

        return $last_id;
    }


}



?>