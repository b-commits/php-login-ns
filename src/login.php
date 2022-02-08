<?php

session_start();

include "partials/header.php";

require __DIR__ . '/../vendor/autoload.php';

?>

<div id="formWrapper">
    <ul class="nav nav-tabs" id="tabNav">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" href="register.php">Registration</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="login.php">Login</a>
        </li>
    </ul>

    <?php if (isset($_SESSION['validation_successful'])) : ?>
        <?php unset($_SESSION['validation_successful']); ?>
        <div id="successful" class="alert alert-success" role="alert">
            You have been successfully registered!
        </div>
    <?php endif; ?>
    <h4 id="regHeader">Login</h4>
    <div id="underline"></div>
    <form action="Controllers/Users.php" method="POST">
        <input type="hidden" name="type" value="login">
        <div class="form-row">
            <div class="col">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" class="form-control" placeholder="Username"">
            </div>
            <div class="col">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" class="form-control" placeholder="Password"/>
            </div>
        </div>

        <button id="submitBtn" style="width: 97%" type="submit" class="btn btn-primary">Log in</button>
</div>

