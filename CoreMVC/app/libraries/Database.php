<?php

// PDO Database Class
// Connect to database
// Bind values
// Return rows and results
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASSWORD;
    private $dbname = DB_NAME;

    private $dbHandler;
    private $stmt;
    private $error;

    public function __construct()
    {
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        );
        // Create PDO instance
        try {
            //code...
            $this->dbHandler = new PDO($dsn, $this->user, $this->password, $options);
            // echo 'done';
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // prepare statement with query
    public function query($sql)
    {
        $this->stmt = $this->dbHandler->prepare($sql);
    }

    // bind values
    public function bind($param, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
    }

    // execute query
    public function execute()
    {
        return $this->stmt->execute();
    }

    // get all results as objects
    public function fetchAllResults()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // get somg;e recprd
    public function fetchSingleResult()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    // get row count
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
