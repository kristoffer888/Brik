<?php


namespace core;


use mysqli;
use mysqli_sql_exception;

class Database
{
    /**
     * @var mysqli
     */
    private static $m_database;

    public static function Init($host, $user, $password, $database)
    {
        if(Database::$m_database == null) {
            Database::$m_database = new mysqli($host, $user, $password, $database);

            if(Database::$m_database->connect_errno) {
                throw new mysqli_sql_exception("An Error Occured!!!");
            }
        }
    }

    public static function Dispose() {
        if(Database::$m_database != null) {
            Database::$m_database->close();
        }
    }

    public static function Instance() {
        return Database::$m_database;
    }
}