<?php
class IndexItem{
    private $indice;
    private $numdoccontent;
    private $totalfrecuen;
    private $docids;

    function __construct($indice,$numdoccontent,$totalfrecuen,$docids){
        $this->indice = $indice;
        $this->numdoccontent = $numdoccontent;
        $this->totalfrecuen = $totalfrecuen;
        $this->docids = $docids;
    }

    public function getIndice(){
        return $this->indice;
    }

    public function getNumdoccontent(){
        return $this->numdoccontent;
    }

    public function getTotalfrecuen(){
        return $this->totalfrecuen;
    }

    public function getDocids(){
        return $this->docids;
    }

    public function setTotalfrecuen($totalfrecuen){
        $this->totalfrecuen = $totalfrecuen;
    }

    public function setDocids($docids){
        $this->docids = $docids;
    }
}
?>