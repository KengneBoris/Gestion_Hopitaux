<?php
session_start();
 include 'connexion.php';
 include 'securite.php';
 include './chifrement.php';

function supprimer($id,$column,$table){

    include 'connexion.php';
    $reponse="DELETE FROM '.$table.' WHERE '.$id.'=".$column;

    $rep1=$bdd->query($reponse);
     var_dump($rep1);
     
}

function supprimer_user(){
    
    include 'connexion.php';

    // die('fin1');

    $rep=$bdd->query("DELETE FROM user WHERE id_user=".$_GET['id']);
    if($rep){
        echo "suppression reussi";
        //redirection

        if($_SESSION['TYPE']=="administrateur"){
            header('location:administrateur.php');

        }elseif($_SESSION['TYPE']=="medecin"){
            header('location:personnel.php');

        }elseif($_SESSION['TYPE']=="pharmarcien"){
            header('location:pharmacier.php');

        }


        
    }else{
        echo "probleme ";
    }

}

function modifier_user($id){
    include 'connexion.php';
   

$reponse=$bdd->query("UPDATE user set NOM='".$_POST['nom']."', LOGIN1='".$_POST['login1']."' , PRENOM='".$_POST['prenom']."', ADRESS='".$_POST['adress']."', TEL='".$_POST['tel']."' WHERE ID_USER='".$id."'   ");
// var_dump($reponse);
// die('fin');
if($reponse){
 $_SESSION['message1']="modification reussi";
         //redirection

        if($_SESSION['TYPE']=="administrateur"){
            header('location:administrateur.php');

        }elseif($_SESSION['TYPE']=="medecin"){
            header('location:personnel.php');

        }elseif($_SESSION['TYPE']=="pharmarcien"){
            header('location:pharmacier.php');

        }

       

}else{

echo "probleme";
}

}

function ajour_user(){
    include 'connexion.php';

   
    $date=date('Y-m-d');

    $mots_passe= password_hash($_POST['pass'],PASSWORD_DEFAULT);
 
    //  var_dump($mots_passe);

    //  die('fin');



    $reponse=$bdd->query("INSERT INTO user(LOGIN1,mots_passe,NOM,PRENOM,ADRESS,TEL,type,date1) VALUES('".$_POST['login']."','".$mots_passe."','".$_POST['nom']."','".$_POST['prenom']."', '".$_POST['adress']."','".$_POST['tel']."', '".$_POST['type']."','".$date."') ");
   
    $id_user=$bdd->query("SELECT id_user FROM user WHERE NOM='".$_POST['pass']."' ")->fetch();

    $identifiant=$id_user['id_user'];

    // var_dump($identifiant);

    // die('fin');
    header('location:froms_user.php');
       

}


function modifier_medicament($id){
    include 'connexion.php';

   

    $date=date('Y-m-d');


$reponse=$bdd->query("UPDATE medicament set NOM='".$_POST['nom1']."', QUANTITE='".$_POST['quantite']."' , PRIX='".$_POST['prix']."', date1='".$date."' WHERE ID_MEDICAMENT='".$id."' ");
// var_dump($reponse);
// die('fin');
if($reponse){
 $_SESSION['message1']="modification reussi";
         //redirection
         header('location:session_medicament.php');
       

}else{

echo "probleme";
}

}


function supprimer_medicament(){
    
    include 'connexion.php';

   

    
    $rep=$bdd->query("DELETE FROM medicament WHERE id_medicament=".$_GET['id_medicament']);
    if($rep){
        echo "suppression reussi";
        //redirection

        header('location:session_medicament.php');
        
    }else{
        echo "probleme ";
    }

}

//appele des fonction

if(isset($_GET['id'])){
 
supprimer_user();

}

if(isset($_POST['login1'])){
  
    modifier_user($_SESSION['id_user']);  
    }

if(isset($_POST['login'])){
    ajour_user();
}

if(isset($_POST['id1'])){
    modifier_medicament($_POST['id1']);
}

if(isset($_GET['id_medicament'])){
 
    supprimer_medicament();
    
    }





?>