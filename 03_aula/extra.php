<!-- Faça um algoritmo que leia 2 valores digitados pelo usuário e interprete o tipo de variável que foi digitado. Caso os TIPOS sejam iguais, a seguinte mensagem deve ser exibida: "Variáveis de tipos iguais! Primeiro valor do tipo [type] e segundo valor do tipo [type]". Caso não, a seguinte mensagem: "ERRO! Variáveis de tipos diferentes. Primeiro valor do tipo [type] e segundo valor do tipo [type]"

Como a função de extrair o tipo da variável ainda não foi ensinada, o aluno deve pesquisar (SEM INTELIGENCIA ARTIFICIAL) como fazer isso.-->

 <?php
// Função para interpretar o tipo real do valor digitado
function interpretarTipo($valor) { // Declara a função que vai identificar o tipo do valor
    $valLower = strtolower($valor); // Converte o valor para minúsculas para facilitar a comparação com "true" ou "false"
    if ($valLower === 'true' || $valLower === 'false') { // Verifica se o valor digitado é "true" ou "false"
        return 'boolean'; // Retorna o tipo boolean
    }
    if (ctype_digit($valor)) { // Verifica se o valor contém apenas dígitos (números inteiros positivos)
        return 'integer'; // Retorna o tipo inteiro
    }
    if (is_numeric($valor) && strpos($valor, '.') !== false) { // Verifica se é um número e contém ponto decimal
        return 'double'; // ou float — Retorna o tipo numérico de ponto flutuante
    }
    return 'string'; // Se não for nenhum dos casos acima, considera como string
}

// Lê os valores
$valor1 = readline("Digite o primeiro valor: "); // Solicita e lê o primeiro valor do usuário
$valor2 = readline("Digite o segundo valor: "); // Solicita e lê o segundo valor do usuário

// Interpreta os tipos
$tipo1 = interpretarTipo($valor1); // Chama a função para descobrir o tipo do primeiro valor
$tipo2 = interpretarTipo($valor2); // Chama a função para descobrir o tipo do segundo valor

// Compara e mostra mensagem
if ($tipo1 === $tipo2) { // Verifica se os tipos identificados são iguais
    echo "Variáveis de tipos iguais! Primeiro valor do tipo $tipo1 e segundo valor do tipo $tipo2.\n"; // Mensagem para tipos iguais
} else { // Caso sejam diferentes
    echo "ERRO! Variáveis de tipos diferentes. Primeiro valor do tipo $tipo1 e segundo valor do tipo $tipo2.\n"; // Mensagem para tipos diferentes
}
?>
