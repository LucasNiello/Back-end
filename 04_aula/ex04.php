<?php
function calcularValor($marca, $ano, $Ndonos){
    // Define o valor base do carro de acordo com a marca
    switch(strtolower($marca)){ // strtolower para não diferenciar maiúsculas e minúsculas
        case 'bmw':
        case 'porsche':
            $valor = 300000;
            break;
        case 'nissan':
            $valor = 70000;
            break;
        case 'byd':
            $valor = 150000;
            break;
    }

    //REDUZIR 5% do valor base para cada ano de idade do carro
    if($Ndonos > 1){
        $valor *= (1 - 0.05 * ($Ndonos -1));
    }

    //reduzir R$ 3.000 para cada ano de uso
    $valor -= 3000 * $ano;

       // Garantir que o valor não fique negativo
    if($valor < 0){
        $valor = 0;
    }

    return $valor;



    
}

// Exemplos de uso
echo "BMW, 3 anos, 2 donos: R$ " . calcularValor('BMW', 3, 2) . "\n";
echo "Nissan, 5 anos, 1 dono: R$ " . calcularValor('Nissan', 5, 1) . "\n";
echo "BYD, 2 anos, 3 donos: R$ " . calcularValor('BYD', 2, 3) . "\n";
echo "Porsche, 1 ano, 1 dono: R$ " . calcularValor('Porsche', 1, 1) . "\n";

