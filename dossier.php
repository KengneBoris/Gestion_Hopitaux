<?php

session_start();

include 'connexion.php';
include 'securite.php';
include './chifrement.php';


// $filename = $_FILES["file"]['name'];

// //  var_dump($filename);

// move_uploaded_file($_FILES['file']['tmp_name'], "./dossier_patient/" . $filename);

$nom_fichier=$_POST['nom_dossier'].".txt";
$contenu=$_POST['info'];

$fichier=fopen($nom_fichier,"w");

if($fichier){
   fwrite($fichier,$contenu);

   fclose($fichier);
}



$id_patient=$_POST['id_patient'];

$nom_dossier=$_POST['nom_dossier'];

$id_patient=$_POST['id_patient'];

$info=$_POST['info'];

$date=date('Y-m-d');

$reponse=$bdd->prepare("INSERT into dossier_patient(ID_PATIENT,NOM_DOSSIER,INFORMATION,date_enregistrement) values(?,?,?,?)");

$reponse->execute(array($id_patient,$nom_dossier,$info,$date));

if($reponse){
    
    $_SESSION['message']="Enregistremet reussi";

    echo "bon";

    
    header('location:session_dossier.php');
}

?>