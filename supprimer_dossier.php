<?php
include 'securite.php';
include './chifrement.php';

function supprimer_dossier(){
    
    include 'connexion.php';

    // die('fin1');

    $rep=$bdd->query("DELETE FROM dossier_patient WHERE ID_DOSSIER =".$_GET['id_dossier']);
    if($rep){
        echo "suppression reussi";

        header('location:session_dossier.php');
    }else{
        echo "probleme ";
    }

}
supprimer_dossier()

?>