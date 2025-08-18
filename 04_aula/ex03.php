<?PHP
function precisaRevisao($revisao, $ano){
    if($revisao && $ano < 2020){
        return "Precisa de revisao.";
    } else {
        return "Revisao em dia.";
    }
}

// Exemplos de uso:
echo precisaRevisao(false, 2020) . "\n"; // Precisa de revisão
echo precisaRevisao(true, 2020) . "\n";  // Revisão em dia
echo precisaRevisao(false, 2023) . "\n"; // Precisa de revisão
echo precisaRevisao(true, 2019) . "\n";  // Precisa de revisão

?>