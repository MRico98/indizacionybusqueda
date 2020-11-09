<?php

class InvertIndex{
    private $hashingindex;

    function __construct(){
        $this->hashingindex = [];
    }

    function extractWords($fileidentifier,$filecontent){
        $palabras = explode(" ",$filecontent);
        $cantidadpalabras = count($palabras);
        $indexsize = count($this->hashingindex);
        for($i=$indexsize,$j=0;$i<$cantidadpalabras+$indexsize;$i++,$j++){
            $this->hashingindex[$i] = [$palabras[$j],$fileidentifier];
        }
    }

    function getHashingindex(){
        return $this->hashingindex;
    }
}

?>