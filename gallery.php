<?php
require 'includes/app.php';
incluirTemplate('header');

$db = conectarDB();

$imagesPage = 10;
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
}
$start = ($page - 1) * $imagesPage;
$query = "SELECT * FROM files LIMIT ${start}, ${imagesPage}";
$result = mysqli_query($db, $query);
$numRows = $result->num_rows;
?>

<div class="py-5">
    <div class="shadow-md pb-4">
        <h1 class="text-2xl uppercase font-bold text-center ">Fotos del evento de nuevo ingreso</h1>
    </div>

    <div class="w-11/12 mx-auto bg-white shadow-lg my-5 p-5 rounded-md">
        <?php if ($numRows <= 0) { ?>
            <p class="text-2xl text-gray-900 uppercase my-4 text-center font-bold">No hay fotos para mostrar</p>
        <?php } else { ?>
            <div class="mx-auto grid justify-center sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2">
                <?php while ($image = mysqli_fetch_assoc($result)) : ?>
                    <img src="img/<?php echo $image['file_name']; ?>" alt="imagen de prueba" style="cursor: pointer" loading="lazy" onclick="viewImage(`<?php echo $image['file_name']; ?>`)">
                <?php endwhile; ?>
            </div>
        <?php } ?>
    </div>

    <?php
    $query = "SELECT COUNT(id) FROM files";
    $rs_result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($rs_result);
    $total_records = $row[0];
    $total_pages = ceil($total_records / $imagesPage);
    ?>

    <div class='w-11/12 mx-auto justify-center items-center text-center'>
        <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
            <a class="mx-2 px-2 py-1 border border-blue-800 rounded-md hover:bg-blue-800 hover:text-white transition-all duration-300 <?php echo $page == $i ? 'bg-blue-800 text-white font-bold' : 'text-blue-600' ?>" href="gallery.php?page=<?php echo $i ?>"><?php echo $i ?></a>
        <?php }; ?>
    </div>
    <div id="fb-root"></div>
</div>

<script src="public/js/gallery.js"></script>
<script src="public/js/shareImage.js"></script>
<?php
incluirTemplate('footer');
?>