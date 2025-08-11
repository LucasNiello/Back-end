<!-- ###################### 
2.-->

<?php
echo "Digite a nota (0 a 10): ";
$nota = (float) trim(fgets(STDIN));

if ($nota >= 9) {
    echo "Excelente\n";
} elseif ($nota >= 7) {
    echo "Bom\n";
} else {
    echo "Reprovado\n";
}
?>
