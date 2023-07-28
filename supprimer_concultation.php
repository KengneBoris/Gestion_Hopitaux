<?php
include 'securite.php';
include './chifrement.php';

function supprimer_user(){
    
    include 'connexion.php';

    // die('fin1');

    $rep=$bdd->query("DELETE FROM concultation WHERE ID_CONSULTATION=".$_GET['id_concultation']);
    if($rep){
        echo "suppression reussi";

        header('location:session_concultation.php');
    }else{
        echo "probleme ";
    }

}
supprimer_user()

?>