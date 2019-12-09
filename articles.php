<?php
require_once("header.php");
?>
<div class="container">
    <div class="row">
        <?php
        if(isset($_GET["id"])){

            $article_query = "  SELECT articles.*, 
                                       users.first_name, users.last_name,
                                       images.url AS featured_image
                                FROM articles
                                LEFT JOIN users
                                ON articles.author_id = users.id
                                LEFT JOIN images
                                ON articles.image_id = images.id
                                WHERE articles.id = " . $_GET["id"];
            if($article_result = mysqli_query($conn, $article_query)) {
                while($article_row = mysqli_fetch_array($article_result)) {
                    //echo "<pre>";print_r($article_row);
                    ?>
                    <div class="col-12">
                        <h1><?=$article_row["title"]?></h1>
                        <p class="text-muted">Published on <?=date("M jS, Y @ hA", strtotime($article_row["date_created"]))?> by <?=$article_row["first_name"]." ".$article_row["last_name"]?></p>
                    </div>
                    <figure class="col-4">
                            <img src="<?=$article_row["featured_image"]?>" class="w-100">
                    </figure>
                    <div class="col-8">
                        <?php 
                        echo $article_row["content"];
                        ?>
                    </div>
                    <?php
                    // If logged in and the post is yours or you are super admin
                    // show edit menu
                    if( isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $article_row["author_id"]){
                        echo "<hr>";
                        echo "<div class='col-12'>";
                            echo "<a href='edit_post.php?article_id=".$article_row["id"]."' class='btn btn-primary'>Edit Article</a>";
                        echo "</div>";
                    }

                }
            } else {
                echo mysqli_error($conn);
            }
        
        } else {
            // ELSE if no ID set, show ALL articles
            // if query include search
            $search_query = (isset($_GET["search"])) ? $_GET["search"] : false;

            if($search_query) {
                echo "<div class='col-12'><h1>Search Results for: $search_query</h1></div>";
            } else {
                echo "<div class='col-12'><h1>Articles</h1></div>";
            }
            
            // Output all Articles
            
            $article_query = "SELECT articles.title, images.url AS featured_image, articles.author_id, 
                                     users.first_name, users.last_name, articles.date_created, articles.id
                              FROM articles
                              LEFT JOIN images
                              ON articles.image_id = images.id
                              LEFT JOIN users
                              ON articles.author_id = users.id";
                              
            if($search_query) {
                $article_query .= " WHERE articles.title LIKE '%$search_query%' 
                                 OR articles.content LIKE '%$search_query%'";
            }

            $article_query .= " ORDER BY articles.date_created DESC";



            if($article_result = mysqli_query($conn, $article_query)) {
                while($article_row = mysqli_fetch_array($article_result)){
                    ?>
                    <div class="card col-12 mb-3">
                        <div class="row no-gutters">
                            <div class="col-sm-3">
                                <div class="square-img">
                                    <img src="<?=$article_row["featured_image"]?>" class="card-img">
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="/articles.php?id=<?=$article_row["id"]?>"><?=$article_row["title"]?></a>
                                    </h5>
                                    <small class="text-muted"><?="By ".$article_row["first_name"]." ".$article_row["last_name"]." on ".date("M jS, Y @ hA", strtotime($article_row["date_created"]))?></small>
                                    <p>
                                        <a href="/articles.php?id=<?=$article_row["id"]?>">Read More</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo mysqli_error($conn);
            }

        }
        ?>
    </div>
</div>

<?php
require_once("footer.php");
?>