<?php
require_once("header.php");

$user_id = ( isset($_GET["user_id"]) ) ? $_GET["user_id"] : $_SESSION["user_id"];

$user_query = " SELECT users.*, provinces.name AS province_name, images.url AS profile_pic 
                FROM users 
                LEFT JOIN provinces
                ON users.province_id = provinces.id
                LEFT JOIN images
                ON users.profile_pic_id = images.id
                WHERE users.id = " . $user_id;

if( $user_request = mysqli_query($conn, $user_query) ) :
    while ($user_row = mysqli_fetch_array($user_request)) :
       // echo '<pre>';
       // print_r($user_row);
?>
<div class="container">
    <div class="row">
        <div class="col-4">
            <img src="<?php echo $user_row['profile_pic']; ?>" class="w-100">
        </div>
        <div class="col-8">
            <?php
            include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
            ?>
            <h1><?php echo $user_row["first_name"] . " " . $user_row["last_name"]; ?></h1>
            <p>
            <?=($user_row["address"])?$user_row["address"]."<br>":"";?>
            <?=($user_row["address2"] != "") ? $user_row["address2"].'<br>':'';?>
            <?=($user_row["city"])?$user_row["city"] . ", ":"";?>
            <?=($user_row["province_name"])?$user_row["province_name"]."<br>":"";?>
            <?=$user_row["postal_code"];?>
            </p>
            <p>
            <?=$user_row["email"];?>
            </p>
            <p>
                <?php
                echo date("l, F jS, Y @ g:i a", strtotime($user_row["date_created"]));
                ?>
            </p>
            <hr>
            <?php
            if($_SESSION["user_id"] == $user_id || $_SESSION["role"] == 1):
                ?>
                <div class="btn-group">
                    <a href="/edit_profile.php?user_id=<?=$user_row["id"];?>" class="btn btn-outline-primary">Edit Profile</a>
                </div>
                <?php
            endif;
            ?>
        </div>
    </div>
</div>
<?php
    endwhile;
else :  
    echo mysqli_error($conn);
endif;

require_once("footer.php");
?>