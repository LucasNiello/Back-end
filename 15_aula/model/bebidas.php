<?php
// 15_aula/model/bebidas.php

class Bebida {
    private $id;
    private $nome;
    private $categoria;
    private $volume;
    private $valor;
    private $qtd;

    public function __construct($nome, $categoria, $volume, $valor, $qtd, $id = null) {
        $this->nome = $nome;
        $this->categoria = $categoria;
        $this->volume = $volume;
        $this->valor = $valor;
        $this->qtd = $qtd;
        
        // Se um ID não for passado (ao ler do JSON), gera um novo ID único.
        $this->id = $id ?? uniqid();
    }

    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getCategoria() { return $this->categoria; }
    public function getVolume() { return $this->volume; }
    public function getValor() { return $this->valor; }
    public function getQtd() { return $this->qtd; }

    // A função toArray agora também inclui o ID
    public function toArray() {
        return [
            "id" => $this->id, // <-- ID INCLUÍDO
            "nome" => $this->nome,
            "categoria" => $this->categoria,
            "volume" => $this->volume,
            "valor" => $this->valor,
            "qtd" => $this->qtd
        ];
    }
}
?>