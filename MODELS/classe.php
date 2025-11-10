<?php
// model/sua_classe.php

// !!! TROQUE 'SUA_CLASSE_AQUI' PELO NOME DO SEU ITEM (ex: Cereal) !!!
class SUA_CLASSE_AQUI {
    
    // O ID é genérico, mantenha ele
    private $id; 

    // !!! TROQUE ESTES CAMPOS PELOS CAMPOS DO SEU ITEM !!!
    // Exemplo para Cereal:
    // private $nome;
    // private $marca;
    // private $peso;
    // private $valor;
    // private $qtdEstoque;
    // !!! FIM DOS CAMPOS !!!
    
    private $nome;
    private $categoria;
    private $volume;
    private $valor;
    private $qtd;


    // !!! ATUALIZE O CONSTRUTOR COM OS SEUS CAMPOS !!!
    public function __construct($nome, $categoria, $volume, $valor, $qtd, $id = null) {
        
        // !!! ATUALIZE AQUI DENTRO TAMBÉM !!!
        $this->nome = $nome;
        $this->categoria = $categoria;
        $this->volume = $volume;
        $this->valor = $valor;
        $this->qtd = $qtd;
        
        // Isso cuida da geração do ID, mantenha
        $this->id = $id ?? uniqid();
    }

    // O getId() é genérico, mantenha
    public function getId() { return $this->id; }

    // !!! CRIE UM 'get' PARA CADA CAMPO SEU !!!
    // Exemplo:
    // public function getMarca() { return $this->marca; }
    // public function getPeso() { return $this->peso; }
    
    public function getNome() { return $this->nome; }
    public function getCategoria() { return $this->categoria; }
    public function getVolume() { return $this->volume; }
    public function getValor() { return $this->valor; }
    public function getQtd() { return $this->qtd; }


    // !!! ATUALIZE O toArray() COM SEUS CAMPOS !!!
    // Isso é MUITO IMPORTANTE para salvar no JSON
    public function toArray() {
        return [
            "id" => $this->id, // Mantenha o ID
            
            // !!! COLOQUE SEUS CAMPOS AQUI !!!
            "nome" => $this->nome,
            "categoria" => $this->categoria,
            "volume" => $this->volume,
            "valor" => $this->valor,
            "qtd" => $this->qtd
        ];
    }
}
?>