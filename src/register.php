<?php

include_once "partials/header.php";

require __DIR__ . '/../vendor/autoload.php';
use App\Utils\ValidationError;

session_start();

if (!empty($_SESSION['validation_failed'])) {
    session_destroy();
}

?>

<div id="formWrapper">
    <ul class="nav nav-tabs" id="tabNav">
        <li class="nav-item active">
            <a class="nav-link active" aria-current="page" href="register.php">Registration</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
        </li>
    </ul>
    <h4 id="regHeader">Registration</h4>
    <div id="underline"></div>
    <form action="Controllers/Users.php" method="POST">
        <input type="hidden" name="type" value="register">
        <div class="form-row">
            <div class="col">
                <label for="full_name">Full name</label>
                <input id="full_name" name="full_name" type="text" class="form-control" placeholder="Enter your name">
                <p id="error"><?= $_SESSION[ValidationError::REQUIRED_FULL_NAME] ?? '' ?></p>
            </div>
            <div class="col">
                <label for="username">Username</label>
                <input id="username" name="username" type="text" class="form-control" placeholder="Enter your username">
                <p id="error"><?= $_SESSION[ValidationError::REQUIRED_USERNAME] ?? '' ?></p>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="email">Email</label>
                <input id="email" name="email" type="text" class="form-control" placeholder="Enter your email">
                <p id="error"><?= $_SESSION[ValidationError::REQUIRED_EMAIL] ?? '' ?></p>
                <p id="error"><?= $_SESSION[ValidationError::EMAIL] ?? '' ?></p>
            </div>
            <div class="col">
                <label for="phone">Phone Number</label>
                <input id="phone" name="phone" type="text" class="form-control" placeholder="Enter your number">
                <p id="error"><?= $_SESSION[ValidationError::REQUIRED_PHONE] ?? '' ?></p>
                <p id="error"><?= $_SESSION[ValidationError::PHONE] ?? '' ?></p>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label for="password">Password</label>
                <input id="password" name="password" type="password" class="form-control"
                       placeholder="Enter your password">
                <p id="error"><?= $_SESSION[ValidationError::REQUIRED_PASSWORD] ?? '' ?></p>
                <p id="error"><?= $_SESSION[ValidationError::PASSWORD] ?? '' ?></p>
            </div>
            <div class="col">
                <label for="password_confirm">Confirm Password</label>
                <input id="password_confirm" name="password_confirm" type="password" class="form-control"
                       placeholder="Confirm your password">
            </div>
        </div>
        <label id="genderLbl">Gender</label>
        <div class="radioSelects">
            <div class="form-row">
                <div class="form-check">
                    <input class="radio" type="radio" name="gender" id="male" value="male" checked>
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                </div>
                <div class="form-check">
                    <input class="radio" type="radio" name="gender" id="female" value="female">
                    <label class="form-check-label" for="female">
                        Female
                    </label>
                </div>
                <div class="form-check">
                    <input class="radio" type="radio" name="gender" id="undefined">
                    <label class="form-check-label" for="undefined">
                        Prefer not to say
                    </label>
                </div>
            </div>
        </div>
        <div class="form-row">
            <button id="submitBtn" type="submit" class="btn btn-primary">Register</button>
        </div>
    </form>
</div>