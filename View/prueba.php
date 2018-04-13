<form action="testReturn.php" method= "POST" >
<select name="test">
    <option value="1">VAlor XD</option>
    <option value="15">Primaria</option>
    <option value="4">Secundaria</option>
    <option value="8">Universidad</option>
    </select>
    <input type = "submit" value="Proceder"/>
    </form>
<?php
    date_default_timezone_set('America/Managua');
    echo "Buenos d&iacute;as, hoy es " . date("w");
    $hoy = getdate();
    echo $hoy['weekday'];
    if($hoy['weekday']  == "Monday" || $hoy['weekday']  == "Saturday" && $hoy['hours'] < 20){
        echo "Dia";    
    }
    echo $hoy['hours'];
    if($hoy['hours'] > 20){
        echo "sorteo de las 9";
    }
    ?>
