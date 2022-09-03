const viewImage = (image) => {
    const buttonsImage = document.createElement('DIV');
    buttonsImage.classList.add('py-3', 'flex', 'justify-center', 'items-center', 'gap-3');

    buttonsImage.innerHTML = `
        <button onclick="Publicar();" class="bg-blue-600 text-white p-3 hover:bg-blue-700 transition-all rounded-full"><i class="fa-solid fa-share"></i></button>
        <a href="gallery/img/${image}" download="${image.substring(0, image.length - 4)}">
        <button  class="bg-green-600 text-white p-3 hover:bg-green-700 transition-all rounded-full"><i class="fa-solid fa-cloud-arrow-down"></i></button>
        </a>
    `;
    //Creacion de imagen
    const overlay = document.createElement('DIV');
    overlay.classList.add('overlay');
    overlay.innerHTML = `
        <div class="relative w-10/12 lg:w-8/12 xl:w-6/12  mx-auto h-4/6">
            <img loading="lazy" src="/gallery/img/${image}" alt="Imagen Evento"/>
            <button class="btn-close" onclick="closeModal();">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="py-3 flex justify-center items-center gap-3">
                    <input value="${image}" hidden/>
                    <button type="submit" onClick="logInWithFacebook()" class="bg-blue-600 text-white p-3 hover:bg-blue-700 transition-all rounded-full"><i class="fa-solid fa-share"></i></button>
                <a href="gallery/img/${image}" download="${image.substring(0, image.length - 4)}">
                    <button  class="bg-green-600 text-white p-3 hover:bg-green-700 transition-all rounded-full"><i class="fa-solid fa-cloud-arrow-down"></i></button>
                </a>
            </div>
        </div>
    `;

    const body = document.querySelector('body');
    body.appendChild(overlay);
    body.classList.add('fijar-body');
}

function closeModal() {
    const body = document.querySelector('body');
    const overlay = document.querySelector('.overlay');
    body.classList.remove('fijar-body');
    overlay.remove();
}