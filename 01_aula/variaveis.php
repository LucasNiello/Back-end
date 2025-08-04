<?php
echo "ola \n";
$nome = "Manveru! \n";
$idade = "30";
$ano_atual = 2025;

$data_nasc= $ano_atual-$idade;
echo $nome, "voc~e nasceu em:",$data_nasc;

?>

<!-- Questões 2 e 3 do slide aula 01 - Fundamentos básicos. -->


<?php
//2. Dado uma frase “Programação em php.” transformá‐la em maiúscula, imprima,
//depois em minúscula e imprima de novo.
$frase = "Programação em php.";
echo strtoupper($frase), "\n"; // para transformar em maiúsculas, o mb_ é para lidar com acentuação
echo strtolower($frase), "\n"; // para transformar em minúsculas.
?>


<?php
// Questão 3
// 3. Numa dada frase “O PHP foi criado em mil novecentos e noventa e cinco”.
// - Trocar o “O” (letra) por “0”(zero), o “a” por “4” e o “i” por “1”.    
$frase2 = "O PHP foi criado em mil novecentos e noventa e cinco";
$frase2 = str_replace(['o','a','i'], ['0','4','1'], $frase2); // Troca 'o' por '0', 'a' por '4' e 'i' por '1'
echo $frase2, "\n";
?>