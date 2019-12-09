<?php
require_once("header.php");




?>

<div class="container">
    <div class="row">
        <div class="col-12"><h1>SSP Drill 3</h1></div>
        <div class="col-12">
            <p>
                Make a loop that for every 3rd interval echo Ping, and every 7th interval echo Pong.<br>
                If the interval is divisible by both 3 & 7 echo PingPong

            </p>
            <hr>
            <p style="line-height:1; font-size:12px; columns:4;">
            <?php 

            for( $i = 1; $i <= 100; $i++ ){
                $color = 0;
                $output = $i . ":";
                if($i % 3 == 0) {
                    $color += 1;
                    $output .= " Ping";
                }
                if($i % 7 == 0) {
                    $color += 2;
                    $output .= " Pong";
                }
                $output .= "<br>";

                $append = "";
                switch($color) {
                    case 1:
                        $append = "<span class='text-danger'>";
                    break;
                    case 2:
                        $append = "<span class='text-warning'>";
                    break;
                    case 3:
                        $append = "<span class='text-success'>";
                    break;
                    default:
                        $append = "<span>";
                    break;
                }

                echo $append . $output . "</span>";
            }




            ?>
            </p>


            <hr>

            <?php
            $cars = ["Ford", "Toyota", "Tesla", "Audi"];

            foreach( $cars as $car ){
                echo $car . "<br>";

                switch ($car) {
                    case "Ford":
                        echo "Acc: 0-60 8s";
                    break;
                    case "Tesla":
                        echo "Acc: 0-60 1.4s";
                    break;
                    case "Audi":
                        echo "Acc: 0-60 4.2s";
                    break;
                    default:
                        echo "Unknown";
                    break;
                }

                echo "<hr>";
            }

            ?>

            
        </div>
        </div>
    </div>
</div>

<?php
require_once("footer.php");
?>