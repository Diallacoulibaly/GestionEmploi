<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         body{
            display: flex;
            flex-direction: row;
        }
       table,td,th{
            border: 1px solid black;
            color: black;
            
        }
        th{
            padding: 20px;
        } 


        body {
    font-family: Arial, sans-serif;
}

table {
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
    width:25vh;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}
.bourhil {
    background-color: #66eccb;
    
}

.salhi2 {
    background-color: #93e436;
   
}
.salhi {
    background-color: #2600ff;
   
}

.yasmine {
    background-color: #ff6347;
   
}

.yatobane {
    background-color: #854d1a;
   
}
.yatobane2 {
    background-color: #48064e;
    
}

.kabba2 {
    background-color: #31041e;
    
}
.kabba {
    background-color: #d8e61c;
    
}


.anglais {
    background-color: #8f0756;
    
}

 .matieres ul{
    display: flex;
    align-items: center;
    height: 30px;
    list-style-type: none;
    color: white;
    border-radius: 3px;
    background-color:  #ff6347; 
    padding: 0 5px;
    max-width:168px;
    

    
}

button{
    background-color: #4b81d1;
    color: white;
    border: 1px solid #4b81d1;
    height: 30px;
    width: 30px;
}


img{
    height: 12px;
    width: 12px;
    background-color: none;
    /* float: right; */

}
input{
    height: 30px;
    border-radius :3px; 
    border: 1px solid gray;
}
#couleur{
    margin-bottom: 5px;
}

    </style>
</head>

<body>

<div class="main">
<div class="filtre">
<input type="text" placeholder="Filtrer...">
</div>
<div class="matieres">
<ul >
    <li>Français  <img src="image/suppr.png" alt="suppr"> <img src="image/modif.png" alt="modif"> </li>
</ul>

</div>

<input type="color" name="Couleur" id="couleur" >
<input type="text" placeholder="Nom de la matière"  >
<button>+</button>
</div>
<table>
    <tr>
        <th>Heure</th>
        <th>Lundi</th>
        <th>Mardi</th>
        <th>Mercredi</th>
        <th>Jeudi</th>
        <th>Vendredi</th>
        <th>Samedi</th>
    </tr>
    <tr>
        <td>08:30</td>
        <td rowspan="5" class="bourhil">BOURHIL</td>
        <td rowspan="11" class="yatobane">YATOBANE</td>
        <td ></td>
        <td ></td>
        <td></td>
        <td rowspan="7" class="kabba">KABBA</td>
    
    </tr>
    <tr>
        <td>09:00</td>
        <td ></td>
        <td ></td>
        <td></td>
        
    
    </tr>
    <tr>
        <td>09:30</td>
        <td ></td>
        <td ></td>
        <td></td>
        
    
    </tr>

    <tr>
        <td>10:00</td>
        <td ></td>
        <td ></td>
        <td></td>
        
    
    </tr>

    <tr>
        <td>10:30</td>
        <td ></td>
        <td ></td>
        <td></td>
        
    
    </tr>

    <tr>
        <td>11:00</td>
        <td rowspan="6" class="salhi">SALHI</td>
        <td ></td>
        <td ></td>
        <td></td>
        
    
    </tr>

    <tr>
        <td>11:30</td>
        <td ></td>
        <td ></td>
        <td></td>
       
    
    </tr>

    <tr>
        <td>12:00</td>
        <td ></td>
        <td ></td>
        <td></td>
        <td></td>

        
    
    </tr>

    <tr>
        <td>12:30</td>
        <td ></td>
        <td ></td>
        <td></td>
        <td></td>
    </tr>

    <tr>
        <td>13:00</td>
        <td ></td>
        <td ></td>
        <td></td>
        <td></td>
    </tr>

    <tr>
        <td>13:30</td>
        <td rowspan="5" class="yasmine">YASMINE</td> 
        <td rowspan="11" class="salhi2">SALHI</td>
        <td ></td>
        <td></td>
    </tr>

    <tr>
        <td>14:00</td>
        <td rowspan=""></td>
        <td rowspan=""></td>
        <td ></td>
        <td></td>
    </tr>

    <tr>
        <td>14:30</td>
        <td rowspan=""></td>
        <td rowspan=""></td>
        <td rowspan="4" class="anglais">ANGLAIS</td>
        <td ></td> 
    </tr>

    <tr>
        <td>15:00</td>
        <td rowspan=""></td>
        <td rowspan=""></td>
        <td ></td>
    </tr>

    <tr>
        <td>15:30</td>
        <td rowspan=""></td>
        <td rowspan=""></td>
        <td ></td>
    </tr>

    <tr>
        <td>16:00</td>
        <td ></td>
        <td></td>
        <td rowspan="6" class="yatobane2">YATOBANE</td>
        <td></td>
      
    </tr>

    <tr>
        <td>16:30</td>
        <td rowspan=""></td>
        <td ></td>
        <td rowspan="5" class="kabba2">KABBA</td>
        <td></td>

    </tr>

    <tr>
        <td>17:00</td>
        <td rowspan=""></td>
        <td rowspan=""></td>
        <td ></td>
    </tr>

    <tr>
        <td>17:30</td>
        <td rowspan=""></td>
        <td ></td>
        <td></td>

    </tr>

    <tr>
        <td>18:00</td>
        <td rowspan=""></td>
        <td ></td>
        <td></td>

    </tr>

    <tr>
        <td>18:30</td>
        <td rowspan=""></td>
        <td ></td>
        <td></td>


    </tr>




</table>
</div>


</body>
</html>