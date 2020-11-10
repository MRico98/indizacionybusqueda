<?php
include 'queryform.php';

$busqueda = $_POST['search'];
$queryform = new QueryForm($busqueda);
$resultado = $queryform->getAllVerbsCoincidence();
$queryform->applyLogicOperators();
/*
$services = new Services();
print_r($parametrosbusqueda);
$prueba = $services->createSearchQuery("to");
print_r($prueba);
*/
?>