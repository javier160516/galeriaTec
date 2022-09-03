function download_files(files){
    event.preventDefault();
    const buttonDownload = document.querySelector('.download');
    // if(buttonDownload.classList.contains('deshabilitado')){
        setTimeout(() => {
            Swal.fire(
                'Lo sentimos',
                'Para poder descargar la foto, debes compartirlo y esperar 10 segundos',
                'error'
              )
              buttonDownload.classList.remove('deshabilitado')
        }, 10000);
        //   return;
    
    const images = JSON.parse(files);
    const arrayImages = [];
    images.forEach(image => {
        arrayImages.push(`https://creativolab.com.mx/gallery/img/${image}`);
    });
    
    downloadAll(arrayImages);
}

function downloadAll(urls){
    const link = document.createElement('a');

    link.setAttribute('download', `eventoTec`);
    link.style.display = 'none';

    document.body.appendChild(link);
    for(let i = 0; i<urls.length; i++){
        link.setAttribute('href', urls[i]);
        link.click();
    }
    document.body.removeChild(link);
}