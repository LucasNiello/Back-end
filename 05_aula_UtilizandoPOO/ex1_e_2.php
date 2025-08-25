<?php
// 1 ___ criar uma nova classe "molde" de objetos chamada "Cachorro" com os seguintes atributos: Nome, Idade, Raca, Castrado, Sexo.

// 2 __ Após a criação da classe crie 10 cachorros (10 objetos)


// Criando a classe Cachorro
class Cachorro {

    public $Nome;     // Nome do cachorro
    public $Idade;    // Idade em anos
    public $Raca;     // Raça do cachorro
    public $Castrado; // Booleano: true = sim, false = não
    public $Sexo;     // M ou F

    // Construtor para inicializar os atributos
    public function __construct($Nome, $Idade, $Raca, $Castrado, $Sexo) {
        $this->Nome = $Nome;
        $this->Idade = $Idade;
        $this->Raca = $Raca;
        $this->Castrado = $Castrado;
        $this->Sexo = $Sexo;
    }

    // Método para exibir informações do cachorro
    public function exibirInfo() {
        echo "Nome: {$this->Nome}, Idade: {$this->Idade} anos, Raça: {$this->Raca}, ";
        echo "Castrado: " . ($this->Castrado ? "Sim" : "Não") . ", ";
        echo "Sexo: {$this->Sexo}<br>";
    }
}

// Criando alguns objetos Cachorro (10 pra ser exato)
$c1 = new Cachorro("Thor", 3, "Labrador", true, "M");
$c2 = new Cachorro("Luna", 2, "Poodle", false, "F");
$c3 = new Cachorro("Max", 5, "Bulldog", true, "M");
$c4 = new Cachorro("Bella", 4, "Shih Tzu", true, "F");
$c5 = new Cachorro("Rex", 6, "Pastor Alemão", true, "M");
$c6 = new Cachorro("Maya", 1, "Golden Retriever", false, "F");
$c7 = new Cachorro("Zeus", 7, "Doberman", true, "M");
$c8 = new Cachorro("Nina", 3, "Yorkshire", false, "F");
$c9 = new Cachorro("Spike", 2, "Boxer", false, "M");
$c10 = new Cachorro("Dolly", 5, "Vira-lata", true, "F");

?>