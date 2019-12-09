<?php
require_once("header.php");

//if the action button is clicked and has value of add_item
// insert item into database

if(isset($_POST["action"]) && $_POST["action"] == "add_item"){
    $new_item = $_POST["input_item"];
    if($new_item != ""){
        $new_item_query = "INSERT INTO shopping_list (item) VALUES ('$new_item')";
        if(!mysqli_query($conn, $new_item_query)) {
            echo mysqli_error($conn);
        }
    } else {
        echo "Cannot be blank";
    }

} elseif(isset($_GET["action"]) && $_GET["action"] == "delete") {

    $item_id = $_GET["id"];
    $delete_query = "DELETE FROM shopping_list WHERE id = $item_id";
    if(mysqli_query($conn, $delete_query)){}

} elseif(isset($_POST["action"]) && $_POST["action"] == "update_item"){

    print_r($_POST);

    $item_id = $_POST["item_id"];
    $new_item_value = $_POST["input_item"];

    $update_query = "UPDATE shopping_list SET item = '$new_item_value' WHERE id = $item_id";
    mysqli_query($conn, $update_query);

}


?>

<div class="container">
    <div class="row">
        <div class="col-12"><h1>SSP Drill 2</h1></div>
        <div class="col-12">
        <p>
            Make a new table in your database called "shopping_list" with a column for "id" and "item"
        </p>
        <hr>

        <?php
        // select the shopping_list table and output the items
        $shopping_list_query = "SELECT * FROM shopping_list";
        if($results = mysqli_query($conn, $shopping_list_query)){
            echo "<ul>";
            while($shopping_list_row = mysqli_fetch_array($results) ){
                echo "<li>".$shopping_list_row["item"]. " 
                        <a href='?action=delete&id=".$shopping_list_row["id"]."'>x</a> 
                        <a href='?action=edit&id=".$shopping_list_row["id"]."'>edit</a>
                    </li>";
            }
            echo "</ul>";
        } else {
            echo mysqli_error($conn);
        }
        ?>
        <hr>
        <form action="drill2.php" method="post">
            <div class="input-group">
                <?php 
                // if action is edit
                // select the item from database
                // fill input field with item text
                // if action is not set, leave field blank
                $item_value = '';
                $button_value = 'add_item';
                $button_text = 'Add Item';
                if(isset($_GET["action"]) && $_GET["action"] == "edit"){
                    $item_id = $_GET["id"];
                    ?>

                    <input type="hidden" name="item_id" value="<?=$item_id?>">

                    <?php
                    $edit_query = "SELECT * FROM shopping_list WHERE id = $item_id";
                    if($edit_results = mysqli_query($conn, $edit_query)){
                        $button_value = "update_item";
                        $button_text = "Update Item";

                        while($item_row = mysqli_fetch_array($edit_results)){
                            $item_value = $item_row["item"];
                        }
                    }
                }
                ?>
                <input type="text" name="input_item" value="<?=$item_value?>" class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-primary" name="action" value="<?=$button_value?>"><?=$button_text?></button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>

<?php
require_once("footer.php");
?>