<?php
session_start();
include 'securite.php';
include 'connexion.php';
include './chifrement.php';

$reponse=$bdd->query("SELECT MAX(ID_PATIENT) as id FROM PATIENT")->fetch();
$id=$reponse['id'];

$nombre = $id;

echo "<script>var nombre = $nombre;</script>"

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
  <style>
    #video {
      position: absolute;
      align-items: center;
      justify-content: center;
    }
    canvas {
      position: absolute;
      align-items: center;
    }
    body {
      margin: 0;
      padding: 0;
      width: 100vw;
      height: 100vh;
      align-items: center;
    }
  </style>
  <script defer src="dist/face-api.js"></script>
  <script defer src="face-api.min.js"></script>
  <script defer src="app.js"></script>
    
  
  </head>
  <body>
        <div class="content-inner w-100">
          
          <center>
          <h1>Enregistrement vocal</h1>
  <button onclick="recordSpeaker()">Enregistrer le locuteur</button>
  <button onclick="testSpeaker()">Tester le locuteur</button>
  <div id="message"></div>
  <script src="audio.js"></script>
          <form action="afficher_dossier2.php" method="post">
          <div>
            <p>id du patient :
            <input style="margin-top: auto" type="text" id="personName" name="personName">
            <button type="submit" class='btn btn-danger waves-effect waves-light m-r-10' >Afficher Dossier</button></p>
            </form>  
          </center>
        </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/just-validate/js/just-validate.min.js"></script>
    <script src="vendor/choices.js/public/assets/scripts/choices.min.js"></script>
    <script src="js/charts-home.js"></script>
    <script src="image.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
    <script>
    
     
      
    </script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>