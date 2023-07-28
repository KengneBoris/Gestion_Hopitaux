<?php
session_start();
include 'connexion.php';
include 'securite.php';
include './chifrement.php';
?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>gestion hopital</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- Choices CSS-->
    <link rel="stylesheet" href="vendor/choices.js/public/assets/styles/choices.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-MjK/4+N/76jrW4c4o4y4m9//7KuQmJmVjqGD3h17LA8V7vjf5F5Hdn7DdymyX8WYIFiMyvRpxRdZ37Lj0JW60w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
        <div class="content-inner w-100">
          
          <section class="tables">   
            <div class="container-fluid">
              <div class="row gy-4">
                <div class="col-lg-12">
                  <div class="card mb-0">
                    <div class="card-header">
                      <div class="card-close">
                        <div class="dropdown">
                          <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                          <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#"> <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                        </div>
                      </div>
                      <h3 class="h4 mb-0">Dossier patient</h3>

                    </div>
                    <div class="card-body">
                      <div class="table-responsive">
                        <table class="table mb-0 table table-bordered">
                          <!--afficharge du message de de modification  -->


                          <thead>
                            <a href="froms_dossier.php">
                          <button type="submit"  style="margin-left :850px"  class="btn btn-danger"> 
                    <i class="fa fa-plus"></i>
                    ajouter</button><br><br>
                            </a><br>
                            
                            <tr>

                            <th>nom patient</th>
                              <th>nom dossier </th>
                              <th>date_enregistrement</th> 
                              <th>action</th>
                              <th>action</th>                              
                            </tr>
                          </thead>
                          <tbody>
                         <?php
                             $reponse=$bdd->query("SELECT * from dossier_patient d ,patient p WHERE d.ID_PATIENT=p.ID_PATIENT");
                          $i=0;
                         while($rep=$reponse->fetch()){
                            echo"
                            <tr>
                            <td>".decrypter($rep['nom'])."</td>
                            <td>".decrypter($rep['NOM_DOSSIER'])."</td>
                            <td>".$rep['date_enregistrement']."</td>   
                                                      
                            <td><center><a class='btn btn-danger waves-effect waves-light m-r-10' href='supprimer_dossier.php?id_dossier=$rep[0]' > <i class='fas fa-trash-alt'></i>  Supprimer</a></center></td>
                            <td><center><a class='btn btn-info waves-effect waves-light m-r-10' href='afficher_dossier.php?matricule=$rep[0]' > <i class='fas fa-folder-open'></i>  Afficher</a></center></td>                                                        
                            </tr>
                            ";
                            $i++;
                         }
                        //$rep->closeCursor();
                          ?>

                          
                        </td>
                            </tr>
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/just-validate/js/just-validate.min.js"></script>
    <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="js/charts-home.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
    <script>
     
   
      
      
      
    </script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>