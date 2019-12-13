<?php
require_once("header.php");

if(isset($_REQUEST["action"]) && $_REQUEST["action"] == "add_cool_tag"){
    // tag_id, article_id
    $tag_id = $_REQUEST["tag_id"];
    $article_id = $_REQUEST["article_id"];
    $add_cool_tag_query = "INSERT INTO articles_tags (tag_id, article_id) VALUES ($tag_id, $article_id)";
    if(mysqli_query($conn, $add_cool_tag_query)){
        // It worked
    }
}
?>

<div class="container">
    <div class="row">
        <div class="col-12"><h1>SSP Drill 4</h1></div>
        <div class="col-12">
            <label for="star_1"> 1 </label>
            <label for="star_2"> 2 </label>
            <label for="star_3"> 3 </label>
            <label for="star_4">4</label>
            
            

        </div>

        <div class="col-12">
            <p>
                Make a new table in your database called "tags" with a column for "id" and "tag".<br>
                You should be able to add new tags to this table.<br>
                Bonus: Ability to Edit And Remove existing tags
            </p>
            <p>
                Make a new table in your database to create a many-to-many relationship between your articles and tags, can be called "article_tags".<br>
                Loop all your existing articles and include a form in each with a dropdown of all existing tags.<br>
                Form should add the tag to the many-to-many table, relating the tag to the article.<br>
                Output all tags related to the article.<br>
                Bonus: Ability to Remove the tag from the article
            </p>
            <hr>
        </div>
        <div class="col-md-8 card p-4">
            <h2>Articles</h2>

            <?php
       
            $articles_query = "SELECT * FROM articles";
            if($articles_results = mysqli_query($conn, $articles_query)){
                while($article_row = mysqli_fetch_array($articles_results)){
                    echo "<h3>";
                    echo $article_row["title"];
                    echo "</h3>";

                    echo "<p><strong>Tags: </strong>";
                    $cool_tag_query = " SELECT articles_tags.*, tags.tag
                                        FROM articles_tags
                                        LEFT JOIN tags
                                        ON articles_tags.tag_id = tags.id
                                        WHERE articles_tags.article_id = " .$article_row["id"];
                    if($cool_tag_results = mysqli_query($conn, $cool_tag_query)){
                        $comma = "";
                        while($cool_tag_row = mysqli_fetch_array($cool_tag_results)){
                            echo $comma . $cool_tag_row["tag"];
                            $comma = ", ";
                        }
                    }

                    echo "</p>";

                    ?>

                    <form action="drill4.php" class="input-group">
                        <input type="hidden" name="article_id" value="<?=$article_row["id"]?>">
                        <select name="tag_id" class="form-control">
                            <?php
                            $tags_query = "SELECT * FROM tags";
                            if($tags_results = mysqli_query($conn, $tags_query)){
                                while($tag_option = mysqli_fetch_array($tags_results)) {
                                    echo "<option value='".$tag_option["id"]."'>".$tag_option["tag"]."</option>";
                                }
                            }
                            ?>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" name="action" value="add_cool_tag" class="btn btn-primary">Add Tag</button>
                        </div>
                    </form>
                    <?php
                    echo "<hr>";
                } // end of $article_row while
            } // end of $articles_results if
            ?>
        </div>
        <div class="col-md-4 card p-4">
            <h3>Tags</h3>
            <?php
            $tags_query = "SELECT * FROM tags";
            if($tags_results = mysqli_query($conn, $tags_query)){
                echo "<ul>";
                while($tag_row = mysqli_fetch_array($tags_results)){
                    echo "<li>";
                    echo $tag_row["tag"];
                    echo "</li>";
                }
                echo "</ul>";
            }
            ?>
        </div>
    </div>
</div>

<?php
require_once("footer.php");
?>