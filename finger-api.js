const express = require('express');
const app = express();
const five = require('johnny-five');
const SerialPort = require('serialport');
const Readline = require('@serialport/parser-readline');

// Configuration du port série pour communiquer avec l'Arduino
const serialport = new SerialPort('COM4', {
  baudRate: 57600
});

// Création du parser de ligne pour lire les données du port série
const parser = port.pipe(new Readline({ delimiter: '\r\n' }));

// Initialisation de Johnny-Five avec le port série
const board = new five.Board({ port: serialport });

// Enregistrement en cours
let enrollmentInProgress = false;
// Données d'empreinte digitale
let fingerprintData = '';

// Endpoint pour démarrer l'enrôlement
app.get('/start-enrollment', (req, res) => {
    function startEnrollment() {
        if (enrollmentInProgress) {
          console.log('L\'enrôlement est déjà en cours.');
          return;
        }
      
        enrollmentInProgress = true;
        fingerprintData = '';
      
        console.log('Démarrage de l\'enrôlement...');
      
        // Envoyer une commande à l'Arduino pour démarrer l'enrôlement
        board.serial.write('E');
      }
      
      // Parser les données reçues du port série
      parser.on('data', (data) => {
        if (enrollmentInProgress) {
          if (data.startsWith('Fingerprint:')) {
            // Les données d'empreinte digitale ont été reçues
            const fingerprint = data.split(':')[1].trim();
            fingerprintData = fingerprint;
            console.log('Empreinte digitale capturée :', fingerprint);
      
            // Terminer l'enrôlement
            enrollmentInProgress = false;
          } else if (data === 'Enrollment failed') {
            // L'enrôlement a échoué
            console.log('L\'enrôlement a échoué.');
            enrollmentInProgress = false;
          }
        }
      });
      
      // Connexion réussie à l'Arduino
      board.on('ready', () => {
        console.log('Connexion réussie à l\'Arduino.');
      
        // Démarrer l'enrôlement en réponse à un événement, par exemple un clic sur un bouton dans votre application web
        startEnrollment();
      });
  // Répondre avec succès
  res.status(200).end();
});

// Endpoint pour vérifier l'état de l'enrôlement
app.get('/enrollment-status', (req, res) => {
  // Vérifier si l'enrôlement est en cours
  if (enrollmentInProgress) {
    // Renvoyer l'état d'enrôlement en cours
    return res.status(200).json({ enrollmentInProgress: true });
  }

  // Vérifier si l'enrôlement est terminé
  if (fingerprintData) {
    // Renvoyer l'état d'enrôlement terminé avec les données d'empreinte digitale
    return res.status(200).json({ enrollmentComplete: true, fingerprintData });
  }

  // L'enrôlement n'est ni en cours ni terminé, renvoyer une erreur
  res.status(400).json({ message: 'L\'enrôlement n\'a pas encore été démarré.' });
});

// Port d'écoute du serveur
const port = 3000;

// Démarrer le serveur
app.listen(port, () => {
  console.log(`Serveur démarré sur le port ${port}`);
});
