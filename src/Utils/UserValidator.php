<?php

declare(strict_types=1);

namespace App\Utils;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Contains a set of methods used to validate a set of user inputs in registration and login forms.
 * @author Bartosz Gościcki
 */
class UserValidator
{

    /**
     * An array of error messages displayed in the registration form.
     * @var array
     */
    public array $errors = [];


    /**
     * Ensures that the e-mail has a correct format (contains @ and domain).
     *
     * @param $email string
     * @return bool
     */
    public function validate_email($email): bool
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        $this->set_validation_errors(ValidationError::EMAIL);
        return false;
    }


    /**
     * Ensures that the phone number has a correct format (digits only, between 8 and 10 digits).
     *
     * @param $number string
     * @return bool
     */
    public function validate_phone($number): bool
    {
        if (preg_match("/^[0-9]{8,10}\$/", $number)) return false;
        $this->set_validation_errors(ValidationError::PHONE);
        return true;
    }


    /**
     * Ensures that the password input and password_confirm input contain the same values.
     *
     * @param $password_confirm string;
     * @param $password string
     * @return bool
     */
    public function validate_password($password, $password_confirm): bool
    {
        if ($password === $password_confirm) return true;
        $_SESSION['password_invalid'] = ValidationError::PASSWORD;
        return false;
    }


    /**
     * Ensures that all required fields are filled.
     *
     * @param $data array;
     * @return bool
     */
    public function validate_required($data): bool
    {
        foreach (array_keys($data) as $key) {
            if (empty($data[$key])) {
                $this->set_validation_errors(str_replace("_", " ", ucfirst($key)) .
                    ValidationError::REQUIRED);
            }
        }
        return isset($_SESSION[ValidationError::REQUIRED]);
    }


    /**
     * Sets the validation error in the $_SESSION super global.
     *
     * @param string $validation_error
     * @return void
     */
    private function set_validation_errors($validation_error) : void
    {
        $_SESSION[$validation_error] = $validation_error;
        $this->errors[$validation_error] = $validation_error;
    }

    /**
     * @param $user
     * @return void
     */
    public function validate_form($user): void
    {
        $this->validate_email($user['email']);
        $this->validate_phone($user['phone']);
        $this->validate_password($user['password'], $user['password_confirm']);
        $this->validate_required($user);
    }


}