<?php
require_once("header.php");

?>

<div class="container">
    <div class="row">
        <div class="col-12"><h1>SSP Drill 1</h1></div>
        <?php 
        $user_query = "  SELECT users.first_name, users.last_name, users.date_created, provinces.name AS province_name
                    FROM users
                    LEFT JOIN provinces
                    ON users.province_id = provinces.id";

        if($result = mysqli_query($conn, $user_query)):
            echo "<ul>";
            while($row = mysqli_fetch_array($result)):
                echo "<li>";
                echo $row["first_name"]." ".$row["last_name"]." lives in ".$row["province_name"]. " and started ";
                echo date("l \o\\f F \i\\n Y", strtotime($row["date_created"]));
                echo "</li>";
            endwhile;
            echo "</ul>";
        else:
            echo mysqli_error($conn);
        endif;

        ?>
    </div>
</div>

<?php
require_once("footer.php");
?>