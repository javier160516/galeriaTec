function shareImagen(page) {
  FB.ui({
    method: 'share',
    href: `${page}`,
    hashtag: "#FamiliaTucán",
    redirect_uri: `${page}&compartir=true`,
  }, function (response) {
    if (response && !response.error_message) {
      window.close();
      const buttonDownload = document.querySelector('.download');
      buttonDownload.classList.remove('deshabilitado');
      Swal.fire(
        '¡Foto Compartida!',
        'La foto ha sido compartida exitosamente, ya puedes descargar tus fotos',
        'success'
      )

    } else {
      Swal.fire(
        'Lo sentimos',
        'Hubo un error, por favor, intente más tarde',
        'error'
      )
    }
  });
}