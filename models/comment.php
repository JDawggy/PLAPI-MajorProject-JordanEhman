<?php

class Review extends DB {

    /*
    * add()
    * adds comment to the database and returns a list of all comments
    * 
    * @param $comment_count
    * @return arrays
    */

    public function add($comment_data) {
        
        $comment = $this->data["comment"];
        $project_id = $this->data["project_id"];
        $user_id = (int)$_SESSION["user_logged_in"];
        $posted_time = date("Y-m-d H:i:s");
        
        $sql = "INSERT INTO comments (comment, posted_time, project_id, user_id) VALUES ('$comment', '$posted_time', $project_id, $user_id)";

        $comment_id = $this->execute_return_id($sql);


        if(!empty($comment_id) && is_int($comment_id)) {
            // get the comment count for current project
            $comment_count = $this->get_count($project_id);

            // get all comments for the current project 
            $all_project_comments = $this->get_all_by_project_id($project_id);

            // pass the data back to scripts.js in our $comment_data
            $comment_data["error"] = false; 
            $comment_data["comment_count"] = $comment_count;
            $comment_data["comments"] = $all_project_comments;

            // The value returned by the function
            return $comment_data;
        }

    }

    public function delete() {

        $current_user_id = (int)$_GET["id"];
        
        $sql = "DELETE FROM comments WHERE id = $current_user_id";

        $this->execute($sql);

    }

    public function get_all_by_project_id($project_id) {

        $project_id = (int)$project_id;
        $user_id = (int)$_SESSION["user_logged_in"];

        $sql = "SELECT comments.*, users.username, 
                IF(comments.user_id = $user_id, 'true', 'false') AS user_owns
                FROM comments
                LEFT JOIN users
                ON comments.user_id = users.id
                WHERE comments.project_id = $project_id
                ORDER BY comments.posted_time ASC
                LIMIT 100";

        $project_comments = $this->select($sql);

        return $project_comments;
    }

    public function get_count($project_id) {

        $project_id = (int)$project_id;

        $sql = "SELECT COUNT(id) AS comment_count FROM comments WHERE project_id = $project_id";

        $comment_count = $this->select($sql)[0];

        return $comment_count["comment_count"];


    }
    
}

?>