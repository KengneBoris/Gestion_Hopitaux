<?php

session_start();

include 'connexion.php';
include 'securite.php';
include './chifrement.php';



//$filename = $_FILES["file"]['name'];

//  var_dump($filename);

//move_uploaded_file($_FILES['file']['tmp_name'], "./dossier_patient/" . $filename);

$id_patient=$_POST['id_patient'];

$info=crypter($_POST['info']);

$date=date('Y-m-d');

$reponse=$bdd->prepare("INSERT into concultation(ID_PATIENT,DATE,INFORMATION) values(?,?,?)");

$reponse->execute(array($id_patient,$date,$info));

if($reponse){
    
    $_SESSION['message']="Enregistremet reussi";

    echo "bon";


    header('location:session_concultation.php');
}

?>