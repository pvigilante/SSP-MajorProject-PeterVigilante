<?php
require_once("header.php");
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1><?php 
            if(isset($_GET["search"])) {
                echo "Search Results for: ".$_GET["search"];
            } else {
                echo "Members";
            }
            ?></h1>
        </div>
        <hr>
        <?php
        $users_query = "SELECT users.id, users.first_name, users.last_name, images.url AS profile_pic
                        FROM users
                        LEFT JOIN images
                        ON users.profile_pic_id = images.id";
        $search = (isset($_GET["search"])) ? $_GET["search"] : false;

        if($search){
            // explode will seperate a string into an array
            $search_words = explode(" ", $search);

            // Loop through each word in our array
            for($i = 0; $i < count($search_words); $i++) {
                // Only append WHERE if $i is 0
                $users_query .= ($i > 0) ? " OR " : " WHERE ";
                $users_query .= "users.first_name LIKE '%".$search_words[$i]."%'";
                $users_query .= " OR users.last_name LIKE '%".$search_words[$i]."%'";
            }
        
        }

        echo $users_query;
        if($users_result = mysqli_query($conn, $users_query)) {
            while($user_row = mysqli_fetch_array($users_result)) {
                //print_r($user_row);
                ?>
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <img src="<?=$user_row["profile_pic"];?>" class="card-img-top">
                        <div class="card-header">
                            <h5>
                                <a href="/profile.php?user_id=<?=$user_row["id"];?>">
                                <?=$user_row["first_name"]." ".$user_row["last_name"]?>
                                </a>
                            </h5>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo mysqli_error($conn);
        }
        ?>

    </div>
</div>
<?php
require_once("footer.php");
?>