<?php


namespace core;


use mysqli;
use mysqli_sql_exception;

class Database
{
    /**
     * @var mysqli
     */
    private $m_database;

    function __construct($host, $user, $password, $database)
    {
        if($this->m_database == null) {
            $this->m_database = new mysqli($host, $user, $password, $database);

            if($this->m_database->connect_errno) {
                throw new mysqli_sql_exception("An Error Occured!!!");
            }

            $this->m_database->set_charset("utf8mb4");
        }
    }

    function __destruct() {
        if($this->m_database != null) {
            $this->m_database->close();
        }
    }

    public function get() {
        return $this->m_database;
    }
}