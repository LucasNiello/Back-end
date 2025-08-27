<!-- 
 REVISÃO
 -> Criação de Classes
-> Criação de Objetos
-> Criação de Métodos 
-->

<!-- 
AULA 06
-> Metodos
-> Construtores
 -->

<?php
    class Produtos{
        public $nome;
        public $categoria;
        public $fornecedor;
        public $qtde_estoque;

        //metodos
        public function atualizarEstoque($qtde_vendida){
            // $this->qtde_estoque = $qtde_estoque - $qtde_vendida; ao invés de fazer assim, fazemos assim:
            $this->qtde_estoque -= $qtde_vendida;
            return $this->qtde_estoque;
        }

        // ✅ O construtor precisa ficar DENTRO da classe
        public function __construct($nome, $categoria, $fornecedor, $qtde_estoque){
            $this->nome = $nome;
            $this->categoria = $categoria;
            $this->fornecedor = $fornecedor;
            $this->qtde_estoque = $qtde_estoque;
        }
    }

        // ❌ Aqui você usou "ProdutosMercado" mas a classe é "Produtos"
        // $produto1 = new ProdutosMercado();
        // $produto1->nome = "Suco Tang";
        // $produto1->categoria = "Bebidas";
        // $produto1->fornecedor = "Mondelez";
        // $produto1->qtde_estoque = 200;

        // $produto2 = new ProdutosMercado();
        // $produto2->nome = "Energético Monster";
        // $produto2->categoria = "Bebidas";
        // $produto2->fornecedor = "Monster Inc";
        // $produto2->qtde_estoque = 150;

        // ✅ Correto: instanciando objetos com a classe "Produtos"
        $produto1 = new Produtos("Suco Tang", "Bebidas", "Mondelez", 200);
        $produto2 = new Produtos("Energético Monster", "Bebidas", "Monster Inc", 150);

?>
