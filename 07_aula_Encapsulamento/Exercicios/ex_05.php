<!-- 5. Alteração de dados
Crie uma classe Funcionario com os atributos privados nome e salario.
o Crie métodos setNome, getNome, setSalario e getSalario.
o Defina os valores de um funcionário com os setters.
o Depois, altere o nome e o salário usando novamente os
setters.
o Mostre, com os getters, que os valores realmente foram
modificados. -->

<?php

//Classe Funcionario
class Funcionario {
    // ATRIBUTOS PRIVADOS → Encapsulamento
    private $nome;
    private $salario;

    // SETTERS
    public function setNome($nome) {
        // Crítico: poderia validar se o nome não está vazio
        $this->nome = $nome;
    }

    public function setSalario($salario) {
        // Crítico: validar se é número e não negativo
        if (is_numeric($salario) && $salario >= 0) {
            $this->salario = $salario;
        } else {
            $this->salario = 0;
        }
    }

    // GETTERS
    public function getNome() {
        return $this->nome;
    }

    public function getSalario() {
        return $this->salario;
    }
}

// Exibindo valores iniciais
echo "Funcionário: " . $func-> getNome() . " - Salário: R$ " . $func->getSalario() . $func-> getSalario();;

?>