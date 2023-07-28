<?php
session_start();
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
        <div class="content-inner w-100">
          <!-- Page Header-->
          <header class="bg-white shadow-sm px-4 py-3 z-index-20">
            <div class="container-fluid px-0">
              <h2 class="mb-0 p-1">tableau de bord</h2>
            </div>
          </header>
          <?php 
          if(isset($_SESSION['message1'])){
         ?>
            <h1><?php echo $_SESSION['message1']; ?> </h1>
            <?php
            UNSET($_SESSION['message1']);

          }

          ?>
                <!-- new section -->
          <form action="fonction.php" method="post">
          <section class="forms"> 
            <div class="container-fluid">
                <div class="row">
                <!-- Basic Form-->
                        <div class="col-lg-6">
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
                                <label class="form-label" for="exampleInput">nom </label>
                                <input class="form-control" id="exampleInput" type="text" name="nom" required placeholder="entrer le nom" >
                               
                                </div>
                                <div class="mb-3">
                                <label class="form-label" for="exampleInp">prenom</label>
                                <input class="form-control" id="exampleInp" type="text" name="prenom" placeholder="entrer le prenom"  required>
                                </div>

                                <div class="mb-3">
                                <label class="form-label" for="exampleInp">Adress</label>
                                <input class="form-control" id="exampleInp" type="text" name="adress" placeholder="entrer l'adresse"  required>
                                </div>

                                <div class="mb-3">
                                <label class="form-label" for="exampleInp">Tel</label>
                                <input class="form-control" id="exampleInp" type="number" name="tel" placeholder="entrer le numéro de téléphone"  required>
                                </div>
                                
                      
                            </div>
                        </div>
                        </div>
                        <!-- Horizontal Form-->
                        <div class="col-lg-6">
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
                            <p class="text-sm"></p>
                            
                                <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputH">Login</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="" type="text"  name="login" placeholder="entrer le login">
                                </div>
                                </div>

                                 
                                <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputH">Password</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="" type="Password"  name="pass" placeholder="entrer le password">
                                </div>
                                </div>

                                <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputH">Type</label>
                                <div class="col-sm-9">                                    
                                    <select name="type" id="" class="form-control">
                                    <option value="">seletionner le type de utilisateur</option>
                                      <?php
                                      if(isset($_SESSION['type'])){?>
                                        <option value="administrateur">administrateur</option>
                                       <?php
                                      }
                                       ?>
                                      <option value="medecin">Medecin</option>
                                      <option value="pharmacien">pharmacien</option>
                                    </select>
                                </div>
                                </div>




                                <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHo">date</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="" type="date" name="date1" value="<?php echo date('Y-m-d')  ?>" disabled >
                                </div>
                                </div><br><br>
                                <div class="row">
                                <div class="col-sm-9 ms-auto">
                                    <input class="btn btn-primary" type="submit" value="enregistrer">
                                </div>
                                </div>
                     
                            </div>
                        </div>
                        </div>
                </div>
            </div>
          </section>
          </form>
          
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