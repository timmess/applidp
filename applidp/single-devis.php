<?php
/**
 * Created by PhpStorm.
 * User: Messa
 * Date: 07/03/2019
 * Time: 13:25
 */

$page = 'single-devis';
include ('config.php');
include ('functions.php');


?>

<!doctype html>
<html lang=fr>
<head>
    <?php

    include ('inc/head.php');

    ?>
</head>
<body>

        <?php
        include ('inc/header.php');
        ?>

        <section id="body">
        <?php
        returnSingleDevis();
        ?>
        </section>

        <?php
        include ('inc/footer.php');
        ?>

</body>
</html>
