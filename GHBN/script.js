const labels = [];

async function getNames() {
  const response = await fetch('/GHBN/facialId.php');
  const data = await response.json();
  console.log(data);

  data.forEach((val) => {
    labels.push(val.last_name)
  });

  console.log(labels)
}

getNames();

Promise.all([
  faceapi.nets.faceRecognitionNet.loadFromUri('/GHBN/models'),
  faceapi.nets.faceLandmark68Net.loadFromUri('/GHBN/models'),
  faceapi.nets.ssdMobilenetv1.loadFromUri('/GHBN/models')
  ])
  .then(uploadImage)

  // Function for face detect & image upload

 async function uploadImage() {
      const con=document.querySelector('.mycontainer'); //2
      const input=document.querySelector('#myImg'); // 3
      const imgFile=document.querySelector('#myFile'); //1
      const labeledFaceDescriptors = await loadLabeledImages()
      const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6)
      var can;
      var img;
      document.body.append('Loaded');
      imgFile.addEventListener('change',async()=>{ //4
          if (can) {can.remove();}
          if (img) {img.remove();}

          // creating a htmlelement from a blob

          img = await faceapi.bufferToImage(myFile.files[0]); //5
          input.src=img.src; // 6
          can = faceapi.createCanvasFromMedia(img); // new 7
          con.append(can); // new 8
          const displaySize = { width: input.width, height: input.height } // new 9
          faceapi.matchDimensions(can, displaySize) // new 10
          const detections = await faceapi.detectAllFaces(input).withFaceLandmarks()
          .withFaceDescriptors() // new 11
          
          console.log(detections); // new 12 assigned by me
          const resizedDetections = faceapi.resizeResults(detections, displaySize) // new 13
          const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor)) // imported 14
          console.log(results)
          results.forEach((result, i) => { // imported 15
            const box = resizedDetections[i].detection.box // imported 15
            const drawBox = new faceapi.draw.DrawBox(box, { label: result.toString() }) // imported 15
            drawBox.draw(can) // imported 15
          }) // imported 15
      })
  }

function loadLabeledImages() {
    
   return Promise.all(
    labels.map(async label => {
      const descriptions = []
      for (let i = 1; i <= 1; i++) {
        const images = await faceapi.fetchImage(`/GHBN/img/${label}/${i}.jpg`)
        const detections = await faceapi.detectSingleFace(images).withFaceLandmarks().withFaceDescriptor()
        descriptions.push(detections.descriptor)
      }
      return new faceapi.LabeledFaceDescriptors(label, descriptions)
    })
  )
}