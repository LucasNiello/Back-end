<!-- ###################### 
7.-->

<?php
echo "Digite o número final: ";
$final = (int) trim(fgets(STDIN));

for ($i = 0; $i <= $final; $i++) {
    if ($i % 2 == 0) {
        echo $i . "\n";
    }
}
?>

