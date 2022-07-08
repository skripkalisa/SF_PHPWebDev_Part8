<?php

function open_sqlite_db()
{
    require_once 'credentials.php';

    try {
        if ($sqlite_db==null) {
            $sqlite_db = new PDO('sqlite:' . $sqlite_path, "", "", array(
                PDO::ATTR_PERSISTENT => true
            ));
        }
        return $sqlite_db;
    } catch (PDOException $e) {
        print "DB ERROR: ".$e->getMessage();
    }

}

function open_mySQL_db()
{
    require_once 'credentials.php';

    try {
        if ($mySQL==null) {
            $mySQL = new PDO("mysql:host=$host", $root, $root_password, array(
                PDO::ATTR_PERSISTENT => true
            ));
        }
        return $mySQL;
        $mySQL->exec("CREATE DATABASE `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;")
        or die(print_r($mySQL->errorInfo(), true));
    } catch (PDOException $e) {
        print "DB ERROR: ".$e->getMessage();
    }
}
