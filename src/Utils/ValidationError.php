<?php

namespace App\Utils;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Contains error messages that are displayed to the end user on various forms across the site.
 */
abstract class ValidationError
{
    public const PASSWORD = 'Passwords must match!';
    public const EMAIL = 'E-mail is not valid';
    public const REQUIRED = ' is required';
    public const PHONE = 'Number must be between 8-10 characters long';
    public const REQUIRED_PASSWORD = 'Password' . self::REQUIRED;
    public const REQUIRED_PHONE = 'Phone' . self::REQUIRED;
    public const REQUIRED_EMAIL = 'Email' . self::REQUIRED;
    public const REQUIRED_USERNAME = 'Username' . self::REQUIRED;
    public const REQUIRED_FULL_NAME = 'Full name' . self::REQUIRED;
}