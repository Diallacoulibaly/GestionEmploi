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

        select{
            text-decoration: none;
            border: none;
        }
    </style>
</head>
<body>
    <h2>Emploi du temps</h2>
    <p><strong>Matin</strong>: 10 minutes de pause de 10:20 à 10:30 </p>
    <p><strong>Soir</strong>:  10 minutes de pause de 15:30 à 15:40 </p>

    <table id="emploi_du_temps">
        <tr>
            <th>Séance</th> <!-- Modification ici -->
            <?php
            // Connexion à la base de données
            require "authen.php";

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
        <?php
        // Récupérer les heures depuis la table heure
        $heures_query = "SELECT seance FROM seance";
        $heures_result = mysqli_query($cn, $heures_query);
        if ($heures_result->num_rows > 0) {
            while ($seance_row = mysqli_fetch_assoc($heures_result)) {
                // Formater l'heure pour afficher uniquement l'heure et les minutes
                $heure_formattee = $seance_row["seance"];

                // $heure_formattee = date("H:i", strtotime($heure_row["heure"]));
                echo "<tr>";
                echo "<td>" . $heure_formattee . "</td>";
                // Pour chaque heure, afficher un select avec les options des matières
                $jours_result->data_seek(0); // Remettre le pointeur de résultat au début
                while ($jour_row = mysqli_fetch_assoc($jours_result)) {
                    echo "<td>";
                    echo "<div class='td-content'>";
                    echo "<select class='matiereSelect' onchange='updateTD(this)'>";
                    // Récupérer les matières pour cette heure et ce jour
                    $matieres_query = "SELECT Nom_ma FROM matière ";
                    $matieres_result = mysqli_query($cn, $matieres_query);
                    if ($matieres_result->num_rows > 0) {
                        echo "<option >  </option>";
                        while ($matiere_row = mysqli_fetch_assoc($matieres_result)) {
                            echo "<option >" . $matiere_row["Nom_ma"] . "</option>";
                        }
                    }
                    echo "</select>";
                    echo "<select>";

                    $matieres_query = "SELECT Nom_sal FROM salle ";
                    $matieres_result = mysqli_query($cn, $matieres_query);
                    if ($matieres_result->num_rows > 0) {
                        echo "<option >  </option>";
                        while ($matiere_row = mysqli_fetch_assoc($matieres_result)) {
                            echo "<option >" . $matiere_row["Nom_sal"] . "</option>";
                        }
                    }
                    echo "</select>";
                    // echo "<button onclick='reloadSelect(this)'>Supprimer</button>";
                    // echo "<button>Modifier</button>";
                    echo "</div>";
                    echo "</td>";
                }
                echo "</tr>";
            }
        }
        mysqli_close($cn);
        ?>
    </table>

    <script>
        // function updateTD(select) {
        //     var selectedValue = select.value;
        //     var tdContent = select.parentNode;
            // tdContent.innerHTML = selectedValue;
            // var td = tdContent.parentNode;
            // var buttonDiv = document.createElement('div');
            // buttonDiv.className = 'td-content';
            // var deleteButton = document.createElement('button');
            // deleteButton.textContent = 'Supprimer';
            // deleteButton.onclick = function() {
                // var newSelect = document.createElement('select');
                // newSelect.className = 'matiereSelect';
                // var options = select.options;
                // for (var i = 0; i < options.length; i++) {
                //     if (options[i].value !== selectedValue) {
                //         var option = document.createElement('option');
                //         option.text = options[i].text;
                //         option.value = options[i].value;
                //         newSelect.add(option);
            //         }
            //     }
            //     tdContent.innerHTML = '';
            //     tdContent.appendChild(newSelect);
            // };
            // var editButton = document.createElement('button');
            // editButton.textContent = 'Modifier';
            // editButton.onclick = function() {
            //     var newSelect = document.createElement('select');
                // newSelect.className = 'matiereSelect';
                // var options = tdContent.querySelector('select').options;
                // for (var i = 0; i < options.length; i++) {
                //     var option = document.createElement('option');
                //     option.text = options[i].text;
                //     option.value = options[i].value;
                //     newSelect.add(option);
                // }
                // newSelect.onchange = function() {
                //     updateTD(this);
                // };
                // tdContent.innerHTML = '';
                // tdContent.appendChild(newSelect);
                // newSelect.focus();
            // };
            // buttonDiv.appendChild(deleteButton);
            // buttonDiv.appendChild(editButton);
        //     td.appendChild(buttonDiv);
        // }

        // function reloadSelect(button) {
        //     var tdContent = button.parentNode;
        //     var select = tdContent.querySelector('select');
        //     var options = select.options;
        //     var newSelect = document.createElement('select');
        //     newSelect.className = 'matiereSelect';
        //     for (var i = 0; i < options.length; i++) {
        //         var option = document.createElement('option');
        //         option.text = options[i].text;
        //         option.value = options[i].value;
        //         newSelect.add(option);
        //     }
        //     select.parentNode.replaceChild(newSelect, select);
        //     newSelect.focus();
        // }
    </script>
</body>
</html>