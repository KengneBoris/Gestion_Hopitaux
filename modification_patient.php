<?php
include 'securite.php';
include './chifrement.php';

function modifier_medicament(){
    include 'connexion.php';

   

    $date=date('Y-m-d');


$reponse=$bdd->query("UPDATE patient set nom='".crypter($_POST['nom'])."', prenom='".crypter($_POST['prenom'])."' , sexe='".crypter($_POST['sexe'])."', date_naissance='".$_POST['date']."',tel='".crypter($_POST['tel'])."',date_ajout='".$date."' WHERE ID_PATIENT='".$_POST['id']."' ");
// var_dump($reponse);
// die('fin');
if($reponse){
 $_SESSION['message1']="modification reussi";
         //redirection

         header('location:session_patient.php');
       

}else{

echo "probleme";
}

}

modifier_medicament();
?>