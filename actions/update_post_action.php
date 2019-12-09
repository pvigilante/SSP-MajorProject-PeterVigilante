<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/conn.php");

/*
must be logged in
role is less than 3
article is published under the current user
take us back to the users articles
*/
$errors = [];

if( isset($_SESSION["user_id"]) && ( $_SESSION["role"] < 3 )):

    $article_id = $_POST["article_id"];

    if(isset($_POST["action"]) && $_POST["action"] == "update"):

        // Get the current by session id
        $user_id    = $_SESSION["user_id"];
        $title      = htmlspecialchars($_POST["title"], ENT_QUOTES);
        $content    = htmlspecialchars($_POST["content"], ENT_QUOTES);
        $date_modified = date("Y-m-d H:i:s");

        // if profile_pic is set and there are no errors
        if( isset($_FILES["featured_image"]) && $_FILES["featured_image"]["error"] == 0){
            if(
                (   $_FILES["featured_image"]["type"] == "image/jpeg" || 
                    $_FILES["featured_image"]["type"] == "image/jpg"  ||
                    $_FILES["featured_image"]["type"] == "image/png"  ||
                    $_FILES["featured_image"]["type"] == "image/gif" 
                ) 
                &&
                $_FILES["featured_image"]["size"] < 2000000
            ) {
                // File is correct type and size
                
                $file_name = $_SERVER["DOCUMENT_ROOT"] ."/uploads/". $_FILES["featured_image"]["name"];

                $file_name = explode(".", $file_name); // explode a string into an array
                $file_extension = strtolower( end( $file_name ) ); // get the last element of the array
                array_pop($file_name); // remove the last element from the array
                $file_name[] = date("YmdHis"); // get current datetime
                $file_name[] = $file_extension; // Add the extension back to the end of the array
                $file_name = implode(".", $file_name); // glues a array together into a string

                // Check if file already exists
                if( !file_exists( $file_name ) ) {
                    // upload to uploads folder
                    if(move_uploaded_file( $_FILES["featured_image"]["tmp_name"], $file_name)) {
                        // Insert into database the image
                        $insert_image_query = "INSERT INTO images (url, owner_id) VALUES ('".str_replace($_SERVER["DOCUMENT_ROOT"], "", $file_name)."', $user_id)";
                        if( mysqli_query($conn, $insert_image_query) ){
                            $featured_image_id = mysqli_insert_id($conn);
                        }
                    }

                } else {
                    $errors[] = "File Already Exists";
                }

            } else {
                $errors[] = "Incorrect File Type.";
            }

        } else {
            $featured_image_id = false;
        }


        if($title != "" && $content != ""){
            // Title and content are filled, continue
            $query = "  UPDATE articles
                        SET title = '$title',
                            content = '$content',
                            date_modified = '$date_modified'";
            if( $featured_image_id ) $query .= ", image_id = $featured_image_id";
            $query .= " WHERE id = $article_id";
            
            if(mysqli_query($conn, $query)){

                // Send me to articles.php page with the article id set
                header("Location: http://".$_SERVER["SERVER_NAME"]."/articles.php?id=".$article_id);
            } else {
                $errors[] = "Something went wrong: " . mysqli_error($conn);
            }

        } else {
            // Title or content are empty
            $errors[] = "Please fill in all fields";
        }
    
    elseif(isset($_POST["action"]) && $_POST["action"] == "delete"):
        // Delete the post where the id  
        $query = "DELETE FROM articles WHERE id = $article_id";
        if(mysqli_query($conn, $query)) {
            header("Location: http://".$_SERVER["SERVER_NAME"]."/articles.php");
        } else {
            $errors[] = "Something went wrong: " . mysqli_error($conn);
        }
    endif;
    
else:
    header("Location: http://".$_SERVER["SERVER_NAME"]);
endif;

///////////////////////////
// CHECK FOR ERRORS ARRAY
/////////////////////////
if( !empty($errors) ) {
    $query = http_build_query( array("errors" => $errors) );
    header("Location: " . strtok($_SERVER["HTTP_REFERER"], "?") . "?" . $query);
}
?>