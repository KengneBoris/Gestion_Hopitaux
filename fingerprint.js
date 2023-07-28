$(document).ready(() => {
  // ID du bouton d'enrôlement
  const enrollBtn = $('#enroll-btn');

  // ID des éléments d'affichage du statut et des données d'empreinte digitale
  const statusDiv = $('#status');
  const fingerprintInput = $('#fingerprint-data');

  // Gestionnaire d'événement pour le bouton d'enrôlement
  enrollBtn.on('click', () => {
    // Afficher un message de statut
    statusDiv.text('Veuillez placer votre doigt sur le capteur d\'empreintes digitales...');

    // Appeler l'API ou le service backend pour démarrer le processus d'enrôlement
    $.ajax({
      url: 'http://localhost:8000/start-enrollment', // URL de votre API ou endpoint pour démarrer l'enrôlement
      method: 'GET',
      success: () => {
        // Le processus d'enrôlement a été démarré avec succès
        // Afficher les instructions à l'utilisateur pour placer son doigt

        // Afficher un message de statut
        statusDiv.text('Veuillez placer votre doigt sur le capteur d\'empreintes digitales...');

        // Réinitialiser la valeur de l'empreinte digitale
        fingerprintInput.val('');

        // Appeler périodiquement une fonction pour vérifier l'état de l'enrôlement
        checkEnrollmentStatus();
      },
      error: (error) => {
        console.error('Une erreur s\'est produite lors du démarrage de l\'enrôlement :', error);
      }
    });
  });

  // Fonction pour vérifier l'état de l'enrôlement
  function checkEnrollmentStatus() {
    // Appeler l'API ou le service backend pour vérifier l'état de l'enrôlement
    $.ajax({
      url: 'http://localhost:8000/enrollment-status', // URL de votre API ou endpoint pour vérifier l'état de l'enrôlement
      method: 'GET',
      success: (response) => {
        if (response.enrollmentInProgress) {
          // L'enrôlement est en cours, continuer à vérifier l'état
          setTimeout(checkEnrollmentStatus, 1000);
        } else if (response.enrollmentComplete) {
          // L'enrôlement est terminé, récupérer les données d'empreinte digitale

          // Afficher un message de statut
          statusDiv.text('Enrôlement terminé avec succès.');

          // Récupérer les données d'empreinte digitale
          const fingerprintData = response.fingerprintData;

          // Afficher les données d'empreinte digitale dans l'input
          fingerprintInput.val(fingerprintData);
        } else {
          // L'enrôlement a échoué ou a rencontré une erreur

          // Afficher un message d'erreur
          statusDiv.text('Erreur lors de l\'enrôlement.');
        }
      },
      error: (error) => {
        console.error('Une erreur s\'est produite lors de la vérification de l\'état de l\'enrôlement :', error);
      }
    });
  }
});
