<?php

require('config.php');
require ('functions.php');

$page = 'index';
?>

<!doctype html>
<html lang="en">
<head>
    <?php

    include ('inc/head.php');

    ?>
</head>
<body>

<?php
require ('inc/header.php');
?>

<?php
if (isset($_SESSION['activity'])){
    echo "<p class='text-center'>Votre adresse mail : " . $_SESSION['activity']['email'] . "</p>";
    if (isset($_POST['idTreated'])) {

        $idTreated = $_POST['idTreated'];

        $sql_request = "UPDATE wp_cf_form_entry_values SET treatment = '1' WHERE entry_id = ' " . $idTreated . " ' ";

        if ($resultat = $mysqli->query($sql_request)){
            echo "<script>alert(\"Votre annonce a été traitée\")</script>";
            returnAllUntreatedDevis();
            returnAllTreatedDevis();
        }
    }else if (isset($_POST['idUntreated'])) {

        $idUntreated = $_POST['idUntreated'];

        $sql_request = "UPDATE wp_cf_form_entry_values SET treatment = '0' WHERE entry_id = ' " . $idUntreated . " ' ";

        if ($resultat = $mysqli->query($sql_request)){
            echo "<script>alert(\"Votre annonce a été modifiée\")</script>";
            returnAllUntreatedDevis();
            returnAllTreatedDevis();
        }
    }else{
        returnAllUntreatedDevis();
        returnAllTreatedDevis();
    }

}



?>

<?php
require ('inc/footer.php');
?>

</body>
</html>