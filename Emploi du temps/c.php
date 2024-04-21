<?php
// Connexion à la base de données
require "connexion.php";

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si les champs matière et salle ne sont pas vides et que le groupe et la filière sont sélectionnés
    if (!empty($_POST['groupe'])  ) {
        $groupe = $_POST['groupe'];
        // Boucle pour traiter chaque cellule de l'emploi du temps
        foreach ($_POST['seance'] as $seance => $jours) {
            foreach ($jours as $jour => $contenu) {
                // Vérifie si les champs matière et salle ne sont pas vides
                if (!empty($contenu['matiere']) && !empty($contenu['salle'])) {
                    $matiere = $contenu['matiere'];
                    $salle = $contenu['salle'];
                    // Enregistrement dans la base de données
                    $query = "INSERT INTO emploi_du_temps (seance, jour, matiere, salle, groupe) VALUES ('$seance', '$jour', '$matiere', '$salle', '$groupe')";
                    
                    mysqli_query($cnx, $query);
                }
            }
        }
        // Redirection vers la page précédente ou une autre page après l'enregistrement
        header("Location: c.php");
        exit;
    } else {
        echo "Veuillez sélectionner un groupe et une filière.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Emploi du temps</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Emploi du temps</h2>
    <p><strong>Matin</strong>: 10 minutes de pause de 10:20 à 10:30 </p>
    <p><strong>Soir</strong>:  10 minutes de pause de 15:30 à 15:40 </p>

    <form id="form_emploi_temps" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <p><strong>Groupe: </strong>
            <select class='groupeSelect' name='groupe'>
                <?php
                $groupe_query = "SELECT groupe FROM groupe";
                $groupe_result = mysqli_query($cnx, $groupe_query);
                if ($groupe_result->num_rows > 0) {
                    while ($groupe_row = mysqli_fetch_assoc($groupe_result)) {
                        echo "<option>" . $groupe_row["groupe"] . "</option>";
                    }
                }
                ?>
            </select>
        </p>
        <!-- <p><strong>Filière: </strong> -->
            <!-- <select class='filiereSelect' name='filiere'>
                <?php
                // $filiere_query = "SELECT nom_filiere FROM filiere";
                // $filiere_result = mysqli_query($cnx, $filiere_query);
                // if ($filiere_result->num_rows > 0) {
                //     while ($filiere_row = mysqli_fetch_assoc($filiere_result)) {
                //         echo "<option>" . $filiere_row["nom_filiere"] . "</option>";
                //     }
                // }
                ?>
            </select> -->
        </p>

        <table id="emploi_du_temps">
            <tr>
                <th>Séance</th>
                <?php
                // Récupérer les jours de la semaine depuis la table jours_semaine
                $jours_query = "SELECT jour_nom FROM jours_semaine";
                $jours_result = mysqli_query($cnx, $jours_query);
                if ($jours_result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($jours_result)) {
                        echo "<th>" . $row["jour_nom"] . "</th>";
                    }
                }
                ?>
            </tr>
            <?php
            // Récupérer les heures depuis la table seance
            $heures_query = "SELECT seance FROM seance";
            $heures_result = mysqli_query($cnx, $heures_query);
            if ($heures_result->num_rows > 0) {
                while ($seance_row = mysqli_fetch_assoc($heures_result)) {
                    $heure_formattee = $seance_row["seance"];
                    echo "<tr>";
                    echo "<td>" . $heure_formattee . "</td>";
                    // Pour chaque heure, afficher un select avec les options des matières et des salles
                    $jours_result->data_seek(0); // Remettre le pointeur de résultat au début
                    while ($jour_row = mysqli_fetch_assoc($jours_result)) {
                        echo "<td>";
                        echo "<div class='td-content'>";
                        // Sélecteur de matière
                        echo "<select class='matiereSelect' name='seance[$heure_formattee][" . $jour_row["jour_nom"] . "][matiere]' onchange='updateTD(this)'>";
                        $matieres_query = "SELECT Nom_ma FROM matiere";
                        $matieres_result = mysqli_query($cnx, $matieres_query);
                        if ($matieres_result->num_rows > 0) {
                            echo "<option >  </option>";
                            while ($matiere_row = mysqli_fetch_assoc($matieres_result)) {
                                echo "<option >" . $matiere_row["Nom_ma"] . "</option>";
                            }
                        }
                        echo "</select>";
                        // Sélecteur de salle
                        echo "<select class='salleSelect' name='seance[$heure_formattee][" . $jour_row["jour_nom"] . "][salle]' onchange='updateTD(this)'>";
                        $salles_query = "SELECT Nom_sal FROM salle";
                        $salles_result = mysqli_query($cnx, $salles_query);
                        if ($salles_result->num_rows > 0) {
                            echo "<option >  </option>";
                            while ($salle_row = mysqli_fetch_assoc($salles_result)) {
                                echo "<option >" . $salle_row["Nom_sal"] . "</option>";
                            }
                        }
                        echo "</select>";
                        echo "</div>";
                        echo "</td>";
                    }
                    echo "</tr>";
                }
            }
            ?>
        </table>
        <input type="submit" value="Enregistrer l'emploi du temps">
    </form>

    <script>
        
    </script>
</body>
</html>

<?php
mysqli_close($cnx);
?>
