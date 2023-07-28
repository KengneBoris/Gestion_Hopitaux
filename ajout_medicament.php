<?php

session_start();

include 'connexion.php';
include 'securite.php';
include './chifrement.php';

$nom=$_POST['nom'];

$qauntite=$_POST['quantite'];

$prix=$_POST['prix'];

$date=date('Y-m-d');

$reponse=$bdd->prepare("INSERT into medicament(ID_PHAMACIER	,nom,quantite,prix,date1) values(?,?,?,?,?)");

$reponse->execute(array($_SESSION['id'],$nom,$qauntite,$prix,$date));

if($reponse){
    
    $_SESSION['message']="Enregistremet reussi";

    header('location:session_medicament.php');
}

?>