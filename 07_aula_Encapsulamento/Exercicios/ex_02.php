<!-- 2. Pessoa com atributos
Crie uma classe Pessoa com os atributos privados nome, idade e email.
o Utilize os setters para preencher os dados de uma pessoa.
o Em seguida, use os getters para exibir as informações dessa
pessoa em formato de frase, por exemplo:
O nome é Samuel, tem 22 anos e o email é samuel@exemplo.com. -->

<?php
// Definição da classe Pessoa
class Pessoa {
    // ATRIBUTOS PRIVADOS → Encapsulamento
    private $nome;
    private $idade;
    private $email;

    // CONSTRUTOR → inicializa os atributos no momento da criação do objeto
    public function __construct($nome, $idade, $email) {
        // Crítico: aqui poderia validar os dados antes de atribuir
        $this->nome = $nome;
        $this->idade = $idade;
        $this->email = $email;
    }

    // GETTERS → retornam os valores encapsulados
    public function getNome() {
        return $this->nome;
    }

    public function getIdade() {
        return $this->idade;
    }

    public function getEmail() {
        return $this->email;
    }

    // Método para exibir informações formatadas
    public function exibirInformacoes() {
        // Crítico: se algum dado viesse nulo, apareceria vazio aqui
        return "O nome é {$this->nome}, tem {$this->idade} anos e o email é {$this->email}.";
    }
}

// ====== Testando a classe ======
$p = new Pessoa("Samuel", 22, "samuel@exemplo.com");

// Exibindo com o método formatado
echo $p->exibirInformacoes();
?>
