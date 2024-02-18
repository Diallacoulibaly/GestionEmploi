<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="inscrip" href="inscrip.css"> -->
</head>
<body>
    <style>
        .conteneur{
    border: 1px solid rgb(255, 250, 250);
    padding: 180px;
    background-color: white;
    border-radius: 8px;
}
h1{
    font-size: 50px;
}
body{
    height: 90vh;
    display: flex;
    flex-direction: column;
    background-color: rgb(252, 251, 249);
    justify-content: center;
    align-items: center;
    
}
input{
    width: 450px;
    padding:  18px;
    margin: 5px;
    border-radius: 6px ;
    font-size: 26px;
    border: 1px solid rgb(242, 245, 245);
    background-color: rgb(242, 245, 245);
}
button[type=submit]{
    width: 490px;
    padding:  18px;
    font-size: 26px;
    margin: 8px;
    background-color: rgb(86, 86, 243);
    color: white;
    border-color: rgb(86, 86, 243);
    border: 3px solid;

}

button[type=submit]:hover{
    width: 490px;
    padding:  18px;
    font-size: 26px;
    margin: 8px;
    background-color: white;
    color: rgb(86, 86, 243);
    border-color: rgb(86, 86, 243);

} 


.conteneur:hover{
    border: 2px solid rgb(250, 247, 247);
    padding: 200px;
    background-color: rgb(252, 246, 246);
    border-radius: 8px;
    box-shadow: 6px 2px rgb(238, 235, 235);
}
    </style>
    <div class="conteneur">
    <form action="inscrip.php" method="post">

<h2>Créer un compte</h2>
    <h5>Veuillez remplir tous les champs</h5>
    <table> 
        <tr>
           
            <td><input type="email" name="email" placeholder="Email"></td>
        </tr>
        <tr>
            <td><input type="text" name="tel" placeholder="Tel" ></td>
        </tr>
        <tr>
            <td><input type="text" name="psd" id="psd" placeholder="Mot de passe"></td>
        </tr>
    </table>
    <button type="submit">S'inscrire</button>

</form>

    </div>
</body>
</html>
<?php
require("authen.php");
if (isset($_POST['email']) && isset($_POST['tel']) && isset($_POST['psd'])) {


$pnom = $_POST['email'];
$email = $_POST['tel'];
$psd = $_POST['psd'];
$sql = "INSERT INTO inscription Values ('$pnom', '$email',$psd)";
$res = mysqli_query($cn, $sql);
if ($res) {
    echo "Utilisateur inscri";
     header("Location:table.php");
}else {
    echo " Utilisateur non inscri";
    
}
mysqli_close($cn);
}
?>