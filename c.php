<?php
// Connexion à la base de données
require "authen.php";

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si les champs groupe sont sélectionnés
    if (!empty($_POST['groupe'])) {
        $groupe = mysqli_real_escape_string($cn, $_POST['groupe']);

        // Variable pour indiquer si un conflit a été détecté
        $conflit = false;

        // Boucle pour traiter chaque cellule de l'emploi du temps
        foreach ($_POST['seance'] as $seance => $jours) {
            foreach ($jours as $jour => $contenu) {
                // Vérifie si les champs matière et salle ne sont pas vides
                if (!empty($contenu['matière']) && !empty($contenu['salle'])) {
                    $matiere = mysqli_real_escape_string($cn, $contenu['matière']);
                    $salle = mysqli_real_escape_string($cn, $contenu['salle']);

                    // Vérification si une séance similaire existe déjà
                    $check_query = "SELECT * FROM emploi_du_temps WHERE jour = '$jour' AND seance = '$seance' AND salle = '$salle'";
                    $check_result = mysqli_query($cn, $check_query);
                    if(mysqli_num_rows($check_result) > 0) {
                        // Une entrée similaire existe déjà, indiquer le conflit
                        $conflit = true;
                    } else {
                        // Aucune entrée similaire n'existe, procédez à l'insertion dans la base de données
                        $query = "INSERT INTO emploi_du_temps (seance, jour, matière, salle, groupe) VALUES ('$seance', '$jour', '$matiere', '$salle', '$groupe')";
                        // Débogage : Affiche la requête d'insertion
                        echo "Requête d'insertion : $query<br>";
                        $result = mysqli_query($cn, $query);
                        if (!$result) {
                            // Débogage : Affiche l'erreur SQL
                            echo "Erreur d'insertion SQL : " . mysqli_error($cn) . "<br>";
                        }
                    }
                } else {
                    // Débogage : Affiche un message si matière ou salle est vide
                    if (empty($contenu['matière'])) {
                        echo "Matière vide pour seance $seance et jour $jour<br>";
                    }
                    if (empty($contenu['salle'])) {
                        echo "Salle vide pour seance $seance et jour $jour<br>";
                    }
                }
            }
        }
        // Vérifie s'il y a eu un conflit
        if ($conflit) {
            // Affiche le message d'erreur
            echo "<div class='alert alert-danger' role='alert'>Erreur : La salle est deja prise.</div>";
        } else {
            // Redirection vers la page précédente ou une autre page après l'enregistrement
            header('Location: c.php');
            exit;
        }
    } else {
        echo "<div class='alert alert-warning' role='alert'>Veuillez sélectionner un groupe.</div>";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Emploi du temps</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>

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
    <div class="container">
        <h2 class="my-4">Emploi du temps</h2>
        <p><strong>Matin</strong>: 10 minutes de pause de 10:20 à 10:30 </p>
        <p><strong>Soir</strong>:  10 minutes de pause de 15:30 à 15:40 </p>

        <form id="form_emploi_temps" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class="form-group">
                <label for="groupeSelect"><strong>Groupe:</strong></label>
                <select class="form-control" id="groupeSelect" name="groupe">
                    <?php
                    $groupe_query = "SELECT groupe FROM groupe";
                    $groupe_result = mysqli_query($cn, $groupe_query);
                    if ($groupe_result->num_rows > 0) {
                        while ($groupe_row = mysqli_fetch_assoc($groupe_result)) {
                            echo "<option>" . $groupe_row["groupe"] . "</option>";
                        }
                    }
                    ?>
                </select>
            </div>

            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Séance</th>
                        <?php
                        // Récupérer les jours de la semaine depuis la table jours_semaine
                        $jours_query = "SELECT jour_nom FROM jours_semaine";
                        $jours_result = mysqli_query($cn, $jours_query);
                        if ($jours_result->num_rows > 0) {
                            while ($row = mysqli_fetch_assoc($jours_result)) {
                                echo "<th>" . $row["jour_nom"] . "</th>";
                            }
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Récupérer les heures depuis la table seance
                    $heures_query = "SELECT seance FROM seance";
                    $heures_result = mysqli_query($cn, $heures_query);
                    if ($heures_result->num_rows > 0) {
                        while ($seance_row = mysqli_fetch_assoc($heures_result)) {
                            $heure_formattee = $seance_row["seance"];
                            echo "<tr>";
                            echo "<td>" . $heure_formattee . "</td>";
                            // Pour chaque heure, afficher un select avec les options des matières et des salles
                            $jours_result->data_seek(0); // Remettre le pointeur de résultat au début
                            while ($jour_row = mysqli_fetch_assoc($jours_result)) {
                                echo "<td>";
                                echo "<div class='form-group'>";
                                // Sélecteur de matière
                                echo "<select class='form-control' name='seance[$heure_formattee][" . $jour_row["jour_nom"] . "][matière]'>";
                                $matieres_query = "SELECT Nom_ma FROM matière";
                                $matieres_result = mysqli_query($cn, $matieres_query);
                                if ($matieres_result->num_rows > 0) {
                                    echo "<option value=''> </option>";
                                    while ($matiere_row = mysqli_fetch_assoc($matieres_result)) {
                                        echo "<option>" . $matiere_row["Nom_ma"] . "</option>";
                                    }
                                }
                                echo "</select>";
                                // Sélecteur de salle
                                echo "<select class='form-control mt-2' name='seance[$heure_formattee][" . $jour_row["jour_nom"] . "][salle]'>";
                                $salles_query = "SELECT Nom_sal FROM salle";
                                $salles_result = mysqli_query($cn, $salles_query);
                                if ($salles_result->num_rows > 0) {
                                    echo "<option value=''> </option>";
                                    while ($salle_row = mysqli_fetch_assoc($salles_result)) {
                                        echo "<option>" . $salle_row["Nom_sal"] . "</option>";
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
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Enregistrer l'emploi du temps</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
    
     <script>
        document.getElementById('groupeSelect').addEventListener('change', function() {
    var groupe = this.value;
    console.log('Groupe sélectionné:', groupe); // Log pour vérifier le groupe sélectionné

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'fetch_emploi.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log('Réponse du serveur:', xhr.responseText); // Log pour vérifier la réponse du serveur
            var newWindow = window.open('', '_blank');
            newWindow.document.open();
            newWindow.document.write(xhr.responseText);
            newWindow.document.close();
        } else {
            console.error('Erreur de requête:', xhr.status, xhr.statusText); // Log pour vérifier les erreurs de requête
        }
    };
    
    xhr.onerror = function() {
        console.error('Erreur de requête AJAX'); // Log pour vérifier les erreurs AJAX
    };
    
    xhr.send('groupe=' + groupe);
});

    </script>
    
</body>
</html>

?>