<?php

class FileUnploaded{
    private $namefile;
    private $contentfile;

    function __construct($namefile,$contentfile){
        $this->namefile = $namefile;
        $this->contentfile = $contentfile;
    }

    public function setNamefile($namefile){
        $this->namefile = $namefile;
    }
    
    public function getNamefile(){
        return $this->namefile;
    }

    public function setContentfile($contentfile){
        $this->contentfile = $contentfile;
    }

    public function getContentfile(){
        return $this->contentfile;
    }
}
?>