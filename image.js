const fileInput = document.getElementById("photo");
const uploadedImageDiv = document.getElementById("uploadedImage");
const take = document.getElementById("captureImageButton");

fileInput.addEventListener("change", getImage, false);

take.addEventListener("click", captureAndDisplayPhoto);



function getImage(){
    uploadedImageDiv.innerHTML = "";
    console.log("images", this.files[0]);
    const imageToProcess = this.files[0];
    let image = new Image(340, 250);
    image.src = URL.createObjectURL(imageToProcess);
    //uploadedImageDiv.style.border = "4px solid #FCB514";
    uploadedImageDiv.appendChild(image);
    image.addEventListener("load", () => {
        const imageDimensions = { width: image.width, height: image.height};
        const data = {
            image,
            imageDimensions,
        };
        console.log(data);
        processImage(data);
    })
}

function captureAndDisplayPhoto() {
    const video = document.createElement('video');
    const canvas = document.createElement('canvas');
    
    // Accéder à la webcam via l'API getUserMedia
    navigator.mediaDevices.getUserMedia({ video: true })
      .then((stream) => {
        video.srcObject = stream;
        video.onloadedmetadata = () => {
          video.play();
          
          // Définir la taille du canvas pour correspondre à la taille de la vidéo
          canvas.width = video.videoWidth;
          canvas.height = video.videoHeight;
          
          // Dessiner la vidéo sur le canvas
          const context = canvas.getContext('2d');
          context.drawImage(video, 0, 0, canvas.width, canvas.height);
          
          // Convertir le contenu du canvas en base64
          const dataURL = canvas.toDataURL('image/jpeg');
          
          // Afficher l'image dans le champ de saisie de type fichier (input file)
          const blob = dataURItoBlob(dataURL);
          const file = new File([blob], 'captured-image.jpg', { type: 'image/jpeg' });
          fileInput.files = [file];
          
          // Arrêter la vidéo et libérer la ressource de la webcam
          video.pause();
          video.srcObject = null;
          stream.getTracks().forEach(track => track.stop());
        };
      })
      .catch((error) => {
        console.error('Erreur lors de l\'accès à la webcam :', error);
      });
  }
  
  function dataURItoBlob(dataURI) {
    const byteString = atob(dataURI.split(',')[1]);
    const mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
    const ab = new ArrayBuffer(byteString.length);
    const ia = new Uint8Array(ab);
    
    for (let i = 0; i < byteString.length; i++) {
      ia[i] = byteString.charCodeAt(i);
    }
    
    return new Blob([ab], { type: mimeString });
  }
  

