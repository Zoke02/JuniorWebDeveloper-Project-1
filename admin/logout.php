<?php 
session_start();
// I think this also clears cookies (Vernichtet die Session samt Cookies).
session_destroy();
include "functions.php";
include "head.php";
?>
<main class="logout">
    <h2>You are logged out.</h2>
    <a class="logout__link" href="index.php">Back to Homepage</a>
</main>
<?php
include "footer.php"
?>