<!-- ###################### 
9.-->

<?php
echo "Digite a temperatura: ";
$temp = (float) trim(fgets(STDIN));

if ($temp < 15) {
    echo "Frio\n";
} elseif ($temp <= 25) {
    echo "Agradável\n";
} else {
    echo "Quente\n";
}
?>

