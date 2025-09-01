<!-- 4. Encapsulamento de Produto
Crie uma classe Produto com os atributos privados nome, preco e
estoque.
o Implemente os setters e getters.
o Faça um objeto da classe e use os setters para definir os
valores.
o Exiba com os getters uma frase como:
O produto X custa R$ Y e possui Z unidades em estoque. -->

<?php
// Classe Produto
class Produto {
    // ATRIBUTOS PRIVADOS → Encapsulamento
    private $nome;
    private $preco;
    private $estoque;

    // SETTERS
    public function setNome($nome) {
        // Crítico: poderia validar se o nome não está vazio
        $this->nome = $nome;
    }

    public function setPreco($preco) {
        // Crítico: validar se é número e não negativo
        if (is_numeric($preco) && $preco >= 0) {
            $this->preco = $preco;
        } else {
            $this->preco = 0;
        }
    }

    public function setEstoque($estoque) {
        // Crítico: validar se é número inteiro e não negativo
        if (is_numeric($estoque) && $estoque >= 0) {
            $this->estoque = (int)$estoque;
        } else {
            $this->estoque = 0;
        }
    }

    // GETTERS
    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getEstoque() {
        return $this->estoque;
    }

    // Método para exibir informações formatadas
    public function exibirInformacoes() {
        return "O produto {$this->nome} custa R$ {$this->preco} e possui {$this->estoque} unidades em estoque.";
    }
}

// ====== Testando a classe ======
$produto = new Produto();

// Usando os setters para definir valores
$produto->setNome("Notebook");
$produto->setPreco(3500.50);
$produto->setEstoque(15);

// Exibindo com os getters/método
echo $produto->exibirInformacoes();
?>
