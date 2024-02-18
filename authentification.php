<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>authentification</title>
    <link rel="stylesheet" href="auth.css">
</head>


<body>

    <div class="conteneur">
    <h1>Page d'authentification</h1>
    <form action="" method="POST">
        <input type="text" name="nom" placeholder="Login" >
        <br/>
        <br/>
        <input type="password" name="psd" placeholder="Mot de passe">
        <br/>
        <input type='submit' value="envoyer"/>
    </form>
    </div>
</body>
</html>
<?php
require("authen.php");
if (!empty($_POST['nom']) && !empty($_POST['psd']))  {
    $n=$_POST['nom'];
    $lo=$_POST['psd'];
    $r=("select * from connection where login='$n' and password='$lo'");
    $re=mysqli_query($cn,$r);
    if (mysqli_fetch_assoc($re)) {
        $_SESSION['nom']=$n;
        if($_SESSION['nom']){
            header('Location:table.php');

        }
      
    }else{
        echo"le login ou le mot de passe sont incorrectes";
    }
}
mysqli_close($cn);

?>