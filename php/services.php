<?php
include 'db.php';

class Services{
    private $dbconnection;

    function __construct(){
        $configuration = $this->readDatabaseFile();
        print_r($configuration);
        $dbconnection = new DatabaseConnection($configuration["server"],$configuration["username"],$configuration["password"],$configuration["database"]);
        
    }

    private function readDatabaseFile(){
        $configuration = file_get_contents("../resource/dbconfig");
        $configuration = explode(",",$configuration);
        $connection = [];
        for($i=0;$i<count($configuration);$i++){
            $connection[explode(":",$configuration[$i])[0]] = explode(":",$configuration[$i])[1];
        }
        return $connection;
    }
}
?>