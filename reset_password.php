<?php
require_once("header.php");

$user_id = ( isset($_GET["user_id"]) ) ? $_GET["user_id"] : $_SESSION["user_id"];

$user_query = "SELECT * FROM users WHERE id = " . $user_id;

if( $user_request = mysqli_query($conn, $user_query) ) :
    while ($user_row = mysqli_fetch_array($user_request)) :
        //print_r($user_row);
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Change <?php echo $user_row["first_name"] . " " . $user_row["last_name"]; ?>'s Password</h1>
            <form action="/actions/edit_user.php" method="post">
                <?php
                include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
                ?>
                <input type="hidden" name="user_id" value="<?php echo $user_row["id"] ?>">
                <div class="form-row mb-2">
                    <div class="col">
                        <input type="password" name="password" placeholder="Current Password" class="form-control">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <input type="password" name="new_password" placeholder="New Password" class="form-control">
                    </div>
                    <div class="col">
                        <input type="password" name="new_password2" placeholder="Confirm New Password" class="form-control">
                    </div>
                </div>
                <hr>
                <?php
                if($_SESSION["user_id"] == $user_id || $_SESSION["role"] == 1):
                    ?>
                    <div class="text-right">
                        <a onclick="history.go(-1);" href="#" class="text-link">Cancel</a>
                        <button type="submit" tabindex="3" name="action" value="change_password" class="btn btn-primary">Update Password</button>
                    </div>
                    <?php
                endif;
                ?>
            </form>
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