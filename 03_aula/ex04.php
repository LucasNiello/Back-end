<!-- ######################
4.-->

<?php
echo "Digite o primeiro número: ";
$num1 = (float) trim(fgets(STDIN));

echo "Digite o segundo número: ";
$num2 = (float) trim(fgets(STDIN));

echo "Digite a operação (+, -, *, /): ";
$operacao = trim(fgets(STDIN));

switch ($operacao) {
    case "+":
        echo "Resultado: " . ($num1 + $num2) . "\n";
        break;
    case "-":
        echo "Resultado: " . ($num1 - $num2) . "\n";
        break;
    case "*":
        echo "Resultado: " . ($num1 * $num2) . "\n";
        break;
    case "/":
        if ($num2 != 0) {
            echo "Resultado: " . ($num1 / $num2) . "\n";
        } else {
            echo "Erro: divisão por zero!\n";
        }
        break;
    default:
        echo "Operação inválida!\n";
}
?>

