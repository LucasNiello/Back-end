<?php

// Criar uma classe simples
class Carro { //criando classe (molde para criação de objetos)

    public $Marca; //criando atributo marca
    public $Modelo; //criando atributo modelo
    public $Ano; //criando atributo ano de fabric.
    public $Revisao; //criando atributo  "precisa de revisão?"
    public $N_donos; //criando atributo número de donos

    public function __construct($Marca, $Modelo, $Ano, $Revisao, $N_donos) {
        $this->Marca = $Marca;
        $this->Modelo = $Modelo;
        $this->Ano = $Ano;
        $this->Revisao = $Revisao;
        $this->N_donos = $N_donos;
    }
}

$carro1 = new Carro("Porsche", "911", 2020, false, 1);
$carro2 = new Carro("Mitsubishi", "Lancer", 1945, true, 1);
$carro3 = new Carro("Toyota", "Corolla", 2018, false, 2);
$carro4 = new Carro("Honda", "Civic", 2022, true, 1);
$carro5 = new Carro("Ford", "Mustang", 1969, true, 3);
$carro6 = new Carro("Chevrolet", "Camaro", 2015, false, 2);



?>