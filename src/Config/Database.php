<?php

declare(strict_types=1);

namespace App\Config;

require __DIR__ . '/../../vendor/autoload.php';

use PDO;
use PDOException;
use PDOStatement;

/**
 * Contains a set of methods used to connect to the database and run queries.
 * @author Bartosz Gościcki
 */
class Database
{

    /**
     * Server host name.
     * @var string
     */
    private string $host = 'localhost';

    /**
     * The port on which the database engine is running. MySQL runs at 3306 by default.
     * @var string
     */
    private string $port = '3306';

    /**
     * The name of the database schema.
     * @var string
     */
    private string $db_name = 'db_form';

    /**
     * Name of the user for which to make a connection.
     * @var string
     */
    private string $user = 'root';

    /**
     * Password of a user making the connection.
     * @var string
     */
    private string $pass = '';

    /**
     * Represents a connection to the database.
     * @var PDO
     */
    private PDO $connection;

    /**
     * @var PDOStatement
     */
    private PDOStatement $statement;


    /**
     * Initializes a connection to the database.
     *
     */
    public function __construct()
    {
        $connection_options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
        try {
            $this->connection = new PDO
            ($this->build_connection_string(), $this->user, $this->pass, $connection_options);
        } catch (PDOException $exception) {
            echo $exception;
        }
    }

    /**
     * Builds a connection string required to connect to a MySQL database.
     * @return string
     */
    private function build_connection_string() : string
    {
        return 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->db_name;
    }

    /**
     * Executes a query defined in the $statement object.
     * Call this method for DDL and DML commands.
     * @return bool
     */
    public function execute(): bool
    {
        return $this->statement->execute();
    }

    /**
     * Executes a query and returns an array of all records.
     * If there are no records to match the query, returns false.
     * @return array|false
     */
    public function get_all() : array
    {
        $this->execute();
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Prepares a PDOStatement object based on the query string and initializes $statement value.
     * The query can be executed by subsequently calling execute() on the $statement object.
     *
     * @param $query string
     * @return void
     */
    public function query(string $query) : void
    {
        $this->statement = $this->connection->prepare($query);
    }

    /**
     * Returns an object of a currently prepared statement.
     * @return PDOStatement
     */
    public function get_statement(): PDOStatement
    {
        return $this->statement;
    }

    /**
     * Executes a query and returns a single record.
     * If there is no record to match the query, returns false.
     * @return mixed
     */
    public function get_one()
    {
        $this->execute();
        return $this->statement->fetch();
    }



}
