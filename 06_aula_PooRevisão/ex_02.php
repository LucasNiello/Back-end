// Crie 3 construtores sendo:
// 1º Construtor: Recebe 3 parámetros sendo eles $dia, $mes e Sano;
// 2° Construtor: Recebe 7 parâmetros sendo eles: $nome, $idade, $cpf, $telefone, $endereco, $estado_civil e $sexo;
// 3º Construtor: Recebe 5 parâmetros sendo eles: $marca, $nome, $categoria, $data_fabricacao e $data_venda;
// OBS: Escreva o exercicio em forma de comentário.

<?php
    class Data{
        public $dia;
        public $mes;
        public $ano;

        public function __construct($dia, $mes, $ano){
            $this->dia = $dia;
            $this->mes = $mes;
            $this->ano = $ano;
        }
    }

    class Pessoa{
        public $nome;
        public $idade;
        public $cpf;
        public $telefone;
        public $endereco;
        public $estado_civil;
        public $sexo;

        public function __construct($nome, $idade, $cpf, $telefone, $endereco, $estado_civil, $sexo){
            $this->nome = $nome;
            $this->idade = $idade;
            $this->cpf = $cpf;
            $this->telefone = $telefone;
            $this->endereco = $endereco;
            $this->estado_civil = $estado_civil;
            $this->sexo = $sexo;
        }
    }

    // class Produto{
    //     public $marca;
    //     public $nome;
    //     public $categoria;
    //     public $data_fabricacao;
    //     public $data_venda;

    //     public function __construct($marca, $nome, $categoria, $data_fabricacao, $data_venda){
    //         $this->marca = $marca;
    //         $this->nome = $nome;
    //         $this->categoria = $categoria;
    //         $this->data_fabricacao = $data_fabricacao;
    //         $this->data_venda = $data_venda;
    //     }
    // }

