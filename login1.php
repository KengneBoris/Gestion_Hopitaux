<?php
    session_start();
    $login=$_POST['login'];
    $mots=$_POST['pass'];
    include "connexion.php";
    include './chifrement.php';

    

    $reponse=$bdd->query('SELECT login1,mots_passe,TYPE ,id_user,nom,etat FROM user');

    $test = "toto";
    
    while($donne=$reponse->fetch()){
        $_SESSION['id_user']=$donne['id_user'];


        // $mots==$donne['mots_passe'] &&
       
        if($login==$donne['login1'] &&  password_verify($mots,$donne['mots_passe'] ))  {
             $_SESSION['TYPE']=$donne['TYPE'];
            $_SESSION['nom']=$donne['nom'];
            $_SESSION['pass'] = $mots;
            // die('fin');
            
        
            $test = "titi";
           
            
            if($donne['etat']=="desactive"){
            $_SESSION['erreur1']="vous avais été bloquer";
              header('location:index.php');
           }
            
           
            elseif($donne['TYPE']=='administrateur' ){
                
                echo "vous etes administrateur";

                $rostant=$bdd->query("SELECT id_user as id FROM user u where u.id_user=".$_SESSION['id_user'])->fetch();
                
                $rep=$rostant['id'];

                $_SESSION['id']=$rep;
                $_SESSION['pass'] = $mots;
                // var_dump($rep);

                header('location:administrateur.php' );

                break;
            }

            elseif($donne['TYPE']=='pharmacien'){

                echo "vous etes pharmacien";

                $rostant=$bdd->query("SELECT id_user as id FROM user u where u.id_user=".$_SESSION['id_user'])->fetch();
                
                $rep=$rostant['id'];

                $_SESSION['id']=$rep;
                $_SESSION['pass'] = $mots;
                    
                // var_dump($rep);
                header('location:pharmacier.php' );

               break;
            }
           


            elseif($donne['TYPE']=='medecin' ){
                  
                echo "vous etes Medecin";

                $rostant=$bdd->query("SELECT id_user as id FROM user u where u.id_user=".$_SESSION['id_user'])->fetch();
                
                $rep=$rostant['id'];

                $_SESSION['id']=$rep;
                $_SESSION['pass'] = $mots;
                //   var_dump($rep);

                //   die('fin');

            header('location:personnel.php');
                

               break;
            }
            
        }
    }
        $reponse->closecursor();
        
    
        if($test == "toto"){
            $_SESSION['erreur']="mots de passe incorrect";
            header('location:index.php');
    
        }
        
   
    


?>