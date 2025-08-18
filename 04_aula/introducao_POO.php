<?php
// Modelagem de dados sem a utilização de POO (Programação Orientada a Objetos)

$marca_carro1 = "Honda";
$modelo_carro1 = "Civic";
$ano_carro1 = 2016;
$revisao_carro1 = true;
$ndonos_carro1 = 2;

$marca_carro2 = "BMW";
$modelo_carro2 = "320i";
$ano_carro2 = 2012;
$revisao_carro2 = "false";
$ndonos_carro2 = "3";

$marca_carro3 = "Fitat";
$modelo_carro3 = "Uno";
$ano_carro3 = 2005;
$revisao_carro3 = "fasle";
$ndonos_carro3 = "1";

$marca_carro4 = "VW";
$modelo_carro4 = "Jetta";
$ano_carro4 = 2020;
$revisao_carro4 = "true";
$ndonos_carro4 = "7";

function revisaoFeita($rev) {
$rev=true;
return $rev ? "Revisão feita" : "Revisão não feita";
}

$revisao_carro3 = revisaoFeita($revisao_carro3); //resultado true


function novoDono($qtde_donos){
    return $qtde_donos + 1;
}

$Ndonos_carro4 = novoDono($Ndonos_carro4);


?>