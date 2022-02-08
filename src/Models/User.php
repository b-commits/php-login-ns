<?php

declare(strict_types=1);

namespace App\Models;

use App\Config\Database;

require __DIR__ . '/../../vendor/autoload.php';


/**
 * User model that handles the connection with database and running the queries.
 * @author Bartosz Gościcki
 */
class User
{

    private Database $db;


    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * Fetches the array of all users from the database.
     *
     * @return array
     */
    public function get_all_users(): array
    {
        $this->db->query(QueryProvider::GET_ALL_USERS);
        return $this->db->get_all();
    }

    /**
     * @param $data
     * @return mixed|null
     */
    public function login($data)
    {
        $this->db->query(QueryProvider::GET_BY_USERNAME);
        $this->db->get_statement()->bindValue(':username', $data['username']);
        $user = $this->db->get_one();
        return $this->password_match($data['password'], $user['password']) ? $user : null;
    }

    /**
     * @param $filters
     * @return array
     */
    public function search($filters): array
    {
        $this->db->query(QueryProvider::SEARCH_USER);
        foreach (array_keys($filters) as $key) {
            if (in_array($key, array('email', 'full_name', 'gender', 'password', 'phone'))) {
                $this->db->get_statement()->bindValue(':' . $key, $filters[$key]);
            }
        }
        return $this->db->get_all();
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): bool
    {
        $this->db->query(QueryProvider::DELETE_BY_ID);
        $this->db->get_statement()->bindValue(':id', $id);
        return $this->db->execute();
    }

    /**
     * @param $input
     * @param $db_password
     * @return bool
     */
    public function password_match($input, $db_password): bool
    {
        return $input == $db_password;
    }

    /**
     * @param $data
     * @return bool
     */
    public function register($data): bool
    {
        $this->db->query(QueryProvider::INSERT_USER);
        foreach (array_keys($data) as $key) {
            if (in_array($key, array('email', 'full_name', 'gender', 'password', 'phone', 'username'))) {
                $this->db->get_statement()->bindValue(':' . $key, $data[$key]);
            }
        }
        return $this->db->execute();
    }

    /**
     * @param $details
     * @return bool
     */
    public function update($details): bool
    {
        $this->db->query(QueryProvider::UPDATE_USER);
        foreach (array_keys($details) as $key) {
            if (in_array($key, array('email', 'full_name', 'gender', 'id', 'phone', 'username'))) {
                $this->db->get_statement()->bindValue(':' . $key, $details[$key]);
            }
        }
        return $this->db->execute();
    }

}