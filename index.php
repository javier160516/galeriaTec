<?php
session_start();
require 'includes/app.php';
incluirTemplate('header');

$db = conectarDB();
$query = "SELECT * FROM degree";
$result = mysqli_query($db, $query);

$name = '';
$surnames = '';
$phone = '';
$email = '';
$degreeSelected = '';

$errors = [
    'name' => '',
    'surnames' => '',
    'phone' => '',
    'email' => '',
    'degree' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $surnames = $_POST['surnames'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $degreeSelected = $_POST['degree'];

    if (!$name) {
        $errors['name'] = 'El nombre es requerido';
    }
    if (!$surnames) {
        $errors['surnames'] = 'El apellido es requerido';
    }
    if (!$phone) {
        $errors['phone'] = 'El teléfono es requerido';
    }
    if (!$email) {
        $errors['email'] = 'El email es requerido';
    }
    if (!$degreeSelected) {
        $errors['degree'] = 'La carrera es necesaria es requerido';
    }

    if (empty(array_filter($errors))) {

        //Insertar los valores en la bd
        $query = "INSERT INTO users (name, surnames, phone, email, id_degree) VALUES ('${name}', '${surnames}', '${phone}', '${email}', '${degreeSelected}')";

        $result = mysqli_query($db, $query);
        if ($result) {
            $_SESSION['success'] = 'Registrado';
            $_SESSION['email'] = $email;
            $fullName = $name . " " . $surnames;
            $_SESSION['fullName'] = $fullName;
            $_SESSION['phone'] = $phone;
            require './sendEmail.php';
        } else {
            $_SESSION['error'] = 'Lo sentimos, hubo un error';
        }
    }
}
?>

<div class="h-screen flex items-center justify-center">
    <?php
    if (isset($_SESSION['error']) && !empty($_SESSION['error'])) { ?>
        <script type='text/javascript'>
            Swal.fire({
                icon: 'error',
                title: 'Hubo un error',
                text: 'Lo sentimos, hubo un error al enviar tu solicitud',
            }).then((result) => {
                if (result.isConfirmed) {
                    location = 'index.php';
                }
            })
        </script>

    <?php unset($_SESSION['success']);
    } ?>
    <div class="w-11/12 sm:w-10/12 md:w-6/12 lg:w-4/12 bg-white p-5 rounded-lg shadow-lg">
        <h1 class="text-center font-bold text-xl mb-5 text-gray-800">Formulario Para Revelar Fotos</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="name" class="font-bold block text-gray-700 mb-2">Nombre(s)</label>
                <input name="name" id="name" type="text" value="<?php echo $name ?>" placeholder="Nombre(s)..." class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-700 focus:ring-blue-700 block w-full rounded-md sm:text-sm focus:ring-1">
                <p class="block text-red-700 text-xs mt-1"><?php echo $errors['name'] ?></p>
            </div>
            <div class="mb-3">
                <label for="surnames" class="font-bold block text-gray-700 mb-2">Apellido(s)</label>
                <input name="surnames" id="surnames" type="text" value="<?php echo $surnames ?>" placeholder="Apellido(s)..." class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-700 focus:ring-blue-700 block w-full rounded-md sm:text-sm focus:ring-1">
                <p class="block text-red-700 text-xs mt-1"><?php echo $errors['surnames'] ?></p>
            </div>
            <div class="mb-3">
                <label for="phone" class="font-bold block text-gray-700 mb-2">Teléfono</label>
                <input type="tel" name="phone" id="phone" value="<?php echo $phone ?>" placeholder="Número Teléfonico..." class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-700 focus:ring-blue-700 block w-full rounded-md sm:text-sm focus:ring-1">
                <p class="block text-red-700 text-xs mt-1"><?php echo $errors['phone'] ?></p>

            </div>
            <div class="mb-3">
                <label for="email" class="font-bold block text-gray-700 mb-2">Correo</label>
                <input type="email" name="email" id="email" value="<?php echo $email ?>" placeholder="Correo Electrónico..." class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-700 focus:ring-blue-700 block w-full rounded-md sm:text-sm focus:ring-1">
                <p class="block text-red-700 text-xs mt-1"><?php echo $errors['email'] ?></p>

            </div>
            <div class="mb-5">
                <label for="degree" class="font-bold block text-gray-700 mb-2">Carrera</label>
                <select name="degree" id="degree" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-blue-700 focus:ring-blue-700 block w-full rounded-md sm:text-sm focus:ring-1">
                    <option value="">-- Elige una opción --</option>
                    <?php while ($degree = mysqli_fetch_assoc($result)) : ?>
                        <option <?php echo $degreeSelected === $degree['id'] ? 'selected' : ''; ?> value="<?php echo $degree['id'] ?>"><?php echo $degree['name'] ?></option>
                    <?php endwhile; ?>
                </select>
                <p class="block text-red-700 text-xs mt-1"><?php echo $errors['degree'] ?></p>

            </div>
            <div class="flex justify-end">
                <button type="submit" class="border bg-green-600 hover:bg-green-700 text-white rounded-md px-4 py-1 transition-all">Enviar</button>
            </div>
        </form>
    </div>

</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

<?php
incluirTemplate('footer');
?>