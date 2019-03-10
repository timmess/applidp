<?php

function returnAllUntreatedDevis()
{
    global $mysqli;
    ?>
    <section class="container text-center" id="allDevis">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <h2 class="text-center">Vos devis non traités</h2>
                        </tr>
                        <tr>
                            <th> </th>
                            <th><h4>Nom et prénom</h4></th>
                            <th><h4>Numéro de téléphone</h4></th>
                            <th><h4>Somme du devis hors taxe</h4></th>
                            <th><h4>Somme du devis taxe comprises</h4></th>
                        </tr>
                    </thead>
                        <?php
                            $sql_request = "SELECT * FROM wp_cf_form_entry_values WHERE slug= '__nom' OR slug='__numro_de_tlphone' OR slug= 'somme_du_devis_hors_taxes' OR slug= 'somme_du_devis_avec_taxes_' ORDER BY entry_id DESC";
                            if ($sql_devis = mysqli_query($mysqli, $sql_request)) {

                                while ($row = mysqli_fetch_object($sql_devis)) {
                                    if ($row->treatment == '0'){
                                        $idDevis = $row->entry_id;
                                        if ($row->slug == '__nom') {
                        ?>
                            <tbody>
                                <div class="col-md-4">
                                    <td><a href="single-devis.php?id=<?php echo $idDevis; ?>"><h5>Voir</h5></a></td>
                                    <?php
                                        echo "<td>" . $row->value . "</td> ";
                                        }
                                        if ($row->slug == '__numro_de_tlphone') {
                                            echo "<td>" . $row->value . "</td>";
                                        }
                                        if ($row->slug == 'somme_du_devis_hors_taxes') {
                                            echo "<td>" . $row->value . " euros</td>";
                                        }
                                        if ($row->slug == 'somme_du_devis_avec_taxes_') {
                                            echo "<td>" . $row->value . " euros</td> </div> ";
                                        }
                                    } // if treatment = 0
                                    } // while
                                    } // if ($sql_devis = mysqli_query( $mysqli, $sql_request))
                                    ?>
                                </div> <!-- col-md-4 -->
                            </tbody>
                </table>
            </div> <!-- col md 12 -->
        </div><!-- row -->
    </section><!-- container -->
<?php
} // function returnAllUntreatedDevis()

function returnAllTreatedDevis()
{
    global $mysqli;
    ?>
    <section class="container text-center" id="allTreatedDevis">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <h2 class="text-center">Vos devis traités</h2>
                        </tr>
                        <tr>
                            <th> </th>
                            <th><h4>Nom et Prénom</h4></th>
                            <th><h4>Numéro de téléphone</h4></th>
                            <th><h4>Somme du devis hors taxe</h4></th>
                            <th><h4>Somme du devis taxe comprises</h4></th>
                        </tr>
                    </thead>
                        <?php
                            $sql_request = "SELECT * FROM wp_cf_form_entry_values WHERE slug= '__nom' OR slug='__numro_de_tlphone' OR slug= 'somme_du_devis_hors_taxes' OR slug= 'somme_du_devis_avec_taxes_' ORDER BY entry_id DESC";
                            if ($sql_devis = mysqli_query($mysqli, $sql_request)) {

                                while ($row = mysqli_fetch_object($sql_devis)) {
                                if ($row->treatment == '1'){
                                $idDevis = $row->entry_id;
                                if ($row->slug == '__nom') {
                        ?>
                            <tbody>
                                <div class="col-md-4">
                                    <td><a href="single-devis.php?id=<?php echo $idDevis; ?>"><h5>Voir</h5></a></td>
                                    <?php
                                        echo "<td>" . $row->value . "</td> ";
                                        }
                                        if ($row->slug == '__numro_de_tlphone') {
                                            echo "<td>" . $row->value . "</td>";
                                        }
                                        if ($row->slug == 'somme_du_devis_hors_taxes') {
                                            echo "<td>" . $row->value . " euros</td>";
                                        }
                                        if ($row->slug == 'somme_du_devis_avec_taxes_') {
                                            echo "<td>" . $row->value . " euros</td> </div> ";
                                        }
                                    } // while
                                    }
                                    } // if ($sql_devis = mysqli_query( $mysqli, $sql_request))
                                    ?>
                                </div> <!-- col-md-4 -->
                            </tbody>
                </table>
            </div> <!-- col md 12 -->
        </div><!-- row -->
    </section><!-- container -->
<?php
} // function returnAlltreatedDevis()






