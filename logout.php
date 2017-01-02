<?php
session_start();


include 'confdb.php';
include 'functions.php';
session_destroy();
setcookie("user", "", time());

echo '<p class="success">Zostałeś wylogowany! Możesz przejść na <a href="index.php">stronę główną</a></p>';


?>


