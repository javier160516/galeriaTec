function download_files(files) {
    event.preventDefault();
    const images = JSON.parse(files);
    const arrayImages = [];
    images.forEach(image => {
        arrayImages.push(`https://creativolab.com.mx/gallery/img/${image}`);
    });

    downloadAll(arrayImages);
}

function downloadAll(urls) {
    const link = document.createElement('a');

    link.setAttribute('download', `eventoTec`);
    link.style.display = 'none';

    document.body.appendChild(link);
    for (let i = 0; i < urls.length; i++) {
        link.setAttribute('href', urls[i]);
        link.click();
    }
    document.body.removeChild(link);
}