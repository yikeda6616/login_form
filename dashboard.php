<?php
session_start();
include './User.php';

($is_valid_user = User::check()) ? true : header('location: ./index.php?error=true');

$title = 'dashboard';

include 'header.php';

?>

  <div class="container">
    <h1>Welcome to my page!</h1>
    <a href="action/logout.php">Logout</a>
  </div>

<?php

include 'footer.php';
