<?php
// 15_aula/model/bebidas.php

/**
 * Classe Model: Bebida
 * Representa o molde (a estrutura) de uma bebida no sistema.
 */
class Bebida {

    // -----------------------------------------------------------------
    // BLOCO: PROPRIEDADES (Atributos)
    // Define quais dados uma Bebida armazena.
    // -----------------------------------------------------------------
    private $id;
    private $nome;
    private $categoria;
    private $volume;
    private $valor;
    private $qtd;

    // -----------------------------------------------------------------
    // BLOCO: CONSTRUTOR (__construct)
    // É chamado ao criar um novo objeto (ex: new Bebida(...))
    // -----------------------------------------------------------------
    public function __construct($nome, $categoria, $volume, $valor, $qtd, $id = null) {
        // Atribui os valores recebidos às propriedades
        $this->nome = $nome;
        $this->categoria = $categoria;
        $this->volume = $volume;
        $this->valor = $valor;
        $this->qtd = $qtd;
        
        // Lógica de atribuição do ID:
        // O operador '??' (Coalescência Nula) verifica o $id.
        // 1. Se $id NÃO for NULL (ou seja, um ID foi passado, como ao carregar dados):
        //    $this->id recebe o valor de $id.
        // 2. Se $id FOR NULL (ou seja, é uma bebida nova):
        //    $this->id recebe um novo ID único gerado por uniqid().
        $this->id = $id ?? uniqid();
    }

    // -----------------------------------------------------------------
    // BLOCO: MÉTODOS GETTERS (Acessores)
    // Funções públicas para "ler" as propriedades privadas de forma segura.
    // -----------------------------------------------------------------
    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getCategoria() { return $this->categoria; }
    public function getVolume() { return $this->volume; }
    public function getValor() { return $this->valor; }
    public function getQtd() { return $this->qtd; }

    // -----------------------------------------------------------------
    // BLOCO: MÉTODOS UTILITÁRIOS
    // Funções que fornecem lógicas ou conversões úteis.
    // -----------------------------------------------------------------

    // A função toArray agora também inclui o ID
    public function toArray() {
        // Converte este objeto em um array associativo
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