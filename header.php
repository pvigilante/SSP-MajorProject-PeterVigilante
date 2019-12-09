<?php
require_once("conn.php");
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/styles.css">

    <title>Hello, world!</title>
  </head>
  <body>

<nav class="navbar navbar-expand navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">SSP3210</a>

    <!-- SEARCH BAR -->
    <form action="/articles.php" class="form-inline input-group my-2 my-lg-0 w-50">
        <input class="form-control" type="search" name="search" placeholder="Search" aria-label="Search" value="<?php echo (isset($_GET["search"])) ? $_GET["search"] : ""; ?>">
        <div class="input-group-append">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </div>
    </form>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse my-2" id="navbarSupportedContent">
      <ul class="navbar-nav mr-0 ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>">Home</a>
        </li>
        <?php 
        if(isset($_SESSION["user_id"])) : // Check if user is logged in
        ?>
        <li class="nav-item">
            <a href="/members.php" class="nav-link">Members</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Account
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/profile.php">My Profile</a>
            <a class="dropdown-item" href="/add_post.php">Add Article</a>
            <a class="dropdown-item" href="/articles.php">My Articles</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="/actions/login.php?action=logout">Logout</a>
          </div>
        </li>
        <?php
        else: // if user is not logged in
            ?>
            <li class="nav-item">
              <a class="nav-link" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/signup.php">Sign-Up</a>
            </li>
            <?php
        endif;
        ?>
      </ul>
      
    </div>
  </div>
</nav>

<?php 


?>
