<?php
require("authen.php");
$r="select * from info_fil ";
$re=mysqli_query($cn,$r);
while ($row=mysqli_fetch_assoc($re)) {
    echo $row['info']."<br/>";
}
mysqli_close($cn);
?>