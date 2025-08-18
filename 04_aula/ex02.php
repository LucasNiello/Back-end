<?php
function ehSeminovo($ano){
    $anoAtual = date("Y"); // Obtém o ano atual
    $idade = $anoAtual -$ano;
    return $idade <= 3;
}

//Testes
var_dump(ehSeminovo(2023)); // true (até 3 anos)
var_dump(ehSeminovo(2020)); // false (mais de 3 anos)
?>

