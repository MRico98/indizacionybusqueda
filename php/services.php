<?php
include 'db.php';

class Services{
    private $dbconnection;

    function __construct(){
        $configuration = $this->readDatabaseFile();
        $this->dbconnection = new DatabaseConnection($configuration["server"],$configuration["username"],$configuration["password"],$configuration["database"]);
    }

    public function setInvertIndexDb($invertindex,$files){
        $this->setWords(array_keys($invertindex));
        $this->setDocuments($files);
        $this->setInvertIndexTable($invertindex);
    }

    public function createSearchQueryLike($searchparameter){
        return $this->dbconnection->queryOperation("SELECT indiceinvertido.indice,indiceinvertido.docid,documentos.resumen,indiceinvertido.count FROM diccionario INNER JOIN documentos INNER JOIN indiceinvertido ON indiceinvertido.indice = diccionario.indice AND documentos.docid = indiceinvertido.docid WHERE indiceinvertido.indice LIKE '%".$searchparameter."%';");
    }

    public function createSearchQuery($searchparameter){
        return $this->dbconnection->queryOperation("SELECT indiceinvertido.indice,indiceinvertido.docid,documentos.resumen,indiceinvertido.count FROM diccionario INNER JOIN documentos INNER JOIN indiceinvertido ON indiceinvertido.indice = diccionario.indice AND documentos.docid = indiceinvertido.docid WHERE indiceinvertido.indice = '".$searchparameter."';");
    }

    public function closeConnection(){
        $this->dbconnection->closeConnection();
    }

    private function setWords($words){
        $numwords = count($words);
        for($i=0;$i<$numwords;$i++){
            $this->dbconnection->queryOperation("insert into diccionario(indice) Select '".$words[$i]."' Where not exists(select * from diccionario where indice='".$words[$i]."');");
        }
    }

    private function setDocuments($documents){
        $numdocuments = count($documents);
        for($i=0;$i<$numdocuments;$i++){
            $this->dbconnection->queryOperation("insert into documentos(docid,resumen,rutatext) values ('".$documents[$i]->getNamefile()."','".$documents[$i]->getContentfile()."','".$documents[$i]->getNamefile()."')");
        }
    }

    private function setInvertIndexTable($invertindex){
        print_r($invertindex);
        foreach($invertindex as $word=>$freq){
            echo $word."<br>";
            print_r($freq);
            echo "<br>";
            foreach($freq as $docid=>$numfrequ){
                $this->dbconnection->queryOperation("insert into indiceinvertido(indice,docid,count) values('".$word."','".$docid."','".$numfrequ."')");
            }
        }
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