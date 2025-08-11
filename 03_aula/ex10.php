<!-- ###################### 
10.-->

<?php
for ($i = 1; $i <= 5; $i++) {
    echo "\nMenu:\n";
    echo "1 - Olá\n";
    echo "2 - Data Atual\n";
    echo "3 - Sair\n";
    echo "Escolha uma opção: ";
    $opcao = trim(fgets(STDIN));

    switch ($opcao) {
        case 1:
            echo "Olá!\n";
            break;
        case 2:
            echo "Data atual: " . date("d/m/Y") . "\n";
            break;
        case 3:
            echo "Saindo...\n";
            exit;
        default:
            echo "Opção inválida\n";
    }
}
?>