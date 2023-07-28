import SerialPort from 'serialport';

// Configuration du port série pour communiquer avec l'Arduino
const port = new SerialPort('COM4', { baudRate: 9600 });

// Récupérer le bouton
const startBtn = document.getElementById('start-btn');

// Ajouter un gestionnaire d'événements au bouton
startBtn.addEventListener('click', () => {
  startFingerprintDetection();
});

// Écouter les données du port série
port.on('data', (data) => {
  // Vérifier si l'empreinte digitale a été détectée
  if (data.toString().trim() === 'Fingerprint Detected') {
    // Afficher une alerte
    alert('Bonjour Monsieur');
  }
});

// Fonction pour démarrer la détection de l'empreinte digitale
function startFingerprintDetection() {
  // Envoyer une commande à l'Arduino pour démarrer la détection de l'empreinte digitale
  port.write('D');
}


