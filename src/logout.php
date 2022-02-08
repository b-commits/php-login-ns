<?php

session_start();
unset($_SESSION);
session_destroy();
session_write_close();

require __DIR__ . '/../vendor/autoload.php';

include "partials/header.php"

?>

<div id="formWrapper">
    <h4>You have been logged out successfully.</h4>
    <a href="login.php">Back to login...</a>
</div>

