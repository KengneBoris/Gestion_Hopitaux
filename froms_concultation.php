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
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.ico">
    
  
  </head>
  <body>
          <?php 
          if(isset($_SESSION['message'])){
         ?>
            <h1><?php echo $_SESSION['message']; ?> </h1>
            <?php
            UNSET($_SESSION['message']);

          }

          ?>
                <!-- new section -->
          <form action="ajout_concultation.php" method="post"  enctype="multipart/form-data">
          <section class="forms"> 
            <div class="container-fluid">
                <div class="row">
                <!-- Basic Form-->
                        <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                            <div class="card-close">
                                <div class="dropdown">
                                <button class="dropdown-toggle text-sm" type="button" id="closeCard1" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></button>
                                <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="closeCard1"><a class="dropdown-item py-1 px-3 remove" href="#"> <i class="fas fa-times"></i>Close</a><a class="dropdown-item py-1 px-3 edit" href="#"> <i class="fas fa-cog"></i>Edit</a></div>
                                </div>
                            </div>
                            <h3 class="h4 mb-0">information</h3>
                            </div>
                            <div class="card-body">
                            
                      
                                <div class="mb-3">
                                <label class="form-label" for="exampleInput">Date concultation :</label>
                                <input class="form-control" id="exampleInput" type="date" value="<?php echo date('Y-m-d'); ?>"  disabled>
                                </div>
                                
                                <div class="mb-3">
                                <label class="form-label" for="exampleInp">nom patient :</label><select  name="id_patient" id="" class="form-control">
                                <?php
                                            
                                            $menu1=$bdd->query("SELECT *from patient");
                                            while($rep1=$menu1->fetch()){?>
                                             <option value="<?php echo $rep1['ID_PATIENT'] ?>"><?= decrypter($rep1['nom']) ?></option>

                                          <?php
                                            }
                                           ?>
                                </select>
                                
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="exampleInput1">INFORMATION CONCULTATION :</label>
                                    <textarea class="form-control" name="info" required id="" cols="30" rows="10"></textarea>
                                </div>

                                <div class="row">
                                <div class="col-sm-9 ms-auto">
                                    <input class="btn btn-primary" type="submit" value="enregistrer">
                                </div>
                                </div>

                               
                               
                            </div>
                        </div>
                        </div>
                        <!-- Horizontal Form-->
                        <div class="col-lg-6">
                       
                        </div>
                </div>
            </div>
          </section>
          </form>
          <!-- Page Footer-->
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>