function returnSingleDevis()
{

global $mysqli;

$id = $_GET['id'];
$sql_request = "SELECT * FROM wp_cf_form_entry_values WHERE entry_id = ' " . $id . " ' ";
$tableau = [];
global $treated;

    if ($sql_devis = mysqli_query($mysqli, $sql_request)) {

        while ($row = mysqli_fetch_object($sql_devis)) {
//           array_push($tableau, $row->value);
            $tableau[$row->slug] = $row->value;
            $treated = $row->treatment;
        }//while
    }//if
    displayTab($tableau);
}//function returnSingleDevis()

function displayTab($tableau){
    $id = $_GET['id'];
    global $treated;



    ?>

    <div class="container" id="singleDevis">
        <div class="col-md-12" >
            <table>
                <?php
                    if (isset($tableau["__nom"])){
                        echo "<div class='container' id='nomSingleDevis' style='margin-bottom: 100px'><div class='col-md-12'><h2> Nom : " . $tableau["__nom"] . "</h2></div></div>";
                    }
                    // Certification amiante
                    if (isset($tableau['__types_de_prestations_souhaites__plusieurs_choix_possibles_.opt1127550'])){
                        echo "<h3 style='margin-bottom: 50px; margin-top: 100px;'>" . $tableau["__types_de_prestations_souhaites__plusieurs_choix_possibles_.opt1127550"] . "</h3>";
                    }
                    // Prestations amiante
                    if (isset($tableau["__prestations_pour_une_certification_amiante"])){
                        echo "<p>" . $tableau["__prestations_pour_une_certification_amiante"] . "</p>";
                    }
                    if (isset($tableau["__forfait_personnalis_pour_une_certification_amiante__plusieurs_choix_possibles_.opt1781940"])){
                        echo "<p>" . $tableau["__forfait_personnalis_pour_une_certification_amiante__plusieurs_choix_possibles_.opt1781940"] . "</p>";
                    }
                    if (isset($tableau["__forfait_personnalis_pour_une_certification_amiante__plusieurs_choix_possibles_.opt1562686"])){
                        echo "<p>" . $tableau["__forfait_personnalis_pour_une_certification_amiante__plusieurs_choix_possibles_.opt1562686"] . "</p>";
                    }
                    if (isset($tableau["__forfait_personnalis_pour_une_certification_amiante__plusieurs_choix_possibles_.opt1992375"])){
                        echo "<p>" . $tableau["__forfait_personnalis_pour_une_certification_amiante__plusieurs_choix_possibles_.opt1992375"] . "</p>";
                    }
                    if (isset($tableau["__forfait_personnalis_pour_une_certification_amiante__plusieurs_choix_possibles_.opt1623564"])){
                        echo "<p>" . $tableau["__forfait_personnalis_pour_une_certification_amiante__plusieurs_choix_possibles_.opt1623564"] . "</p>";
                    }
                    if (isset($tableau["__forfait_personnalis_pour_une_certification_amiante__plusieurs_choix_possibles_.opt1636090"])){
                        echo "<p>" . $tableau["__forfait_personnalis_pour_une_certification_amiante__plusieurs_choix_possibles_.opt1636090"] . "</p>";
                    }
                    if (isset($tableau["__forfait_personnalis_pour_une_certification_amiante__plusieurs_choix_possibles_.opt1815403"])){
                        echo "<p>" . $tableau["__forfait_personnalis_pour_une_certification_amiante__plusieurs_choix_possibles_.opt1815403"] . "</p>";
                    }


                    //Chantier de désamiantage
                    if (isset($tableau['__types_de_prestations_souhaites__plusieurs_choix_possibles_.opt1476033'])){
                        echo "<h3 style='margin-bottom: 50px; margin-top: 100px;'>" . $tableau["__types_de_prestations_souhaites__plusieurs_choix_possibles_.opt1476033"] . "</h3>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1856198"])){
                        echo "<p>" . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1856198"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1124280"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1124280"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1357928"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1357928"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1134794"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1134794"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1152014"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1152014"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1527615"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1527615"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1847570"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1847570"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1652056"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1652056"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1753011"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1753011"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1384012"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1384012"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1543564"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1543564"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1194867"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1194867"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1191159"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1191159"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1771131"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1771131"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1058017"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1058017"] . "</p>";
                    }
                    if (isset($tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1067756"])){
                        echo "<p> " . $tableau["__prestations_pour_le_chantier_de_dsamiantage__plusieurs_choix_possibles_.opt1067756"] . "</p>";
                    }


                    //Assistance sur les interventions
                    if (isset($tableau['__types_de_prestations_souhaites__plusieurs_choix_possibles_.opt1974034'])){
                        echo "<h3 style='margin-bottom: 50px; margin-top: 100px;'>" . $tableau["__types_de_prestations_souhaites__plusieurs_choix_possibles_.opt1974034"] . "</h3>";
                    }
                    if (isset($tableau['__prestations_pour_lassistance_sur_les_interventions__plusieurs_choix_possibles_.opt1788865'])){
                        echo "<p>" . $tableau["__prestations_pour_lassistance_sur_les_interventions__plusieurs_choix_possibles_.opt1788865"] . "</p>";
                    }
                    if (isset($tableau['__prestations_pour_lassistance_sur_les_interventions__plusieurs_choix_possibles_.opt1493866'])){
                        echo "<p>" . $tableau["__prestations_pour_lassistance_sur_les_interventions__plusieurs_choix_possibles_.opt1493866"] . "</p>";
                    }
                    if (isset($tableau['__prestations_pour_lassistance_sur_les_interventions__plusieurs_choix_possibles_.opt1302101'])){
                        echo "<p>" . $tableau["__prestations_pour_lassistance_sur_les_interventions__plusieurs_choix_possibles_.opt1302101"] . "</p>";
                    }
                    if (isset($tableau['__prestations_pour_lassistance_sur_les_interventions__plusieurs_choix_possibles_.opt1517816'])){
                        echo "<p>" . $tableau["__prestations_pour_lassistance_sur_les_interventions__plusieurs_choix_possibles_.opt1517816"] . "</p>";
                    }


                    //Formations
                    if (isset($tableau['__types_de_prestations_souhaites__plusieurs_choix_possibles_.opt1893847'])) {
                    ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <?php
                                    if (isset($tableau['__types_de_prestations_souhaites__plusieurs_choix_possibles_.opt1893847'])) {
                                        echo "<th><h3'>" . $tableau["__types_de_prestations_souhaites__plusieurs_choix_possibles_.opt1893847"] . "</h3></th>";
                                    }
                                    ?>
                                    <th>Nombre de stagiaire(s)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                        <?php
                                        if (isset($tableau['__prestations_pour_les_formations__la_prvention__choix_unique_1'])) {
                                            echo "<th scope=\"row\">" . $tableau["__prestations_pour_les_formations__la_prvention__choix_unique_1"] . "</th>";
                                        }

                                        if (isset($tableau['__nombre_de_stagiaire'])) {
                                        echo "<td>" . $tableau["__nombre_de_stagiaire"] . "</td>";
                                        }
                                        ?>
                                </tr>
                                <tr>
                                        <?php
                                        if (isset($tableau['__prestations_pour_les_formations__la_prvention__choix_unique_2'])) {
                                            echo "<th scope=\"row\">" . $tableau["__prestations_pour_les_formations__la_prvention__choix_unique_2"] . "</th>";
                                        }

                                        if (isset($tableau['__nombre_de_stagiaire2'])) {
                                            echo "<td>" . $tableau["__nombre_de_stagiaire2"] . "</td>";
                                        }
                                        ?>
                                </tr>
                                <tr>
                                        <?php
                                        if (isset($tableau['__prestations_pour_les_formations__la_prvention__choix_unique_3'])) {
                                            echo "<th scope=\"row\">" . $tableau["__prestations_pour_les_formations__la_prvention__choix_unique_3"] . "</th>";
                                        }

                                        if (isset($tableau['__nombre_de_stagiaire3'])) {
                                            echo "<td>" . $tableau["__nombre_de_stagiaire3"] . "</td>";
                                        }
                                        ?>
                                </tr>
                                <tr>
                                    <?php
                                    if (isset($tableau['__prestations_pour_les_formations__la_prvention__choix_unique_4'])) {
                                        echo "<th scope=\"row\">" . $tableau["__prestations_pour_les_formations__la_prvention__choix_unique_4"] . "</th>";
                                    }

                                    if (isset($tableau['__nombre_de_stagiaire4'])) {
                                        echo "<td>" . $tableau["__nombre_de_stagiaire4"] . "</td>";
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <?php
                                    if (isset($tableau['__prestations_pour_les_formations__la_prvention__choix_unique_5'])) {
                                        echo "<th scope=\"row\">" . $tableau["__prestations_pour_les_formations__la_prvention__choix_unique_5"] . "</th>";
                                    }

                                    if (isset($tableau['__nombre_de_stagiaire5'])) {
                                        echo "<td>" . $tableau["__nombre_de_stagiaire5"] . "</td>";
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <?php
                                    if (isset($tableau['__prestations_pour_les_formations__la_prvention__choix_unique_6'])) {
                                        echo "<th scope=\"row\">" . $tableau["__prestations_pour_les_formations__la_prvention__choix_unique_6"] . "</th>";
                                    }

                                    if (isset($tableau['__nombre_de_stagiaire6'])) {
                                        echo "<td>" . $tableau["__nombre_de_stagiaire6"] . "</td>";
                                    }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                <?php
                }
                ?>


        <!--        Coordonnées-->
            <?php
               if (isset($tableau['__votre_adresse_postale_ou_celle_de_votre_entreprise'])){
                    echo "<p>Adresse : " . $tableau["__votre_adresse_postale_ou_celle_de_votre_entreprise"] . "</p>";
               }
               if (isset($tableau['__numro_de_tlphone'])){
                   echo "<p>Numéro de téléphone : " . $tableau["__numro_de_tlphone"] . "</p>";
               }
               if (isset($tableau['__votre_adresse_de_messagerie'])){
                    echo "<p>Email: " . $tableau["__votre_adresse_de_messagerie"] . "</p>";
               }

                // Prix
                if (isset($tableau['somme_du_devis_hors_taxes'])){
                    echo "<p>Somme du devis hors taxe : " . $tableau["somme_du_devis_hors_taxes"] . " euros </p>";
                }
                if (isset($tableau['somme_du_devis_avec_taxes_'])){
                    echo "<p>Somme du devis taxe comprises : " . $tableau["somme_du_devis_avec_taxes_"] . " euros </p>";
                }
                ?>
                    <?php
                    if ($treated == '0'){
                        ?>
                        <form method="post" action="index.php">
                            <input type="hidden" name="idTreated" value="<?php echo $id; ?>">
                            <input type="submit" class="btn btn-lg btn-success" value="Traiter">
                        </form>
                        <?php
                    }else{
                        ?>
                        <form method="post" action="index.php">
                            <input type="hidden" name="idUntreated" value="<?php echo $id; ?>">
                            <input type="submit" class="btn btn-lg btn-primary" value="Annuler traitement">
                        </form>
                    <?php
                    }
                    ?>


            </table>
        </div>
    </div>


<?php
} // function displayTab($tableau)


