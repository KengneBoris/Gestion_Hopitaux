<?php

session_start();
include 'connexion.php';
include 'securite.php';
include './chifrement.php';

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST)){
    $nom= crypter($_POST['nom']);

    $prenom=crypter($_POST['prenom']);  
    
    $sexe=crypter($_POST['sexe']);
    
    $tel=crypter($_POST['tel']);
    
    $date_naissance=$_POST['date'];
    
    $date=date('Y-m-d');

    $destination = 'images/';

    $reponse=$bdd->query("SELECT MAX(ID_PATIENT) as id FROM patient")->fetch();
$id=$reponse['id'];

$nomdossier = $id + 1;

$directory = $destination . $nomdossier . '/';

if(!is_dir($directory)){
    mkdir($directory, 0777, true);
}



$filename = $directory . 'image' . $nomdossier . '.jpg';

$filetype = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

$file = $_FILES['photo']['name'];

move_uploaded_file($_FILES['photo']['tmp_name'], $filename);

$reponse=$bdd->prepare("INSERT into patient(ID_USER,nom,prenom,sexe,date_naissance,tel,date_ajout,photo) values(?,?,?,?,?,?,?,?)");

        $reponse->execute(array($_SESSION['id_user'],$nom,$prenom,$sexe,$date_naissance,$tel,$date,$filename));
        
        
        if($reponse){
            
            $_SESSION['message']="Enregistremet reussi";
        
            echo "bon";
        
            header('location:session_patient.php');
        }
}
?>