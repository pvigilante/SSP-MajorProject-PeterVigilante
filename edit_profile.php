<?php
require_once("header.php");

$user_id = ( isset($_GET["user_id"]) ) ? $_GET["user_id"] : $_SESSION["user_id"];

$user_query = " SELECT users.*, images.url AS profile_pic 
                FROM users 
                LEFT JOIN images
                ON users.profile_pic_id = images.id
                WHERE users.id = " . $user_id;

if( $user_request = mysqli_query($conn, $user_query) ) :
    while ($user_row = mysqli_fetch_array($user_request)) :
        //print_r($user_row);
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Editing <?php echo $user_row["first_name"] . " " . $user_row["last_name"]; ?></h1>
            <form action="/actions/edit_user.php" method="post" enctype="multipart/form-data">
                <?php
                include_once($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
                ?>
                <input type="hidden" name="user_id" value="<?php echo $user_row["id"] ?>">

                <div class="form-row mb-2">
                    <div class="col-4">
                        <img src="<?=$user_row["profile_pic"];?>" class="w-100">
                    </div>
                    <div class="col-8">
                        <div class="form-group">
                            <label for="profile_pic">Profile Image</label>
                            <input type="file" name="profile_pic" id="profile_pic" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <input type="text" tabindex="1" name="first_name" placeholder="First Name" value="<?php echo $user_row["first_name"]; ?>" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" tabindex="2" name="last_name" placeholder="Last Name" value="<?php echo $user_row["last_name"]; ?>" class="form-control">
                    </div>
                </div>
                <div class="form-row mb-2">
                    <div class="col">
                        <input type="text" value="<?=$user_row["address"];?>" name="address" placeholder="Address" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" value="<?=$user_row["address2"];?>" name="address2" placeholder="Address Line 2" class="form-control">
                    </div>
                </div>
                <div class="form-row mb-2">
                    <div class="col">
                        <input type="text" value="<?=$user_row["city"];?>" name="city" placeholder="City" class="form-control">
                    </div>
                    <div class="col">
                        <input type="text" value="<?=$user_row["postal_code"];?>" name="postal_code" placeholder="Postal Code" class="form-control">
                    </div>
                </div>

                <div class="form-row mb-2">
                    <div class="col">
                        <select name="province_id" class="form-control">
                            <?php
                            $province_query = "SELECT * FROM provinces";
                            if($province_results = mysqli_query($conn, $province_query)) :
                                echo "<option disabled ";
                                if(!$user_row["province_id"]) echo "selected";
                                echo ">Province</option>";
                                while($province = mysqli_fetch_array($province_results)):
                                    ?>
                                    <option value="<?=$province["id"];?>" <?php 
                                        if($province["id"] == $user_row["province_id"]) echo " selected";
                                    ?>><?=$province["name"];?></option>
                                    <?php
                                endwhile;
                            else:
                                echo mysqli_error($conn);
                            endif;
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" value="<?=$user_row["email"];?>">
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <?php
                    if($_SESSION["user_id"] == $user_id || $_SESSION["role"] == 1):
                        ?>
                        <div class="col">
                            <a href="/reset_password.php">Change Password</a>
                        </div>
                        <div class="col text-right">
                            <button type="submit" name="action" value="delete" class="btn btn-text text-danger">Delete Account</a>
                            <button type="submit" tabindex="3" name="action" value="update" class="btn btn-primary">Update Account</button>
                        </div>
                        <?php
                    endif;
                    ?>
                </div>
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