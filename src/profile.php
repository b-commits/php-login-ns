<?php

session_start();

use App\Controllers\Users;
require __DIR__ . '/../vendor/autoload.php';
require "../vendor/autoload.php";

include_once "partials/header.php";


$controller = new Users();
$users = $controller->get_all_users();

if (isset($_POST['type']) && $_POST['type'] == 'search') {
    $users = $controller->search();
}

?>
<div id="formWrapper-profile">
    <?php if (!empty($_SESSION['current_user'])): ?>
        <h4 id="reg-header">Hello, <?= $_SESSION['current_user']['full_name'] ?>!
            <i href="#"
               data-bs-toggle="modal"
               data-bs-target="#exampleModal"
               data-id=<?= $_SESSION['current_user']['id'] ?>
               data-full_name=<?= $_SESSION['current_user']['full_name'] ?>
               data-email=<?= $_SESSION['current_user']['email'] ?>
               data-username=<?= $_SESSION['current_user']['username'] ?>
               data-phone=<?= $_SESSION['current_user']['phone'] ?>
               data-gender=<?= $_SESSION['current_user']['gender'] ?>
               style="cursor: pointer"
               class="fas fa-edit fa-xs">
            </i></h4>

        <div id="underline"></div>
        <form action="" method="POST">
            <input type="hidden" name="type" value="register">
            <div class="form-row">
                <div class="col">
                    <label for="full_name">Full name</label>
                    <p><?= $_SESSION['current_user']['full_name'] ?></p>
                </div>
                <div class="col">
                    <label for="username">Username</label>
                    <p><?= $_SESSION['current_user']['username'] ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="email">Email</label>
                    <p><?= $_SESSION['current_user']['email'] ?></p>
                </div>
                <div class="col">
                    <label for="phone">Phone Number</label>
                    <p><?= $_SESSION['current_user']['phone'] ?></p>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="full_name">Gender</label>
                    <p><?= $_SESSION['current_user']['gender'] ?></p>
                </div>
            </div>

            <h4 id="regHeader">Manage users</h4>
            <div id="underline"></div>
            <br/>
            <table class="table table-striped">

                <form>
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full Name
                            <input type="hidden" name="type" value="search"/>
                            <input id="name-search" name="fullname-search" type="text" placeholder="Search..."/>
                        </th>
                        <th scope="col">
                            Email
                            <input id="email-search" name="email-search" type="text" placeholder="Search..."/>
                        </th>
                        <th scope="col">Phone
                            <input id="phone-search" name="phone-search" type="text" placeholder="Search..."/>
                        </th>
                        <th scope="col">
                            Gender
                            <select id="gender-search" name="gender-search" class="form-select form-select-sm"
                                    aria-label="Default select example">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="a">Any</option>
                            </select>
                        </th>
                        <th scope="col">
                            <button type="submit" id="search" class="btn btn-primary btn-sm">Search</button>
                        </th>
                        <th scope="col">
                            <button type="submit" id="reset" class="btn btn-primary btn-sm">Reset</button>
                        </th>

                    </tr>
                    </thead>
                </form>

                <tbody id="data">
                <?php foreach ($users as $user) : ?>
                    <?php if ($user->id != $_SESSION['current_user']['id']) : ?>
                        <tr>
                            <td><?= $user->id ?></td>
                            <td><?= $user->full_name ?></td>
                            <td><?= $user->email ?></td>
                            <td><?= $user->phone ?></td>
                            <td><?= $user->gender ?></td>
                            <td>
                                <?php if ($_SESSION['current_user']['id'] == 1) : ?>
                                    <a href="#"
                                       data-bs-toggle="modal"
                                       data-bs-target="#exampleModal"
                                       data-id=<?= $user->id ?>
                                       data-full_name=<?= $user->full_name ?>
                                       data-email=<?= $user->email ?>
                                       data-username=<?= $user->username ?>
                                       data-phone=<?= $user->phone ?>
                                       data-gender=<?= $user->gender ?>
                                    >Edit</a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if ($_SESSION['current_user']['id'] == 1) : ?>
                                    <form action="Controllers/Users.php" method="POST">
                                        <input type="hidden" name="type" value="delete"/>
                                        <input type="hidden" name="id" value=<?= $user->id ?>>
                                        <button onclick="return confirm('Are you sure you want to delete this user?')"
                                                id="deleteButton" type="submit"><i class="fas fa-trash" id="trashIcon"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endif ; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="form-row">
                <button id="submitBtn" class="btn btn-primary">
                    <a href="logout.php">Log out</a>
                </button>
            </div>
        </form>

    <?php else: ?>

        <h4 id="regHeader">Personal details</h4>
        <div id="underline"></div>
        <form action="" method="POST">
            <input type="hidden" name="type" value="register">
            <div class="form-row">
                <div class="col">
                    <label for="full_name">Full name</label>
                    <p>Log in first</p>
                </div>
                <div class="col">
                    <label for="username">Username</label>
                    <p>Log in first</p>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="email">Email</label>
                    <p>Log in first</p>
                </div>
                <div class="col">
                    <label for="phone">Phone Number</label>
                    <p>Log in first</p>
                </div>
            </div>
            <label for="full_name">Gender</label>
            <p>Log in first</p>
            <div class="form-row">
                <button id="submitBtn" class="btn btn-primary">
                    <a href="login.php" style="width: 100%">Log in</a>
                </button>
            </div>
        </form>
    <?php endif ?>

    <script src="js/ajax_search.js"></script>

</div>

