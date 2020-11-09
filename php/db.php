<?php
class DatabaseConnection {
    private $connection;

    function __construct($servername,$username,$password,$database){
        $this->connection = mysqli_connect("localhost","root","Admin123","indiceinvertido");
    }

    function getConnection(){
        return $this->connection;
    }

    function closeConnection(){
        $this->connection->close();
    }

}
?>