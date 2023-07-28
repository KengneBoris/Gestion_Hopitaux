<?php

session_start();

include 'connexion.php';
include 'securite.php';
include './chifrement.php';

$get_mat = (int) $_GET['matricule'];

$reponse=$bdd->prepare("SELECT * from dossier_patient d ,patient p 
WHERE d.ID_PATIENT=p.ID_PATIENT
AND ID_DOSSIER = ?");

    $reponse->execute([$get_mat]);

    $req_user = $reponse->fetch();

?>
<html>
    <head>
        <title>
            Dossier Patient
        </title>
    </head>
    <body onload='window.print()'>
    <h1><center></center></h1>
           <div style="border-width: 3px;border-style: solid; width: 100%; height: 60px;background: #bbbbbb;"><p><h2><center>Dossier du patient <?= decrypter($req_user['nom']) ?><center><h2></p></div>
        <div  style="margin-left: 30px;">  
        <div style="margin-top: 30px;"><p>Le present dossier appartient à : </p></div> 
          <div style="margin-top: 70px; margin-left: 200px">
            <div >
                <p><strong>Nom: </strong></p>
                  <p><strong> Prenom : </strong></p>
                   <p><strong>Adresse : </strong></p>
                   <p><strong>Telephone : </strong></p>
                   <p><strong>Sexe : </strong></p>
                   <p><strong>Date de Naissance : </strong></p>
            </div>
            <div style="margin-top: -200px; margin-left: 200px">
              <p><?= decrypter($req_user['nom']) ?></p>
              <p><?= decrypter($req_user['prenom'])?></p>
              <p><?= decrypter($req_user['tel'])?></p>
              <p><?= decrypter($req_user['tel'])?></p>
              <p><?= decrypter($req_user['sexe'])?></p>
              <p><?= $req_user['date_naissance'];?></p>
            </div>
          </div>    
          <div style="margin-top: -165px; margin-left: 500px; margin-bottom: 100px">
            <div>
            <img style="border-width: 3px;border-style: dotted; width: 350px; height: 250px; margin-top: -80px; margin-left: 150px" src="<?= $req_user['photo'] ?>" alt="">
            </div>
          </div>
          <div>
          <?php
                                            
                                            $menu1=$bdd->query("SELECT * from concultation c, patient p, dossier_patient d where p.ID_PATIENT=c.ID_PATIENT and p.ID_PATIENT=d.ID_PATIENT and d.ID_DOSSIER=$get_mat");
                                            while($rep1=$menu1->fetch()){?>
                                             <p class="form-control" cols="30" rows="10"> Consultation du <?=$rep1['DATE']?> <br> <?=decrypter($rep1['INFORMATION']);?></p>

                                          <?php
                                            }
                                           ?>
          </div>


    </body>
</html>