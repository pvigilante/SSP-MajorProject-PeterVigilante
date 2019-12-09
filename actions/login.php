<?php
require_once( $_SERVER["DOCUMENT_ROOT"] . "/conn.php");

$errors = [];

// If the button action was login
if( isset($_POST["action"]) && $_POST["action"] == "login" ) :
    // get the users email and password
    // connect to users table
    // check if user exists and password matches
    // if not send error
    // if correct, login and go to index

    if( 
        ( isset($_POST["email"]) && $_POST["email"] != "" ) &&
        ( isset($_POST["password"]) && $_POST["password"] != "" )
      ) {
        $email = $_POST["email"];
        $password = md5($_POST["password"]);

        $query_users = "SELECT * 
                        FROM users 
                        WHERE email = '" . $email . "' 
                          AND password = '" . $password . "'
                        LIMIT 1";
        $user_result = mysqli_query($conn, $query_users);

        // Check if user is in database
        if( mysqli_num_rows($user_result) > 0 ) {
            // User found!!!!

            // Get all the users rows from the database
            while($user = mysqli_fetch_array($user_result)) {
                session_destroy(); // Destroy current session
                session_start(); // Start Fresh session

                $_SESSION["email"]  = $user["email"];
                $_SESSION["role"]   = $user["role"];
                $_SESSION["user_id"]    = $user["id"];

                header( "Location: http://" . $_SERVER["SERVER_NAME"] );
            }
        } else {
            $errors[] = "Email or Password incorrect.";
        }

    } else {
        $errors[] = "Please Fill Out Username & Password";
    }

    // IF ACTION IS SIGN-UP
elseif( isset($_POST["action"]) && $_POST["action"] == "signup" ) :

    $first_name = $_POST["first_name"];
    $last_name  = $_POST["last_name"];
    $email      = $_POST["email"];
    $password   = md5($_POST["password"]);
    $password2  = md5($_POST["password2"]);
    $address    = $_POST["address"];
    $address2   = $_POST["address2"];
    $city       = $_POST["city"];
    $province_id = ( isset($_POST["province"]) ) ? $_POST["province"] : 0;
    $postal_code= $_POST["postal_code"];
    
    $newsletter = $_POST["newsletter"];

    $date_created = date("Y-m-d H:i:s");
    $role = (isset($_POST["role"])) ? $_POST["role"] : 3;


    if($password == $password2 && strlen($password) > 7){
        // Continue
        if( isset($_POST["agree_terms"]) ) {
            // Continue
            if($email != "" && $first_name != "" && $last_name != ""){
                // I MADE IT!!!!

                $new_user_query = "INSERT INTO users 
                                    (email, 
                                     password, 
                                     role, 
                                     first_name, 
                                     last_name,
                                     province_id,
                                     address,
                                     address2,
                                     city,
                                     postal_code,
                                     newsletter,
                                     date_created) 
                             
                             VALUES ('$email', 
                                     '$password', 
                                     $role, 
                                     '$first_name', 
                                     '$last_name',
                                     $province_id,
                                     '$address',
                                     '$address2',
                                     '$city',
                                     '$postal_code',
                                     $newsletter,
                                     '$date_created'
                                     )"; 
                
                if( !mysqli_query($conn, $new_user_query) ) {
                    echo mysqli_error($conn);
                } else {
                    // Log user in and go to home page
                    $user_id = mysqli_insert_id($conn);

                    session_destroy();
                    session_start();

                    $_SESSION["user_id"] = $user_id;
                    $_SESSION["role"]    = $role;
                    $_SESSION["email"]   = $email;

                    header("Location: http://". $_SERVER["SERVER_NAME"]);

                }

                // END I MADE IT!!!!
            } else {
                $errors[] = "Please fill-out required fields";
            }
        } else {
            $errors[] = "You must agree to our terms";
        }
    } else {
        $errors[] = "Passwords do not match";
    }


    // IF LOGOUT BUTTON CLICKED
elseif( isset($_REQUEST["action"]) && $_REQUEST["action"] == "logout" ) :
    session_destroy();
    header("Location: http://" . $_SERVER["SERVER_NAME"]);
endif;


if( !empty($errors) ) {
    $query = http_build_query( array("errors" => $errors) );
    header("Location: " . strtok($_SERVER["HTTP_REFERER"], "?") . "?" . $query);
}

mysqli_close($conn);
?>