<?php
require 'includes/app.php';
incluirTemplate('header');

$db = conectarDB();

$imagesPage = 20;
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
} else {
    $page = 1;
}
$query = 'SELECT * FROM files LIMIT ' . $imagesPage;
$result = mysqli_query($db, $query);
$numRows = $result->num_rows;
?>

<div class="py-5">
    <div class="shadow-md pb-4">
        <h1 class="text-2xl uppercase font-bold text-center ">Fotos del evento de nuevo ingreso</h1>
    </div>

    <div class="w-11/12 mx-auto bg-white shadow-lg my-5 p-5 rounded-md">
        <?php if($numRows <= 0) {?>
            <p class="text-2xl text-gray-900 uppercase my-4 text-center font-bold">No hay fotos para mostrar</p>
        <?php } else { ?>

        <?php } ?>
        <div class="mx-auto grid justify-center sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2">
            <?php while ($image = mysqli_fetch_assoc($result)) : ?>
                <a href="#" class="flex justify-center">
                    <img src="/img/<?php echo $image['file_name'] ?>" alt="imagen de prueba" loading="lazy">
                </a>
            <?php endwhile; ?>
        </div>
    </div>

    <?php
    $query = "SELECT COUNT(id) FROM files";
    $rs_result = mysqli_query($db, $query);
    $row = mysqli_fetch_row($rs_result);
    $total_records = $row[0];
    $total_pages = ceil($total_records / $imagesPage);
    $pagLink = "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
        $pagLink .= "<a href='gallery.php?page=" . $i . "'>" . $i . "</a>";
    };
    echo $pagLink . "</div>";
    ?>
</div>

<?php
incluirTemplate('footer');
?>