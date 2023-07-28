<?php

session_start();

include 'connexion.php';
include 'securite.php';
include 'chifrement.php';

//  var_dump($filename);


$id_patient=$_POST['id_patient'];

$id_personnel=$_POST['id_personnel'];

$nom=crypter($_POST['nom']);

$date=date('Y-m-d');

// $reponse=$bdd->prepare("INSERT into dossier_patient (ID_PATIENT,date_enregistrement,INFORMATION,NOM_DOSSIER) values(?,?,?,?)");
$reponse=$bdd->prepare("INSERT INTO dossier_patient (NOM_DOSSIER, date_enregistrement, ID_PERSONNEL, ID_PATIENT) values(?,?,?,?)");

$reponse->execute(array($nom,$date,$id_personnel,$id_patient));

if($reponse){
    
    $_SESSION['message']="Enregistremet reussi";

    echo "bon";


    header('location:session_dossier.php');
}

?>