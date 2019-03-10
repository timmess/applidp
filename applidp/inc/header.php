<header>
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-md-4">
                <a href="index.php" class="btn btn-light" >Accueil</a>
            </div>
            <div class="col-md-4"><a href="http://localhost/projets/dpconsultant/" class="btn btn-light" >Retourner sur le site DPCFA</a></div>
            <div class="col-md-4 "><?php
                if (isset($_SESSION['activity'])){
                    ?>
                    <a class="btn btn-light" href="login.php?logout">Se déconnecter</a>
                    <?php
                }
                ?></div>
        </div>
    </div>
</header>