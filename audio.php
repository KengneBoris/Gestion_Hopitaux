<?php

// URL de l'API FastAPI
$apiUrl = 'http://127.0.0.1:8000';

// Fonction pour enregistrer l'audio via l'API
function record_audio() {
    global $apiUrl;
    
    // Endpoint de l'API pour l'enregistrement audio
    $endpoint = $apiUrl . '/record_audio';

    // Requête POST pour enregistrer l'audio
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Vérification de la réponse de l'API
    if ($httpCode == 200) {
        echo "Enregistrement audio effectué avec succès !";
        // Traiter la réponse de l'API si nécessaire
    } else {
        echo "Une erreur s'est produite lors de l'enregistrement audio.";
    }
}

// Appel de la fonction d'enregistrement audio
record_audio();

?>
