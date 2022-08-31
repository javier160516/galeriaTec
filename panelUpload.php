<?php
session_start();
require 'includes/app.php';
incluirTemplate('header');
$db = conectarDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (count(array_filter($_FILES['image']['name'])) > 0) {
        //Crear carpeta
        $imageFolder = './img/';
        if (!is_dir($imageFolder)) {
            mkdir($imageFolder);
        }
        $images = $_FILES['image'];
        $countFiles = count($images['tmp_name']);

        for ($i = 0; $i < $countFiles; $i++) {
            //Generar nombre unico
            $nameImage = md5(uniqid(rand(), true)) . '.jpg';

            //Mover a la carpeta imagenes
            move_uploaded_file($images['tmp_name'][$i], $imageFolder . $nameImage);

            //Insertar en la BD
            $query = "INSERT INTO files (file_name) VALUES ('${nameImage}')";

            $result = mysqli_query($db, $query);
            if ($result) {
                $_SESSION['success'] = 'success';
            } else {
                $_SESSION['error'] = 'error';
            }
        }
    } else {
        $_SESSION['error'] = 'error';
    }
}
?>

<div class="py-10">
    <?php if (isset($_SESSION['success']) && !empty($_SESSION['success'])) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Fotos subidas correctamente',
                text: 'Las fotos a subir, han sido subidas correctamente',
            }).then((result) => {
                if (result.isConfirmed) {
                    location = 'panelUpload.php';
                }
            })
        </script>
    <?php
        unset($_SESSION['success']);
    endif;
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Lo sentimos, hubo un error al subir las fotos',
            }).then((result) => {
                if (result.isConfirmed) {
                    location = 'panelUpload.php';
                }
            })
        </script>
    <?php
        unset($_SESSION['error']);
    endif; ?>

    <div class="w-11/12 bg-white shadow-lg mx-auto my-5 p-5 rounded-md">
        <h1 class="text-center text-2xl font-bold uppercase mb-5 mt-3">Subida de Fotos</h1>
        <form onsubmit="submit();" action="" method="POST" enctype="multipart/form-data" class="w-full mx-auto">
            <div id="dropArea" class="w-full flex justify-center items-center flex-col px-4 transition bg-white border-2 border-gray-300 border-dashed rounded-md appearance-none cursor-pointer hover:border-gray-500 focus:outline-none">
                <span id="dragText" class="text-xl font-bold text-gray-600 mb-8 mt-5">Arrasta para subir tus imagenes</span>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </div>
                <button id="btnUpload" type="button" class="border rounded-lg bg-blue-900 px-3 py-1 my-5 text-white hover:bg-blue-800 ">Selecciona tus archivos</button>
                <input type="file" name="image[]" id="image" class="hidden" multiple accept="image/jpeg, image/png">
            </div>

            <div class="w-full flex justify-end">
                <input onclick="uploadFile();" type="submit" value="Subir archivos" class="block bg-green-700 hover:bg-green-900 px-3 py-1 rounded-md text-white hover:cursor-pointer my-6 transition-all duration-200">
            </div>
        </form>
    </div>

    <!-- <div class="w-11/12 mx-auto bg-white shadow-lg my-5 p-5 rounded-md">
        <h2 class="text-center text-xl font-bold uppercase mb-5 mt-3">Fotos a subir</h2>
        <div id="gallery" class="mx-auto grid justify-center sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5  gap-2"></div>
    </div> -->
</div>

<script>
    document.title = 'SUBIR FOTOS TEC';
</script>
<script src="/public/js/uploadFiles.js"></script>
<?php
incluirTemplate('footer');
?>