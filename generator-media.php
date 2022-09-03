<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (count($_GET) <= 0) {
        header('location: /gallery/gallery.php');
        exit;
    }
    $url = $_SERVER['REQUEST_URI'];
    $images = $_GET;
    $imageMeta = key($images);
    $nameImage = substr($imageMeta, 0, -4);

    //Obtener keys

    $arrayImages = [];
    foreach ($images as $key => $value) {
        $nameImage = substr($key, 0, -4);
        array_push($arrayImages, $nameImage . '.jpg');
    }
?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>EVENTO IT CANCÚN</title>
        <meta property="og:url" content="<?php echo 'https://creativolab.com.mx' . $url ?>" />
        <meta property="og:title" content="Evento para los de nuevo ingreso del IT CANCÚN" />
        <meta property="og:description" content="Le damos la bienvenida a los estudiantes de nuevo ingreso del IT Cancún y les deseamos mucho éxito" />
        <meta property="og:image" itemprop="image" content="<?php echo 'https://creativolab.com.mx/gallery/img/' . $nameImage . '.jpg' ?>" />
        <link rel="stylesheet" href="./public/css/app.css">
        <link rel="stylesheet" href="./public/css/slider.css">
        <script src="public/js/sweetAlert.js"></script>
    </head>

    <body>
        <div class="container-principal">
            <header style="width: 100%; display:flex; justify-content: space-between; margin-top: 15px;">
                <a href="/gallery/gallery.php">
                    <img src="./public/img/logo.png" class="img-fluid" alt="Logo TECNM" style="height: 100px;">
                </a>
                <a href="/gallery/gallery.php">
                    <img src="./public/img/logo-itcancun.png" class="img-fluid" alt="Logo TECNM" style="height: 100px;">
                </a>
            </header>
            <h1 class="text-2xl uppercase">Tus fotos seleccionadas</h1>
            <section id="container-slider">
                <a href="javascript: fntExecuteSlide('prev');" class="arrowPrev"><i class="fas fa-chevron-circle-left"></i></a>
                <a href="javascript: fntExecuteSlide('next');" class="arrowNext"><i class="fas fa-chevron-circle-right"></i></a>

                <ul class="listslider">
                    <div>
                        <button onclick="shareImagen('<?php echo 'creativolab.com.mx' . $_SERVER['REQUEST_URI'] ?>');" type="button" class="facebook"><i class="fa-brands fa-facebook"></i></button>
                    </div>
                    <div>
                        <button class="download deshabilitado" onclick='download_files(`<?php echo json_encode($arrayImages); ?>`);'>
                            <i class="fa-solid fa-circle-down"></i>
                        </button>
                    </div>
                </ul>
                <ul id="slider">
                    <?php foreach ($_GET as $key => $value) :
                        $nameImage = substr($key, 0, -4);
                    ?>
                        <li style="background-image: url('<?php echo './img/' . $nameImage . '.jpg' ?>'); z-index:0; opacity: 1; background-size: cover;"></li>
                    <?php endforeach; ?>
                </ul>
            </section>
            <div class="mx-auto bg-green-700 mt-5 rounded-lg py-2" style="width: 80%">
                <p class="text-white text-center">No olvides que puedes compartir tus fotos en facebook.</p>
            </div>
            <footer class="w-10/12 mx-auto bottom-0 px-3 pb-4 mt-5">
                <div class="text-center">
                    <p class="m-0">Instituto Tecnológico de Cancún - Algunos derechos reservados &copy; <?php echo date('Y') ?></p>
                    <p class="m-0">Av. Kabah, Km. 3 Cancún Quintana Roo México C.P. 77515, Col. Centro</p>
                    <p class="m-0"> Teléfono: 01 (998) 8-80-74-32</p>
                    <a href="https://www.cancun.tecnm.mx" target="_blank" class="text-blue-500">Política de privacidad y manejo de datos personales</a>
                </div>
            </footer>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
        <div id="fb-root"></div>
        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId: '767538411061963',
                    status: true,
                    cookie: true,
                    xfbml: true
                });
            };
            (function() {
                var e = document.createElement('script');
                e.async = true;
                e.src = document.location.protocol +
                    '//connect.facebook.net/es_ES/all.js';
                document.getElementById('fb-root').appendChild(e);
            }());
            document.oncontextmenu = function(){return false;}
        </script>
        <script src="./public/js/download.js"></script>
        <script src="./public/js/shareImage.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script defer src="./public/js/slider.js"></script>
    </body>

    </html>

<?php } else {
    header('location: /gallery.php');
}

?>