<?php
function exibirCarro($marca, $modelo, $ano, $revisao, $ndonos) {
    // Normaliza o valor recebido (aceita "sim", "SIM", "Sim", etc.)
    $revisao = strtolower($revisao) === "sim" ? "Sim" : "Não";

    return "O carro $marca $modelo, ano $ano, já passou por revisão: $revisao, número de donos: $ndonos.";
}

// Exemplos de uso:
echo exibirCarro("Nissan", "Versa", 2020, "Sim", 2) . "\n";
echo exibirCarro("Toyota", "Corolla", 2018, "não", 1);
?>
