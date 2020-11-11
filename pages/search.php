<!DOCTYPE html>
<html>
    <head>
        <title>Busqueda de archivos</title>
    </head>
    <body>  
        <form method="post" action="../php/searchfiles.php">
            <input type="text" size="100" name="search">
            <input type="submit" value="Search" >
        </form> 
        <br>
        <br>
        <?php
        $getsize = count($_GET);
        foreach($_GET as $key=>$value){
            $key = explode("_",$key)[0];
        ?>
            <a href="/indizacionybusqueda/documents/<?php echo $key.".txt";?>" download>Descargar </a> <p><?php echo file_get_contents('../documents/'.$key.'.txt') ?></p><p><?php echo $value;?></p>
            <br>
            <br>
        <?php
        }
        ?>
    </body> 
</html>