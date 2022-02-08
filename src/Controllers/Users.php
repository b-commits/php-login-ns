<?php

declare(strict_types=1);

namespace App\Controllers;

require __DIR__ . '/../../vendor/autoload.php';

use App\Models\User;
use App\Utils\Pages;
use App\Utils\UserValidator;


/**
 * User controller class that handles the user input and passes it down to the User.php model.
 * @author Bartosz Gościcki
 */
class Users
{

    /**
     * User model for which to call SQL queries.
     *
     * @var User
     */
    private User $user;

    /**
     * User validation object that checks whether user input matches the predefined criteria.
     *
     * @var UserValidator
     */
    private UserValidator $validator;


    public function __construct()
    {
        $this->user = new User();
        $this->validator = new UserValidator();
    }

    /**
     * Fetches all registered users.
     *
     * @return array
     */
    public function get_all_users(): array
    {
        return $this->user->get_all_users();
    }

    /**
     * Updates the data of a selected user.
     *
     * @return void
     */
    public function edit(): void
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $details = [
            'id' => $_POST['id'],
            'full_name' => $_POST['full_name'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'gender' => $_POST['gender'],
            'phone' => $_POST['phone'],
        ];
        $this->update_session();
        $this->user->update($details);
        $_SESSION['update_successful'] = true;
        $this->redirect(Pages::PROFILE);
    }

    /**
     * Fetches all users that meet the LIKE '% %' criteria.
     *
     * @return array
     */
    public function search(): array
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $filters = [
            'full_name' => $_POST['fullname-search'],
            'email' => $_POST['email-search'],
            'phone' => $_POST['phone-search'],
            'gender' => $_POST['gender-search'],
        ];
        return $this->user->search($filters);
    }

    /**
     * Deletes a user from the grid.
     *
     * @return void
     */
    public function delete(): void
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $id = $_POST['id'];
        $this->user->delete($id);
        $this->redirect(Pages::PROFILE);
    }

    /**
     * Sanitizes user login form input.
     *
     * @return void
     */
    public function login(): void
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $user = [
            'username' => $_POST['username'],
            'password' => $_POST['password']
        ];
        $current_user = $this->user->login($user);
        $_SESSION['current_user'] = $current_user;
        $this->redirect(Pages::PROFILE);
    }

    /**
     * Sanitizes user registration form input and passes the data to the FormValidator.
     *
     * @return void
     */
    public function register(): void
    {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $user = [
            'email' => $_POST['email'],
            'full_name' => $_POST['full_name'],
            'gender' => $_POST['gender'],
            'password' => $_POST['password'],
            'password_confirm' => $_POST['password_confirm'],
            'phone' => $_POST['phone'],
            'username' => $_POST['username']
        ];
        $this->validator->validate_form($user);
        empty($this->validator->errors) ? $this->handle_success($user) : $this->handle_failure();
    }

    /**
     * Redirects the user to the login page and sets the $_SESSION['validation_successful']
     * for conditional rendering of a successful registration flash message.
     *
     * @param $user
     * @return void
     */
    private function handle_success($user): void
    {
        $this->user->register($user);
        $_SESSION['validation_successful'] = true;
        $this->redirect(Pages::LOGIN);
    }

    /**
     * Redirects the user back to the registration page and sets the $_SESSION['validation_failed']
     * for conditional rendering of bad user input flash messages.
     *
     * @return void
     */
    private function handle_failure(): void
    {
        $_SESSION['validation_failed'] = true;
        $this->redirect(Pages::REGISTER);
    }

    /**
     * Redirects the user the provided URL.
     *
     * @param $url
     * @return void
     */
    private function redirect($url): void
    {
        if (!headers_sent()) header("Location: " . $url);
    }

    /**
     * Manually updates the user information in the session.
     * Used for whenever a user updates his own details.
     *
     * @return void
     */
    private function update_session(): void
    {
        if ($_SESSION['current_user']['id'] == $_POST['id']) {
            $_SESSION['current_user']['full_name'] = $_POST['full_name'];
            $_SESSION['current_user']['username'] = $_POST['username'];
            $_SESSION['current_user']['email'] = $_POST['email'];
            $_SESSION['current_user']['phone'] = $_POST['phone'];
            $_SESSION['current_user']['gender'] = $_POST['gender'];
        }
    }


    /**
     *  Utils function to be handled by AJAX.
     */
    public function search_ajax()
    {
        $filters = [
            'full_name' => $_GET['full_name'],
            'email' => $_GET['email'],
            'phone' => $_GET['phone'],
            'gender' => $_GET['gender'],
        ];
        return  var_dump(json_encode($this->user->search($filters), JSON_HEX_APOS));
    }

}

$user_controller = new Users();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION)) {
        session_start();
    }
    if ($_POST['type'] == 'register') {
        $user_controller->register();
    }

    if ($_POST['type'] == 'login') {
        $user_controller->login();
    }

    if ($_POST['type'] == 'delete') {
        $user_controller->delete();
    }

    if ($_POST['type'] == 'edit') {
        $user_controller->edit();
    }

    if ($_POST['type'] == 'search') {
        $user_controller->search();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['full_name'])) {
    $user_controller->search_ajax();
}
