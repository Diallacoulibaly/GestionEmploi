<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    input{
        border: 1px solid black;
        padding: 10px;
        border-radius: 5px;
        color: black;
        background-color:white;
    }
    form{
        background-image:url("WhatsApp Image 2024-02-11 à 11.02.20_b83964d6.jpg" );
        height: 900px;
        background-repeat:no-repeat;
        width: 900px;
        margin:auto;
        margin-top:180px;
    }
    input{
        margin-top:420px;
        margin-left:  50px;
        
    }
    #id{
        margin-top:420px;
        margin-left:  150px;
        
    }
    body{
        background-color:wheat;
    }
</style>
<body>
    
    <form action="" method="POST">
        <input id="di" type="submit" value="s'inscrire" name="P1">
        <input type="submit" value="s'authentifier" name="P2">
   
    </form>
</body>
</html>
<?php
  if(isset($_POST['P1']))
    header('Location: inscrip.php');
  else if(isset($_POST['P2']))
    header('Location:authentification.php');
?>