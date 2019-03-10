<?php
$page = 'login';
include('config.php');

global $mysqli;
$messageLogin = 'test';
if (isset($_POST['login-submit'])){ //si j'appuie sur le btn
    echo "1";
    if( isset($_POST['login-email']  ) && isset($_POST['login-password']  ) ) { //que les champs email et mdp sont remplis
        echo "2";
        $form_email = $_POST['login-email'];
        $form_password = $_POST['login-password']; //stockage des inputs

        $query = 'SELECT * FROM users WHERE email = "' . $form_email . '"  LIMIT 1 ';

        if ($resultat = $mysqli->query($query)){
            echo "3";
            while ($result = $resultat->fetch_object()) {
                echo "4";
                $result_id = $result->id;
                $result_email = $result->email;
                $result_password = $result->password;

                if ($form_password === $result_password && $form_email === $result_email) {
                    echo "5";
                    $_SESSION['activity']['id'] = $result_id;
                    $_SESSION['activity']['email'] = $result_email;
                    header('Location: index.php');
                    die();
                }else if ($form_password != $result_password){
                    $messageLogin = "Mot de passe incorrect.";
                }else if ($form_email != $result_email){// Ne fonctionne pas
                    $messageLogin = "Identifiant incorrect.";
                }
            }
        }
    }
}else if( isset( $_GET['logout'] ) ){
    echo "5";
    $_SESSION['activity'] = array();
    session_destroy();
    header('Location: login.php?logoutok');
    die();
}else if(isset($_GET['logoutok'])){
    $messageLogin = 'Vous vous êtes bien déconnecté.';
}else if(isset($_GET['treatmentok'])){
    header('location: ');
}
else{
    $messageLogin = 'Merci de vous connecter.';
}

?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<h2><?php echo $messageLogin; ?></h2>

<form method="post">
    <div class="col-md-4">
        <form method="POST">
            <div class="form-group">
                <label for="loginEmail">Votre Email : </label>
                <input type="email" class="form-control" id="login-email" name="login-email" placeholder="Entrez votre mail">
            </div>
            <div class="form-group">
                <label for="loginPassword">Votre mot de passe : </label>
                <input type="password" class="form-control" id="login-password" name="login-password" placeholder="Password">
            </div>
            <button type="submit" name="login-submit" class="btn btn-light">Se connecter</button>
        </form>
    </div>
</form>

</body>
</html>

