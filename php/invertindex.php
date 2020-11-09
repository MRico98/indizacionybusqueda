<?php
include 'bubblesort.php';

class InvertIndex{
    private $hashingindex;
    private $hashingfreq;

    function __construct(){
        $this->hashingindex = [];
        $this->hashingfreq = [];
    }

    function extractWords($fileidentifier,$filecontent){
        $palabras = explode(" ",$filecontent);
        $cantidadpalabras = count($palabras);
        $indexsize = count($this->hashingindex);
        for($i=$indexsize,$j=0;$i<$cantidadpalabras+$indexsize;$i++,$j++){
            $this->hashingindex[$i] = [$palabras[$j],$fileidentifier];
        }
    }

    function orderAlphabetically(){
        $ordenamiento = new BubbleSort($this->hashingindex,count($this->hashingindex));
        $this->hashingindex = $ordenamiento->sortingMethod();
    }

    function groupingByFreq(){
        for($i=0;$i<count($this->hashingindex);$i++){
            $this->hashingfreq[$this->hashingindex[$i][0]][$this->hashingindex[$i][1]] = 0;
        }
        for($i=0;$i<count($this->hashingindex);$i++){
            $this->hashingfreq[$this->hashingindex[$i][0]][$this->hashingindex[$i][1]] = $this->hashingfreq[$this->hashingindex[$i][0]][$this->hashingindex[$i][1]] + 1;
        }
    }

    function getHashingindex(){
        return $this->hashingindex;
    }

    function getHashingfreq(){
        return $this->hashingfreq;
    }
}

?>