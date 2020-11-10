<?php
include 'services.php';
include 'docs.php';
include 'indexitem.php';

class QueryForm{
    private $logicoperators;
    private $verbs;
    private $coincidencematrix;
    private $service;

    function __construct($query){
        $this->service = new Services();
        $words = explode(" ",$query);
        $numwords = count($words);
        $this->setLogicoperators($words,$numwords);
        $this->setVerbs($words,$numwords);
    }

    public function getLogicoperators(){
        return $this->logicoperators;
    }

    public function getVerbs(){
        return $this->verbs;
    }

    public function getAllVerbsCoincidence(){
        $this->coincidencematrix = [];
        $auxmatrix = [];
        $numverbs = count($this->verbs);
        for($i=0;$i<$numverbs;$i++){
            if(substr($this->verbs[$i],0,6) === 'PATRON'){
                continue;
            }
            $auxmatrix[$i] = $this->service->createSearchQuery($this->verbs[$i]);
            $this->coincidencematrix[$i] = new IndexItem($this->verbs[$i],$auxmatrix[$i]->num_rows,0,null);
            $docsid = [];
            $totalfreq = 0;
            $contador=0;
            while($row = $auxmatrix[$i]->fetch_assoc()){
                $totalfreq = $totalfreq + $row['count'];
                $docitem = new Docs($row['docid'],$row['count'],$row['docid'],$row['resumen']);
                $docsid[$contador] = $docitem;
                $contador++;
            }
            $this->coincidencematrix[$i]->setDocids($docsid);
            $this->coincidencematrix[$i]->setTotalfrecuen($totalfreq);
        }
        for($i=0;$i<count($this->coincidencematrix);$i++){
            if($this->coincidencematrix[$i]->getNumdoccontent() == 0){
                array_splice($this->coincidencematrix,$i,1);
            }
        }
        return $this->coincidencematrix;
    }

    public function applyLogicOperators(){
        $filesmatrix = $this->getFilesWithWords();
        for($i=0;$i<count($this->logicoperators);$i++){
            if($this->logicoperators[$i] == 'and'){
                $filesmatrix[$i+1] = $this->intersectArrays($filesmatrix[$i],$filesmatrix[$i+1]);
            }
            elseif($this->logicoperators[$i] == 'or'){
                $filesmatrix[$i+1] = $this->unionArrays($filesmatrix[$i],$filesmatrix[$i+1]);
            }
        }
        return $filesmatrix[count($filesmatrix)-1];
    }

    private function setLogicoperators($words,$numwords){
        $this->logicoperators = [];
        for($i=1,$j=0;$i<$numwords;$i=$i+2,$j++){
            $this->logicoperators[$j] = $words[$i];
        }
    }

    private function setVerbs($words,$numwords){
        $this->verbs=[];
        for($i=0,$j=0;$i<$numwords;$i=$i+2,$j++){
            $this->verbs[$j] = $words[$i];
        }
    }

    private function intersectArrays($array1,$array2){
        return array_intersect($array1,$array2);
    }

    private function unionArrays($array1,$array2){
        return array_merge($array1,$array2);
    }

    private function getFilesWithWords(){
        $filesmatrix = [];
        for($j=0;$j<count($this->coincidencematrix);$j++){
            $docids = $this->coincidencematrix[$j]->getDocids();
            $numdocs = count($docids);
            $arraydocs = [];
            for($i=0;$i<$numdocs;$i++){
                $arraydocs[$i] = $docids[$i]->getDocid();
            }
            $filesmatrix[$j] = $arraydocs;
        }
        return $filesmatrix;
    }
}
?>