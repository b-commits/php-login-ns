<?php

namespace App\Utils;

require __DIR__ . '/../../vendor/autoload.php';

/**
 * Contains URLs to all defined views.
 */
abstract class Pages
{
    public const PROFILE = '../profile.php';
    public const LOGIN = '../login.php';
    public const REGISTER = '../register.php';
}