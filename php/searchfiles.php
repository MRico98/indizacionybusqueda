<?php
include 'queryform.php';
include 'vectorspacemodel.php';

$busqueda = $_POST['search'];
$queryform = new QueryForm($busqueda);
$resultado = $queryform->getAllVerbsCoincidence();
$documentsname = $queryform->applyLogicOperators();
$query = $queryform->getVerbs();
$documentsinfo = buildDocumentInfoArray($documentsname);
$rankins = new VectorSpaceModel();
$rankeddocuments = $rankins->rankingDocuments($query,$documentsinfo);
print_r($rankeddocuments);

function buildDocumentInfoArray($documentsname){
    $documentarrayinfo = [];
    $numdocument = count($documentsname);
    foreach($documentsname as $i => $value){
        $documentarrayinfo[$documentsname[$i]] = file_get_contents('../documents/'.$value);
    }
    return $documentarrayinfo;
}
/*
function correctKeysArray($array){
    $newarray = [];
    $sizearray = count($array);
    foreach($array as $arrayelement){
        $newarray[$i] = a
    }
}*/
?>