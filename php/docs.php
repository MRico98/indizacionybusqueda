<?php
class Docs{
    private $docid;
    private $count;
    private $nomarchivo;
    private $content;

    function __construct($docid,$count,$nomarchivo,$content){
        $this->docid = $docid;
        $this->count = $count;
        $this->nomarchivo = $nomarchivo;
        $this->content = $content;
    }

    public function getDocid(){
        return $this->docid;
    }

    public function getCount(){
        return $this->count;
    }

    public function getNomarchivo(){
        return $this->nomarchivo;
    }

    public function getContent(){
        return $this->content;
    }
    
}
?>