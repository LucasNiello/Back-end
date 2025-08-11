<!-- ###################### 
8.--> 

<?php
echo "Digite um número: ";
$num = (int) trim(fgets(STDIN));

for ($i = 1; $i <= 10; $i++) {
    echo "$num x $i = " . ($num * $i) . "\n";
}
?>

