// Chargement des modèles de face-api.js
Promise.all([
  faceapi.nets.tinyFaceDetector.loadFromUri('models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('models'),
  faceapi.nets.faceRecognitionNet.loadFromUri('models'),
 faceapi.nets.ssdMobilenetv1.loadFromUri('models/'),
]).then(startVideo);

async function startVideo() {
  // Accès à la caméra du téléphone
  //const stream = await navigator.mediaDevices.getUserMedia({ video: true });
  const stream = await navigator.mediaDevices.getUserMedia({
    video: true,
    audio: false,
  });
  
  const videoElement = document.getElementById('videoElement');
  videoElement.srcObject = stream;

  const idpersonne = document.getElementById('personName');

  videoElement.addEventListener('play', async function() {
    const canvasElement = document.getElementById('canvasElement');
    const canvasContext = canvasElement.getContext('2d');

    // Redimensionnement du canevas pour correspondre à la taille de la vidéo
    canvasElement.width = videoElement.videoWidth;
    canvasElement.height = videoElement.videoHeight;

    // Chargement des images de référence des personnes
    /*const images = [
      'images/2/image1.png',
      'images/1/1.jpg',
      'images/1/2.jpg',
      // Ajoutez les chemins des autres images de référence ici
    ];*/
//alert(nombre);
    let images = [];

    for(let i=1; i <= nombre; i++){
      images.push("images/" + i + "/image" + i + ".jpg");
    }

    const referenceDescriptors = await Promise.all(
      images.map(async (image) => {
        const img = await faceapi.fetchImage(image);
        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor();
        return detections.descriptor;
      })
    );

    setInterval(async function() {
      canvasContext.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);

      // Détection des visages dans chaque image capturée
      const detections = await faceapi.detectAllFaces(canvasElement, new faceapi.TinyFaceDetectorOptions())
        .withFaceLandmarks()
        .withFaceDescriptors();

      // Comparaison des descripteurs faciaux avec les images de référence
      detections.forEach((detection) => {
        const queryDescriptor = detection.descriptor;
        const distances = referenceDescriptors.map((referenceDescriptor) => faceapi.euclideanDistance(referenceDescriptor, queryDescriptor));
        console.log('Distances :', distances);
        // Votre code de reconnaissance ou traitement des distances ici
        const threshold = 0.5; // Seuil de distance pour l'identification

detections.forEach((detection) => {
  const queryDescriptor = detection.descriptor;
  const distances = referenceDescriptors.map((referenceDescriptor) => faceapi.euclideanDistance(referenceDescriptor, queryDescriptor));
  const minDistance = Math.min(...distances);

  // const personnes = ["Elisée", "Brice"]


  if (minDistance < threshold) {
    // Identification réussie
    const minDistanceIndex = distances.indexOf(minDistance);
    // const personName = `Personne ${minDistanceIndex + 1}`; // Exemple : Nom de la personne correspondante
    const personName = images[minDistanceIndex].split('/')[1]

    console.log(`Personne identifiée : ${personName}`);
    idpersonne.value = personName;
  } else {
    // Visage inconnu
    console.log('Visage inconnu');
  }
});

      });

      faceapi.draw.drawDetections(canvasElement, detections);
    }, 100); // Interval de 100 millisecondes pour la détection continue des visages
  });
}
