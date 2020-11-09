<?php
include 'fileunploaded.php';
include 'invertindex.php';
include 'wordstandardization.php';

if(isset($_POST['submit'])){
    $files = getUnploadedFiles();
    $indiceinvertido = new InvertIndex();
    $files = textStandardization($files);
    $numfiles = count($files);
    for($i=0;$i<$numfiles;$i++){
        $indiceinvertido->extractWords($files[$i]->getNamefile(),$files[$i]->getContentfile());
    }
    $hashing = $indiceinvertido->getHashingindex();
    for($i=0;$i<count($hashing);$i++){
        print_r($hashing[$i]);
        echo "<br>";
    }
}

function getUnploadedFiles(){
    $countfiles = count($_FILES['file']['name']);
    $files = [];
    for($i=0;$i<$countfiles;$i++){
        move_uploaded_file($_FILES['file']['tmp_name'][$i],'../documents/'.$_FILES['file']['name'][$i]);
        $files[$i] = new FileUnploaded($_FILES['file']['name'][$i],file_get_contents('../documents/'.$_FILES['file']['name'][$i]));
    }
    return $files;
}

function textStandardization($files){
    $numfiles = count($files);
    for($i=0;$i<$numfiles;$i++){
        $files[$i]->setContentfile(WordStandardization::toLowerCase($files[$i]->getContentfile()));
        $files[$i]->setContentfile(WordStandardization::deletePunctuationSign($files[$i]->getContentfile()));
    }
    return $files;
}
?>