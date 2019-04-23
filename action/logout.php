<?php

session_start();

$_SESSION['user_id'] = 0;

header('location: ../index.php');
