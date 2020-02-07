$(document).ready(function(){
    // coding begins 



    /*
    *
    *
    * 
    * SEARCH BAR
    * 
    * 
    */

   $("#search_form").on("submit", function(e){
    // e.preventDefault();
    });

    $("input#search").on("keyup", function(e){
        var user_search = $(this).val();

        if(user_search.length > 3){
            // console.log(user_search);

            $.ajax({

                type: "get",

                url: "/search_results.php",

                data: {
                    search: user_search
                },

                success: function(results){

                    results = JSON.parse(results);

                    var output = "<div class='list-group'>";

                    $.each(results, function(i, result){
                        output += "<a class='list-group-item list-group-item-action' href='/projects?id=" + result.id + "'>" + result.title + "</a>";
                    });

                    output += "</div>";

                    $("#search_results").html(output);

                    console.log(results);

                }

            });

        } else {
            $("#search_results").html("");
        }


    });



    /*
    *
    *
    * 
    * FILE UPLOADING
    * 
    * 
    */

   $("#file-with-preview").on("change", function(){
    previewFile();
    });

    function previewFile() {
        // Select the preview <img>
        // Get the file contents from upload field
        // Set te src of our <img> to the upladed file location

        var preview = $("#img-preview");
        var file = $("#file-with-preview")[0].files[0];
        
        console.log(file);

        var reader = new FileReader;

        // Run when file finished reading
        reader.onloadend = function() {
            // console.log( reader.result );
            preview.attr("src", reader.result);
        }

        if(file) {
            reader.readAsDataURL(file);
        } else {
            preview.attr("src", "")
        }

    }

    /*
    *
    *
    * 
    * 2nd and 3rd file uploading
    * 
    * 
    */

   $("#file-with-preview-two").on("change", function(){
    previewFileTwo();
    });

    function previewFileTwo() {
        // Select the preview <img>
        // Get the file contents from upload field
        // Set te src of our <img> to the upladed file location

        var preview = $("#img-preview-two");
        var file = $("#file-with-preview-two")[0].files[0];
        
        console.log(file);

        var reader = new FileReader;

        // Run when file finished reading
        reader.onloadend = function() {
            // console.log( reader.result );
            preview.attr("src", reader.result);
        }

        if(file) {
            reader.readAsDataURL(file);
        } else {
            preview.attr("src", "")
        }

    }


    $("#file-with-preview3").on("change", function(){
        previewFile3();
        });
    
        function previewFile3() {
            // Select the preview <img>
            // Get the file contents from upload field
            // Set te src of our <img> to the upladed file location
    
            var preview = $("#img-preview3");
            var file = $("#file-with-preview3")[0].files[0];
            
            console.log(file);
    
            var reader = new FileReader;
    
            // Run when file finished reading
            reader.onloadend = function() {
                // console.log( reader.result );
                preview.attr("src", reader.result);
            }
    
            if(file) {
                reader.readAsDataURL(file);
            } else {
                preview.attr("src", "")
            }
    
        }










    
    /*
    *
    *
    * 
    * Delete button on users index
    * 
    * 
    */

    $(".deleteButton").on("click", function(e){
    
        var ad_id = $(this).attr("item");

        console.log(ad_id);

        e.preventDefault();

        $.ajax({

            type: "post",

            url: "/posts/delete.php",

            data: {
                id: ad_id
            },

            success: function(result){

                console.log(result);

                $("#project-" + ad_id).fadeOut("3000", function(){
                    $("#project-" + ad_id).remove();
                });





               

            }

        });


    
    });










    /*
    *
    *
    * 
    * Star 1
    * 
    * 
    */

    $("body").on("click", "#star1", function(e){

        

        $(".star1").removeClass(".far").addClass(".fas");

        e.preventDefault();


        // var project_id = rate_btn.data("project"); 

        // console.log(project_id);

        // $.post(
        //     "/rating/add.php", 
        //     {
        //         "project_id": project_id
        //     },
        //     function(rating_results) {
        //         // console.log(rating_results);
        //         rating_results = JSON.parse(rating_results);

        //         console.log(rating_results);

        //         if(rating_results.error == false) { // love worked!
        //             if(rating_results.rate == "1star") {
                        
        //                 star1.removeClass("far").addClass("fas");
                        
        //             } else if(rating_results.rate == "unloved") {
                        
        //                 star1.removeClass("fas").addClass("far");

        //             }
        //         }
        //     }

        // );

    });







    /*
    *
    *
    * 
    * Star 2
    * 
    * 
    */

    $("body").on("click", "#star2", function(e){

        e.preventDefault();

    });






    /*
    *
    *
    * 
    * Star 3
    * 
    * 
    */

    $("body").on("click", "#star3", function(e){

        e.preventDefault();

    });





    /*
    *
    *
    * 
    * Star 4
    * 
    * 
    */
    $("body").on("click", "#star4", function(e){

        e.preventDefault();

    });






    /*
    *
    *
    * 
    * Star 5
    * 
    * 
    */

    $("body").on("click", "#star5", function(e){

        e.preventDefault();

    });











    /*
    *
    *
    * 
    * LOVE BUTTON
    * 
    * 
    */

    $("#projectFeed").on("click", ".love-btn", function(){

        // Store the components in variables
        var love_btn = $(this);
        var love_icon = love_btn.find(".love-icon");
        var love_count = love_btn.find(".love-count");

        // Values
        var project_id = love_btn.data("project"); 

        $.post(
            "/loves/add.php", 
            {
                "project_id": project_id
            },
            function(rating_results) {
                // console.log(rating_results);
                rating_results = JSON.parse(rating_results);

                console.log(rating_results);

                if(rating_results.error == false) { // love worked!
                    if(rating_results.loved == "loved") {
                        
                        love_icon.removeClass("far").addClass("fas");
                        love_count.html(rating_results.love_count);
                        
                    } else if(rating_results.loved == "unloved") {
                        
                        love_icon.removeClass("fas").addClass("far");
                        love_count.html(rating_results.love_count);

                    }
                }
            }

        );

    });



    /*
    *
    *
    * 
    * SUBMIT COMMENT
    * 
    * 
    */

    $("#projectFeed").on("submit", ".comment-form", function(e) {
        e.preventDefault();

        // store comment components 
        var comment_form = $(this);
        var comment_box = comment_form.find(".comment-box");
        var comment_count = comment_form.closest(".project-post").find(".comment-count");
        var comment_loop = comment_form.closest(".project-post").find(".comment-loop");

        console.log(comment_loop);

        // store the values
        var project_id = comment_form.data("project");
        var comment_text = comment_box.val();

        console.log(project_id, comment_text);

        if( $.trim( comment_text ).length > 0 ) { // if something is typed
            $.post(
                // url
                '/comments/add.php',
                // data
                {
                    project_id: project_id,
                    comment: comment_text
                },
                // complete function
                function(comment_data) {
                    // do stuff here
                    console.log(comment_data);
                }
            );
        }
    });





    
});