<?php
    try
    {
        // $bdd= new PDO('mysql:host=localhost;dbname=gestion_stock','root','}E.%hme0reo7',array(
        //     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
         $bdd = new PDO('mysql:host=localhost;dbname=gestion_hopital', 'root','1234',array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
        die('Erreur :'.$e ->getMessage());
    }
?>