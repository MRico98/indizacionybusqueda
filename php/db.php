<?php
class databaseConnection {
    private $servername;
    private $username;
    private $password;
    private $database;
    private $connection;

    function __construct($servername,$username,$password,$database){
        $connection = mysqli_connect($servername,$username,$password,$database);
    }

    function getConnection(){
        return $connection;
    }

    function closeConnection(){
        $connection->close();
    }

}
?>