<!-- ###################### 
 6.-->

<?php
echo "Digite o número inicial: ";
$inicio = (int) trim(fgets(STDIN));

for ($i = $inicio; $i >= 1; $i--) {
    echo $i . "\n";
}
?>

