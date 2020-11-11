<?php
include 'queryform.php';
include 'vectorspacemodel.php';
include 'wordstandardization.php';

$busqueda = $_POST['search'];
$busqueda = WordStandardization::toLowerCase($busqueda);
$queryform = new QueryForm($busqueda);
$resultado = $queryform->getAllVerbsCoincidence();
$documentsname = $queryform->applyLogicOperators();
$query = $queryform->getVerbs();
$documentsinfo = buildDocumentInfoArray($documentsname);
$rankins = new VectorSpaceModel();
$rankeddocuments = $rankins->rankingDocuments($query,$documentsinfo);
header(constructHeader($rankeddocuments));
exit();

function buildDocumentInfoArray($documentsname){
    $documentarrayinfo = [];
    $numdocument = count($documentsname);
    foreach($documentsname as $i => $value){
        $documentarrayinfo[$documentsname[$i]] = file_get_contents('../documents/'.$value);
    }
    return $documentarrayinfo;
}

function constructHeader($result){
    $location = "Location: ../pages/search.php?";
    foreach($result as $key=>$value){
        $location = $location.$key."=".$value."&";
    }
    return $location;
}
?>