<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_SESSION['email']) && isset($_SESSION['fullName'])) {
    enviarEmail($_SESSION['email'], $_SESSION['fullName']);
} else {
    header('Location: /gallery/');
}
function enviarEmail(string $email, string $fullName)
{
    try {
        //Server settings
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp-mail.outlook.com';
        $phpmailer->SMTPAuth = true;
        // $phpmailer->SMTPSecure= ENCRYPTION_STARTTLS; //llave del host
        $phpmailer->Port = 587; //puerto del host
        $phpmailer->Username = 'cyd@cancun.tecnm.mx';
        $phpmailer->Password = 'ITCun2022mx1';

        //Recipients
        $phpmailer->setFrom('cyd@cancun.tecnm.mx', 'Comunicación y Difusión IT Cancún');
        $phpmailer->addAddress("${email}", 'Alumno del IT Cancún');

        //Content
        $phpmailer->isHTML(true);
        $phpmailer->CharSet = 'UTF-8';
        $phpmailer->Subject = "Enlace para ver tus fotos";
        $phpmailer->Body    = "
        <head>
            <style>
                .container {
                    width: 95%;
                    margin: 0 auto;
                    padding: 20px 10px;
                    background-color: #F5F5F5;
                    border-radius: 10px;
                    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
                }
                .titulo{
                    text-align: center;
                    font-weight: bold;
                    font-size: 18px;
                    text-transform: uppercase;
                }
                .descripcion{
                    text-align: center;
                }
                .container-btn {
                    width: 100%;
                    text-align: center;
                    padding: 15px 0
                }
                .btn{
                    text-decoration: none;
                    color: white;
                    background-color: #4C83EE;
                    border: 1px solid #4C83EE;
                    padding: 8px 15px;
                    border-radius: 10px;
                    text-align: center;
                    transition: all 300ms;
                }
                .btn:hover {
                    background-color: #5D93FC;
                }
            </style>
        </head>
        <body>
            <div class='container'>
                <div style='width: 100%; display: flex; justify-content: space-between;'>
                    <div style='width: 48%'>
                        <img src='https://creativolab.com.mx/gallery/public/img/logo.png' height='50' style='left: 0'/>
                    </div>
                    <div style='width: 48%; text-align: right;'>
                        <img src='https://creativolab.com.mx/gallery/public/img/logo-itcancun.png' height='50' style='right: 0'/>
                    </div>
                </div>
                <p class='titulo'>Bienvenid@ Tucán</p>
                <p>Nos alegra que formes parte de esta gran casa de estudios</p>
                <p class='descripcion'>Aquí podrás encontrar el enlacé para poder ver tus fotos del evento</p>
                <div class='container-btn'>
                    <a href='https://creativolab.com.mx/gallery/gallery.php' class='btn' style='color: white;'>Entrar al enlace</a>
                </div>
            </div>
        </body>
        ";

        $phpmailer->send();
        if (isset($_SESSION['success']) && !empty($_SESSION['success'])) {
?>
            <script type='text/javascript'>
                const phone = <?php echo $_SESSION['phone'] ?>;
                Swal.fire({
                    title: 'Solicitud Enviada Correctamente',
                    text: 'Se ha enviado un email para que puedas ver tus fotos del evento',
                    icon: 'success',
                    showDenyButton: true,
                    confirmButtonText: '<p>Enviar <i class="fa-brands fa-whatsapp" style="font-size: 18px;"></i></p>',
                    confirmButtonColor: '#22C462',
                    denyButtonText: `Ok`,
                    denyButtonColor: '#1A9EE8',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        const message = 'Hola, Te mandamos el siguiente link para que puedas visualizar tus fotos del evento 😁. https://creativolab.com.mx/gallery/gallery.php'
                        const url = `https://api.whatsapp.com/send?phone=521${phone}&text=${message}`;
                        const win = window.open(url, '_blank')
                        location = 'http://creativolab.com.mx/gallery/';
                    } else if (result.isDenied) {
                        location = 'http://creativolab.com.mx/gallery/';
                    }
                })
            </script>
        <?php
            unset($_SESSION['success']);
            unset($_SESSION['email']);
            unset($_SESSION['fullName']);
            unset($_SESSION['phone']);
        }
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$phpmailer->ErrorInfo}"; 
        ?>

        <script type='text/javascript'>
            Swal.fire({
                icon: 'error',
                title: 'Ooopsss...',
                text: 'Hubo un error, por favor, intentelo más tarde',
            }).then((result) => {
                if (result.isConfirmed) {
                    location = 'index.php';
                }
            })
        </script>
<?php }
}
