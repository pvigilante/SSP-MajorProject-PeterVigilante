<?php
require_once("header.php");

//print_r($_SESSION);

?>

<div class="container">
    <div class="row">
        <div class="col-12"><h1>SSP Major Project</h1></div>
        <?php
        echo '<div class="col-12">';
       // echo "<div class='col-12'>";
       // echo "<div class=\"".$var."col-12\">";
        if(isset($_SESSION["user_id"])) :

            $user_query = "SELECT * FROM users WHERE id = " . $_SESSION["user_id"];
            if($user_request = mysqli_query($conn, $user_query)) :
                while($user_row = mysqli_fetch_array($user_request)) {
                    echo "<h2>Welcome Back ".$user_row["first_name"]." ".$user_row["last_name"]."</h2> ";
                    ?>
                    <hr>
                    <form action="/actions/login.php" method="post">
                        <button type="submit" name="action" value="logout" class="btn btn-warning">Logout</button>
                    </form>
                    <?php
                }
            endif;
        else :
        ?>
        <form action="/actions/login.php" method="post" class="col">
            <h2>Login</h2>
            <?php
            include($_SERVER["DOCUMENT_ROOT"] . "/includes/error_check.php");
            ?>
            <div class="form-group">
                <input type="email" name="email" placeholder="Email Address" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" class="form-control">
            </div>
            <div class="form-group">
                <p>
                    <button type="submit" name="action" value="login" class="btn btn-primary">Login</button>
                </p>
                <p>
                    <a href="/signup.php">Create Account?</a>
                </p>
            </div>
        </form>
        <?php
        endif;
        echo '</div>';
        ?>

    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function(){


    //$("body").css("background", "red");


});

</script>
<?php
require_once("footer.php");
?>