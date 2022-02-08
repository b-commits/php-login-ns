<?php

/** @noinspection SqlNoDataSourceInspection */
/** @noinspection SqlResolve */

namespace App\Models;

abstract class QueryProvider
{
    const GET_BY_USERNAME = 'SELECT * FROM users WHERE username = :username';

    const GET_ALL_USERS = 'SELECT * FROM users';

    const DELETE_BY_ID = 'DELETE FROM users WHERE id = :id';

    const INSERT_USER = 'INSERT INTO users (email, full_name, gender, password, phone, username) 
        VALUES (:email, :full_name, :gender, :password, :phone, :username)';

    const UPDATE_USER = 'UPDATE users SET full_name = :full_name, username = :username, 
                 
                 phone = :phone, email = :email, gender = :gender WHERE id = :id';

    const SEARCH_USER = "SELECT * FROM users 
                         WHERE full_name LIKE CONCAT('%', :full_name, '%')
                         AND phone LIKE CONCAT('%', :phone, '%')
                         AND email LIKE CONCAT('%', :email, '%')
                         AND gender LIKE CONCAT('%', :gender, '%')";
}