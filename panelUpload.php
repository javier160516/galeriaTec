<?php
session_start();
require 'includes/app.php';
incluirTemplate('header');
?>
    <div class="py-10">
        <div class="w-11/12 bg-white shadow-lg mx-auto my-5 p-5 rounded-md">
            <h1 class="text-center text-2xl font-bold uppercase mb-5 mt-3">Subida de Fotos</h1>
            <form action="" id="form" method="POST" enctype="multipart/form-data" class="w-full mx-auto">
                <div id="dropArea" class="w-full flex justify-center items-center flex-col px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-500 focus:outline-none">
                <span id="dragText" class="text-xl font-bold text-gray-600 mb-8 mt-5">
                    Arrasta para subir tus imagenes
                </span>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                    </div>
                    <button id="btnUpload" type="button" class="border rounded-lg bg-blue-900 px-3 py-1 my-5 text-white hover:bg-blue-800 ">
                        Selecciona tus archivos
                    </button>
                    <input type="file" name="image" id="image" class="hidden" multiple accept="image/jpeg, image/png">
                </div>
                <br>
                <div id="progress" class="w-full pt-6">

                </div>
                <div class="w-full flex justify-end" id="submit">
                    <input type="submit" value="Subir archivos" class="block bg-green-700 hover:bg-green-900 px-3 py-1 rounded-md text-white hover:cursor-pointer my-6 transition-all duration-200 font-bold">
                </div>
            </form>
        </div>
    </div>
    <script src="public/js/uploadFiles.js"></script>
    <script>
        const form = document.getElementById('form');
        form.addEventListener('submit', uploadFile);

        function uploadFile(event) {
            event.preventDefault();
            console.clear();

            let files = document.querySelector('#image').files;

            if (!files[0]) {
                return Swal.fire({
                    title: 'Error de imágenes',
                    text: `No has seleccionado ninguna imagen`,
                    icon: 'error',
                    showConfirmButton: 'true',
                });
            }

            let filesLength = Object.entries(files).length;

            let currentFile = 0;

            for (const value of Object.entries(files)) {

                if (!/\.(jpe?g|png|gif)$/i.test(value[1].name)) {
                    return Swal.fire({
                        title: 'Archivo no válido',
                        text: `El archivo ${value[1].name} no es valido`,
                        icon: 'error',
                        showConfirmButton: 'true',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location = '/panelUpload.php';
                        }
                    });
                }

                const key = Object.entries(files).indexOf(value);
                let formData = new FormData();
                formData.append('image', value[1]);

                var http = new XMLHttpRequest();
                var url = 'uploadImage.php';
                http.open('POST', url, true);

                http.onreadystatechange = function() {
                    if (this.readyState === 4) {
                        const data = JSON.parse(this.responseText);
                        console.log(data);
                        currentFile++;
                        document.getElementById('progress').innerHTML =
                            `<p>Subiendo: ${value[1].name}</p>
                        <p>Imágenes subidas: ${currentFile}/${filesLength}</p>
                        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700" style="height: 22px;">
                            <div class="bg-blue-900 rounded-full z-50" style="width: ${Math.floor(100/filesLength) * currentFile}%; height: 100%"></div>
                        </div>`;

                        if (currentFile === filesLength) {
                            document.getElementById('progress').innerHTML =
                                `<p>All images were successfully uploaded</p>`;
                            // Reset all things;
                            form.reset();
                        }
                    }
                }
                http.send(formData);
            }
        }
    </script>
<?php
incluirTemplate('footer');
?>