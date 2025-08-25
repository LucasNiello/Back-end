<?php
    class Moto {
        public $marca;
        public $modelo;
        public $cor;
        public $ano;
        public $cilindradas;
    }

    $moto1 = new Moto();
    $moto1->marca = "Honda";
    $moto1->modelo = "CG 160";
    $moto1->cor = "Vermelha";
    $moto1->ano = 2022;
    $moto1->cilindradas = 160;

    $moto2 = new Moto();
    $moto2->marca = "Yamaha";
    $moto2->modelo = "Fazer 250";
    $moto2->cor = "Azul";
    $moto2->ano = 2021;
    $moto2->cilindradas = 250;

    $moto3 = new Moto();
    $moto3->marca = "Harley Davidson";
    $moto3->modelo = "Iron 883";
    $moto3->cor = "Preta";
    $moto3->ano = 2023;
    $moto3->cilindradas = 883;

?>