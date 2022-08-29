<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if (isset($_SESSION['email']) && isset($_SESSION['fullName'])) {
    enviarEmail($_SESSION['email'], $_SESSION['fullName']);
}else{
    header('Location: /');
}
function enviarEmail(string $email, string $fullName)
{
    try {
        //Server settings
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '454d382f4bc5ad';
        $phpmailer->Password = 'a628d65e85da7b';

        //Recipients
        $phpmailer->setFrom('javiercambranis23@gmail.com.com', 'Mailer');
        $phpmailer->addAddress("${email}", 'Mailer');

        //Content
        $phpmailer->isHTML(true);
        $phpmailer->Subject = "Super hola mundo ya con la funcion";
        $phpmailer->Body    = '<h1>Bienvenido, te mando el link de la página</h1>';

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
                        const message = 'Hola, Te mandamos el siguiente link para que puedas visualizar tus fotos del evento 😁. localhost:3000/gallery.php'
                        const url = `https://api.whatsapp.com/send?phone=521${phone}&text=${message}`;
                        const win = window.open(url, '_blank')
                        location = '/';
                    } else if (result.isDenied) {
                        location = '/';
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
