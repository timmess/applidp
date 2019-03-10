<?php
    session_start(); // Ouverture de $_SESSION
    if( !isset($_SESSION['activity']) && $page != 'login') {
        header('Location: login.php');
    }
    $sql_host = 'localhost';
    $sql_admin = 'root';
    $sql_password = '';
    $sql_bdd_name = 'dpconsultant';

    $db= mysqli_connect($sql_host, $sql_admin, $sql_password, $sql_bdd_name) or die("Impossible de se connecter au serveur de la BDD.");
    $mysqli = new mysqli($sql_host, $sql_admin, $sql_password, $sql_bdd_name);
    $mysqli->select_db($sql_bdd_name);
    $mysqli->set_charset('utf8');








?>