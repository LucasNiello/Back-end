<!-- 1. Criação básica
Crie uma classe chamada Carro com os atributos privados marca e
modelo.
o Implemente os métodos setMarca, getMarca, setModelo e getModelo.
o Crie um objeto da classe e use os setters para atribuir valores
e os getters para exibir os dados. -->

<?php

// Definição da classe Carro
class Carro {
    // Atributos privados - só acessíveis por métodos da classe
    private $marca;
    private $modelo;

    // Adicionando construtor que espera 2 argumentos
    public function __construct($marca = null, $modelo = null) {
        $this->marca = $marca;
        $this->modelo = $modelo;
    }

    // Parte crítica: setter recebe e atribui valor ao atributo encapsulado
    public function setMarca($marca) {
        $this->marca = $marca; // Crítico: entrada de dados externa
    }

    // Parte crítica: getter devolve valor protegido ao mundo externo
    public function getMarca() {
        return $this->marca; // Crítico: saída de dados privados
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo; // Crítico: define o modelo do carro
    }

    public function getModelo() {
        return $this->modelo; // Crítico: retorna o modelo do carro
    }
}
// Criando um objeto da classe Carro
$carro = new Carro();

// Usando os setters para definir os valores
$carro->setMarca("Toyota");
$carro->setModelo("Corolla");

// Usando os getters para mostrar os valores
echo "Marca: " . $carro->getMarca() . "<br>";
echo "Modelo: " . $carro->getModelo() . "<br>";

?>
