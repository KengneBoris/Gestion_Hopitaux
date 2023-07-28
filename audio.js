let numRecordings = 0;

function recordSpeaker() {
  if (numRecordings < 3) {
    numRecordings++;
    setMessage(`Enregistrement vocal ${numRecordings}`);
    recordAudio();
  } else {
    setMessage('Les enregistrements sont terminés. Entraînement du modèle en cours...');
    trainModel();
  }
}

function trainModel() {
  for (let i = 0; i < 5; i++) {
    setTimeout(() => {
      setMessage(`Entraînement du modèle - itération ${i + 1}`);
      trainModelAPI();
    }, i * 2000);
  }
}

function testSpeaker() {
  setMessage('Enregistrement pour le test du locuteur');
  recordAudioTest();
}

function recordAudio() {
  setMessage('Enregistrement en cours...');
  fetch('http://localhost:8000/record-audio', {
    method: 'POST'
  })
  .then(response => response.json())
  .then(data => {
    setMessage('Enregistrement audio effectué : ' + JSON.stringify(data));
    recordSpeaker();
  })
  .catch(error => {
    setMessage('Erreur lors de l\'enregistrement audio : ' + error);
  });
}

function trainModelAPI() {
  fetch('http://localhost:8000/train-model', {
    method: 'POST'
  })
  .then(response => response.json())
  .then(data => {
    setMessage('Entraînement du modèle terminé : ' + JSON.stringify(data));
  })
  .catch(error => {
    setMessage('Erreur lors de l\'entraînement du modèle : ' + error);
  });
}

function recordAudioTest() {
  setMessage('Enregistrement audio pour le test en cours...');
  fetch('http://localhost:8000/record-audio-test', {
    method: 'POST'
  })
  .then(response => response.json())
  .then(data => {
    setMessage('Enregistrement audio pour le test effectué : ' + JSON.stringify(data));
    recognizeSpeaker();
  })
  .catch(error => {
    setMessage('Erreur lors de l\'enregistrement audio pour le test : ' + error);
  });
}

function recognizeSpeaker() {
  setMessage('Reconnaissance du locuteur en cours...');
  fetch('http://localhost:8000/recognize-speaker', {
    method: 'POST'
  })
  .then(response => response.json())
  .then(data => {
    setMessage('Reconnaissance du locuteur terminée : ' + JSON.stringify(data));
  })
  .catch(error => {
    setMessage('Erreur lors de la reconnaissance du locuteur : ' + error);
  });
}

function setMessage(message) {
  document.getElementById('message').innerText = message;
}
