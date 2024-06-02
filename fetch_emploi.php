<!DOCTYPE html>
<html>
<head>
    <title>Emploi du temps pour le groupe <?php echo htmlspecialchars($_POST['groupe']); ?></title>
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
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
        .container {
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h2>Emploi du temps pour le groupe <?php echo htmlspecialchars($_POST['groupe']); ?></h2>

        <?php
        require "authen.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['groupe'])) {
            $groupe = mysqli_real_escape_string($cn, $_POST['groupe']);
            $query = "SELECT * FROM emploi_du_temps WHERE groupe = '$groupe'";
            $result = mysqli_query($cn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                echo "<table class='table table-bordered'>
                        <thead class='thead-light'><tr><th>Séance</th><th>Jour</th><th>Matière</th><th>Salle</th></tr></thead>
                        <tbody>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['seance']) . "</td>
                            <td>" . htmlspecialchars($row['jour']) . "</td>
                            <td>" . htmlspecialchars($row['matière']) . "</td>
                            <td>" . htmlspecialchars($row['salle']) . "</td>
                        </tr>";
                }
                echo "</tbody></table>";

                // Boutons d'impression
                echo "<div class='mt-3'>
                        <button onclick='exportToCsv()' class='btn btn-secondary mr-2'>Imprimer en CSV</button>
                        <button onclick='exportToExcel()' class='btn btn-secondary mr-2'>Imprimer en Excel</button>
                        <button onclick='exportToPdf()' class='btn btn-secondary'>Imprimer en PDF</button>
                      </div>";
            } else {
                echo "<div class='alert alert-warning' role='alert'>Aucun emploi du temps trouvé pour ce groupe.</div>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>Requête invalide.</div>";
        }

        mysqli_close($cn);
        ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.0/FileSaver.min.js"></script>
    <script>
        // Fonction pour convertir le tableau en format CSV et télécharger le fichier
        function exportToCsv() {
            var csv = [];
            var rows = document.querySelectorAll("table tr");
            for (var i = 0; i < rows.length; i++) {
                var row = [], cols = rows[i].querySelectorAll("td, th");
                for (var j = 0; j < cols.length; j++)
                    row.push(cols[j].innerText);
                csv.push(row.join(","));
            }
            var csvContent = "data:text/csv;charset=utf-8," + csv.join("\n");
            var encodedUri = encodeURI(csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "emploi_du_temps.csv");
            document.body.appendChild(link);
            link.click();
        }

        // Fonction pour exporter le tableau en format Excel
        function exportToExcel() {
            var table = document.querySelector('table');
            var html = table.outerHTML;
            var blob = new Blob(['\ufeff', html], {
                type: 'application/vnd.ms-excel'
            });
            var url = URL.createObjectURL(blob);
            var a = document.createElement('a');
            a.href = url;
            a.download = 'emploi_du_temps.xls';
            document.body.appendChild(a);
            a.click();
            setTimeout(function () {
                document.body.removeChild(a);
                window.URL.revokeObjectURL(url);
            }, 0);
        }

       
     // Fonction pour exporter le tableau en format PDF
     function exportToPdf() {
    var table = document.querySelector('table');
    var filename = 'emploi_du_temps.pdf';

    // Création d'une nouvelle instance de jsPDF
    var pdf = new jsPDF('p', 'pt', 'a4');

    // Options pour la méthode autoTable
    var options = {
        addPageContent: function(data) {
            pdf.text("Emploi du temps pour le groupe " + document.getElementById('groupeSelect').value, 40, 30);
        }
    };

    // Conversion du tableau en PDF en utilisant la méthode autoTable de jsPDF
    pdf.autoTable({ html: table, startY: 50, options });

    // Sauvegarde du fichier PDF
    pdf.save(filename);
}

    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>


</body>
</html>






