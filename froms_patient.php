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
          if(isset($_SESSION['message'])){
         ?>
            <h1><?php echo $_SESSION['message']; ?> </h1>
            <?php
            UNSET($_SESSION['message']);

          }

          ?>
                <!-- new section -->
          <form action="ajout_patient.php" method="post" enctype="multipart/form-data">
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
                                <label class="form-label" for="exampleInput">nom :</label>
                                <input class="form-control" id="exampleInput" type="text" name="nom" required placeholder="entrer le nom" >
                               
                                </div>
                                <div class="mb-3">
                                <label class="form-label" for="exampleInp">prenom :</label>
                                <input class="form-control" id="exampleIn^p" type="text" name="prenom" placeholder="entrer le prenom"  required>
                                </div>

                               
                                <div class="mb-3">
                                <label class="form-label" for="exampleInp">Tel :</label>
                                <input class="form-control" id="exampleIn^p" type="number" name="tel" placeholder="entrer le prenom"  required>
                                </div>

                                <div class="mb-3">
                                <label class="form-label" for="exampleInp">Empreinte Digitale :</label><br>
                                <button onclick="startEnrollment()" class="btn btn-primary" id="enroll-btn" type="button" style="margin-left: 350px;">Capturer une empreinte digitale</button>
                                <input class="form-control" id="fingerprint-data" type="text" name="fingerprint" placeholder="empreinte digitale" >
                              <script>
                                function startEnrollment() {
  // Code à exécuter lors du clic sur le bouton

  // Code d'enrôlement précédent
  const SerialPort = require('serialport');
  const Readline = require('@serialport/parser-readline');
  const fs = require('fs');

  const port = new SerialPort('COM4', { baudRate: 9600 }); 
  const parser = port.pipe(new Readline({ delimiter: '\r\n' }));

  const filename = 'C:/wamp64/www/gestion_hopital/fingerprint/fingerprint_data.txt'; // Spécifiez le nom du fichier pour enregistrer les données

  let currentId = 1; // ID en cours pour l'enrôlement
  let enrollmentInProgress = false; // Indicateur pour l'enrôlement en cours

  // Événement de réception de données série
  parser.on('data', (data) => {
    // Vérifier si c'est un message d'état d'enrôlement
    if (data.startsWith('Placez votre doigt')) {
      console.log(data);
    } else if (data === 'Enrollment successful!') {
      enrollmentInProgress = false;
      console.log(`Enrôlement réussi pour l'ID ${currentId}`);
      currentId++; // Passer à l'ID suivant
      // Demander l'enrôlement pour le prochain ID
      if (currentId <= 127) {
        enrollFingerprint(currentId);
      } else {
        console.log('Enrôlement terminé pour tous les ID.');
      }
    }
  });

  // Enrôlement d'une empreinte digitale pour un ID spécifique
  function enrollFingerprint(id) {
    enrollmentInProgress = true;
    console.log(`Prêt pour l'enrôlement de l'empreinte digitale pour l'ID ${id}`);
    port.write(`enroll ${id}\n`);
  }

  // Fonction pour enregistrer les données d'empreinte digitale dans le fichier
  function saveFingerprintData(id, data) {
    const line = `${id},${data}\n`;
    fs.appendFile(filename, line, (err) => {
      if (err) {
        console.error('Erreur lors de l\'enregistrement des données :', err);
      }
    });
  }

  // Enrôlement initial pour le premier ID
  enrollFingerprint(currentId);
}

                              </script>  
                              </div>

                                <label for="voiceRecording1">Enregistrement vocal 1:</label>
    <button id="recordButton1" type="button">Enregistrer</button>
    <button id="stopButton1" type="button" disabled>Arrêter</button>
    <audio id="audioPlayer1" controls></audio><br>

    <label for="voiceRecording2">Enregistrement vocal 2:</label>
    <button id="recordButton2" type="button">Enregistrer</button>
    <button id="stopButton2" type="button" disabled>Arrêter</button>
    <audio id="audioPlayer2" controls></audio><br>

    <label for="voiceRecording3">Enregistrement vocal 3:</label>
    <button id="recordButton3" type="button">Enregistrer</button>
    <button id="stopButton3" type="button" disabled>Arrêter</button>
    <audio id="audioPlayer3" controls></audio><br>
    

                                
                      
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
                                <label class="col-sm-3 form-label" for="inputH">sexe :</label>
                                <div class="col-sm-9">
                                <select class="form-control" name="sexe" id="">
                                    <option value="masculin">masculin</option>
                                    <option value="féminin">féminin</option>
                                </div>
                                </select>

                                </div>
                                <div class="row gy-2 mb-4">
                                <label class="col-sm-3 form-label" for="inputHo">date Naissance :</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="" type="date" name="date" >
                                </div>
                                </div>

                                <div style="margin-top: auto;margin-left: auto">
                                <p>Photo :</p><input name="photo" id="photo" type="file" style="background: rgba(255,255,255,0);border-radius: 10px;border-width: 3px;font-size: 20px;width: 386.4px;height: 46.6px;margin-top: -13px;" placeholder="Entrez l'adresse"
                                    value=" ">
                                    <div style="border-width: 3px;border-style: dotted; width: 350px; height: 250px; margin-bottom: 30px; margin-left: 100px;" class="uploadedImage" id="uploadedImage"></div>
                                    <button id="captureImageButton" type="button">Prendre une photo</button><br>
                                  </div>


                                <div class="row">
                                <div class="col-sm-9 ms-auto">
                                    <input style="float: left;" class="btn btn-primary" type="submit" value="enregistrer">
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
    <script src="image.js"></script>
    <script src="fingerprint.js"></script>
    <script src="finger-api.js"></script>
    <!-- Main File-->
    <script src="js/front.js"></script>
    <script>
    
     
      
    </script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  </body>
</html>