const dropArea = document.querySelector('#dropArea');
const imageInput = document.querySelector('#image');
const dragText = document.querySelector('#dragText');


const uploadFile = (e) => {
  e.preventDefault();
  console.log('enviando formulario');
}

dropArea.addEventListener('click', (e) => {
  imageInput.click();
});

dropArea.addEventListener('dragover', (e) => {
  e.preventDefault();
  previewImages();
  dropArea.classList.add('active');
  dragText.textContent = "Suelta para subir los archivos";

})

dropArea.addEventListener('dragleave', (e) => {
  e.preventDefault();
  previewImages();
  dropArea.classList.remove('active');
  dragText.textContent = "Arrastra y suelta la imagen";
});

dropArea.addEventListener('drop', (e) => {
  e.preventDefault();
  previewImages();
  dropArea.classList.remove('active');
  dragText.textContent = "Arrastra y suelta la imagen";

});

function previewImages() {
    const preview = document.querySelector('#gallery');
    
    if (this.files) {
      [].forEach.call(this.files, readAndPreview);
    }
  
    function readAndPreview(file) {
      if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
        return Swal.fire({
          title: 'Archivo no válido',
          text: `El archivo ${file.name} no es valido`,
          icon: 'error',
          showConfirmButton: 'true',
        }).then((result) => {
          if(result.isConfirmed){
            location = '/panelUpload.php';
          }
        });
      } // else...
      
      const reader = new FileReader();
      
      reader.addEventListener("load", function() {
        const container = document.createElement('DIV');
        container.classList.add('flex', 'justify-center');
        const image = new Image();
        image.height = 150;
        image.width = 300;
        image.title  = file.name;
        image.src    = this.result;
        image.setAttribute('loading', 'lazy');
        container.appendChild(image);
        preview.appendChild(container);
      });
      reader.readAsDataURL(file); 
    }
  }
  
  document.querySelector('#image').addEventListener("change", previewImages);