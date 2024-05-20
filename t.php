
<form action="" method="POST">
    Choisir une filière
    <select name="filiere" onchange="this.form.submit()">
        <option value="" disabled selected>--Choix--</option>
        <option value="Français">Français</option>
        <option value="Anglais">Anglais</option>
        <option value="React">React</option>
        <option value="Laravel">Laravel</option>
        <option value="Cloud native">Cloud native</option>
        <option value="Préparation web">Préparation web</option>      
        <option value="Excel">Excel</option>
        <option value="Base de donnée">Base de donnée</option>      
</select>
   
</form>
<?php
// Connexion
if(isset($_POST["filiere"])){
    $filiere = $_POST["filiere"];
   # echo "Votre filière est : ".$fil;


$req= "SELECT * FROM matiere WHERE Nom_ma='$filiere' ";
require "authen.php";
$res= mysqli_query($cn,$req);
if($res){
    echo "<table>";
        echo "<tr><th>ID </th>  <th>NOM</th>  </tr>";

    while($row = mysqli_fetch_assoc($res)){
        echo "<tr>"; 
        echo "<td>" . $row['Code_ma'].'</td>';
        echo "<td>" . $row['Nom_ma'].'</td>';
        echo '</tr>';

    }
    echo "</table>";
}


mysqli_close($cn); 

}
   
   
   

?>
</body>
</html>


