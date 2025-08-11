<!-- Faça um algoritmo que leia 2 valores digitados pelo usuário e interprete o tipo de variável que foi digitado. Caso os TIPOS sejam iguais, a seguinte mensagem deve ser exibida: "Variáveis de tipos iguais! Primeiro valor do tipo [type] e segundo valor do tipo [type]". Caso não, a seguinte mensagem: "ERRO! Variáveis de tipos diferentes. Primeiro valor do tipo [type] e segundo valor do tipo [type]"

Como a função de extrair o tipo da variável ainda não foi ensinada, o aluno deve pesquisar (SEM INTELIGENCIA ARTIFICIAL) como fazer isso.-->





<?php
// Solicita ao usuário que digite o primeiro valor e armazena na variável $valor1
$valor1 = readline("Digite o primeiro valor: ");

// Solicita ao usuário que digite o segundo valor e armazena na variável $valor2
$valor2 = readline("Digite o segundo valor: ");

// Verifica se o tipo das duas variáveis é igual usando gettype()
if (gettype($valor1) === gettype($valor2)) {
    // Se forem do mesmo tipo, exibe mensagem informando que os tipos são iguais e mostra os tipos de cada variável
    echo "Variáveis de tipos iguais! Primeiro valor do tipo " . gettype($valor1) . " e segundo valor do tipo " . gettype($valor2) . ".\n";
} else {
    // Se os tipos forem diferentes, exibe mensagem de erro informando os tipos diferentes
    echo "ERRO! Variáveis de tipos diferentes. Primeiro valor do tipo " . gettype($valor1) . " e segundo valor do tipo " . gettype($valor2) . ".\n";
}

?>
