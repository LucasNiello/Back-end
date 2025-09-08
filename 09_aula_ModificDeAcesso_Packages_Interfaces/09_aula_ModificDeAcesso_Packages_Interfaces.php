<!-- 
 
🔑 1. Modificadores de Acesso

Eles definem a visibilidade dos atributos e métodos de uma classe (quem pode acessar o quê).

public → pode ser acessado de qualquer lugar (dentro da classe, fora dela, em herança).

protected → só pode ser acessado dentro da própria classe e por classes filhas (herança).

private → só pode ser acessado dentro da própria classe (nem as filhas conseguem).

===============================================================================================================================
👉 Exemplo:

class Pessoa {
    public $nome;        // acessível em qualquer lugar
    protected $idade;    // acessível apenas na classe e filhas
    private $cpf;        // acessível só dentro da classe

    public function __construct($nome, $idade, $cpf) {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->cpf = $cpf;
    }
}
===============================================================================================================================

📦 2. Packages (Namespaces em PHP)

No PHP, o equivalente a "packages" de outras linguagens são os namespaces.
Eles servem para organizar o código e evitar conflitos de nomes entre classes, funções e constantes.

===============================================================================================================================
👉 Exemplo:

namespace Loja\Produtos;

class Produto {
    public function mostrar() {
        return "Produto da Loja";
    }
}


E para usar essa classe:

use Loja\Produtos\Produto;

$p = new Produto();
echo $p->mostrar();
===============================================================================================================================

🔄 3. Interfaces

Uma interface define um contrato:

Diz quais métodos uma classe deve obrigatoriamente implementar.

Não tem corpo de métodos (só a assinatura).

Uma classe pode implementar várias interfaces (PHP não tem herança múltipla de classes, mas tem de interfaces).

===============================================================================================================================
👉 Exemplo:

interface Animal {
    public function emitirSom();
}

class Cachorro implements Animal {
    public function emitirSom() {
        return "Au au!";
    }
}

class Gato implements Animal {
    public function emitirSom() {
        return "Miau!";
    }
}
===============================================================================================================================

✅ Resumo rápido:

Modificadores de acesso → controlam quem pode acessar atributos/métodos.

Packages (namespaces) → servem para organizar o código e evitar conflitos.

Interfaces → definem um contrato de métodos que as classes devem seguir. 

-->

<?php
// Modificadores de acesso:
//     Existem 3 tipos de public, protected e private.
//     Public NomeDoAtributo: métodos e atributos publicos

//     Private NomeDoAtributo: métodos e atributos privados para acesso somente dentro da classe. Utilizado para guardar dados sensiveis.

//     Pacotes (packages): Sintaxe logo no inicio do codigo, que atribui de onde os arquivos pertencem, evitando conflitos de nomes, ou seja, o caminho da pasta em que esle está contido.

//     NameSpace Aula 09;

//     Caso tenham mais arquivos que formam o backend de uma pagina web e que possuem a mesma raiz, O name espace será o mesmo.


    // Define o namespace para organizar o código e evitar conflitos de nomes
    namespace Aula_09; // Define o namespace para organizar o código e evitar conflitos de nomes

    interface Pagamento { // Interface Pagamento: obriga qualquer classe que a implemente a ter o método pagar
        public function pagar($valor);
    }

    class CartaoDeCredito implements Pagamento { // Classe CartaoDeCredito implementa a interface Pagamento
        public function pagar($valor) {
            return "Pagamento realizado no valor de R$ $valor com cartão de crédito\n."; // Retorna uma mensagem simulando pagamento com cartão de crédito
        }
    }

    class PIX implements Pagamento { // Classe PIX também implementa a interface Pagamento
        public function pagar($valor) {
            return "Realizado pagamento no valor de R$ $valor com PIX\n."; // Retorna uma mensagem simulando pagamento via PIX
        }
    }
    class dinheiroEspecie implements Pagamento { // Classe dinheiroEspecie implementa a interface Pagamento
        public function pagar($valor) {
            // $valorComDesconto = $valor -= $valor*0.1; // Outra forma de aplicar o desconto
            $valorComDesconto = $valor * 0.9; // Aplica desconto de 10%
            return "Pagamento realizado no valor de R$ $valorComDesconto em dinheiro (10% de desconto aplicado)\n."; // Retorna mensagem com desconto
        }
    }

// Testando interfaces e classes
$cred = new CartaoDeCredito();
echo "Testando cartão de crédito para pagamento: " . $cred->pagar(250); // Testa pagamento com cartão de crédito

$pix = new PIX();
echo "Testando pagamento via PIX: " . $pix->pagar(65); // Testa pagamento via PIX

$dinheiroEspecie = new dinheiroEspecie();
$valorOriginal = 320;
$valorComDesconto = $valorOriginal * 0.9; // Aplica desconto de 10%
echo "Pagamento em dinheiro com 10% de desconto: " . $dinheiroEspecie->pagar($valorOriginal);

// $dinheiro = new dinheiroEspecie();
// echo "Testando pagamento em dinheiro: " . $dinheiro->pagar(320); // Testa pagamento em dinheiro com desconto


?>
