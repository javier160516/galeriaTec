const form = document.querySelector('#formImages');

form.addEventListener('submit', async function(e){
    e.preventDefault();
    const data = Object.fromEntries(
        new FormData(e.target)
    )
    
    const photos = Object.keys(data);
    console.log(photos.length);
    if(photos.length <= 0){
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: 'Lo sentimos, no ha seleccionado ninguna imagen',
        }).then((result) => {
            if (result.isConfirmed) {
              location = '/gllery/gallery.php';
            }
        })
    }else{
        $(form).submit();
    }
});