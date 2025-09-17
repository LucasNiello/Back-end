

<?php
//     Polimorfismo


//  O termo Polimorfimo significa "varias formas".
//  Associando isso a Programaçao Orientada a Objetos, o 
//  conceito se trata de varias classes e suas instancias (objetos) respondendo a uma mesmo metodo de formas diferentes. 
//  No exemplo do Interface da Aula_09, termos um metodo calcularArea() que responde de froma diferentes a classe Quadrado , a classe Pentagono
//  a  classe Circulo . Isso quer dizer que a funçao é a mesma - calcular a area da forma geometrica - mas a operaçao musa de acordo com a figura.

// Crie um metodo chamado "mover()", onde ele responde a varias formas diferente, para as sub-classes: Carro, Aviao, Barco e Elevador. Dica: Utilize Interfaces.
//  Interface Veiculo


// Interface Veiculo
interface Veiculo {
    public function Mover();
}

// Subclasse Carro
class Carro implements Veiculo {
    public $nome;

    public function __construct($nome) {
        $this->nome = $nome;
    }

    public function Mover() {
        echo "O carro {$this->nome} está se movendo pela estrada.\n";
    }
}

// Subclasse Avião
class Aviao implements Veiculo {
    public $nome;

    public function __construct($nome) {
        $this->nome = $nome;
    }

    public function Mover() {
        echo "O avião {$this->nome} está voando pelos céus.\n";
    }
}

// Subclasse Barco
class Barco implements Veiculo {
    public $nome;

    public function __construct($nome) {
        $this->nome = $nome;
    }

    public function Mover() {
        echo "O barco {$this->nome} está navegando pelo mar.\n";
    }
}

// Subclasse Elevador
class Elevador implements Veiculo {
    public $nome;

    public function __construct($nome) {
        $this->nome = $nome;
    }

    public function Mover() {
        echo "O elevador {$this->nome} está subindo ou descendo dentro do prédio.\n";
    }
}

// ===== Criando objetos de teste =====
$carro = new Carro("Fusca");
$aviao = new Aviao("Boing 747");
$barco = new Barco("Titanic");
$elevador = new Elevador("Schindler");

// Testando individualmente
echo "=== Testando objetos individualmente ===\n";
$carro->Mover();
$aviao->Mover();
$barco->Mover();
$elevador->Mover();

//========================================================================
// Exercícios 1, 2 e 3
//========================================================================

// Exercício 1 – Formas Geométricas
// Crie uma interface `Forma` com o método `calcularArea()`. Implemente as classes:
// - `Quadrado` (lado),
// - `Retangulo` (base e altura),
// - `Circulo` (raio).

// ====================== Interface ======================
interface Forma {
    public function calcularArea();
}

// ====================== Classes ======================

// QuadradoGeo
class QuadradoGeo implements Forma {
    private $lado;

    public function __construct($lado) {
        $this->lado = $lado;
    }

    public function calcularArea() {
        return $this->lado * $this->lado;
    }
}

// RetanguloGeo
class RetanguloGeo implements Forma {
    private $base;
    private $altura;

    public function __construct($base, $altura) {
        $this->base = $base;
        $this->altura = $altura;
    }

    public function calcularArea() {
        return $this->base * $this->altura;
    }
}

// CirculoGeo
class CirculoGeo implements Forma {
    private $raio;

    public function __construct($raio) {
        $this->raio = $raio;
    }

    public function calcularArea() {
        return pi() * pow($this->raio, 2);
    }
}

// ====================== Testando ======================
$quadradoGeo = new QuadradoGeo(5);
$retanguloGeo = new RetanguloGeo(4, 7);
$circuloGeo = new CirculoGeo(3);

echo "Área do Quadrado: " . $quadradoGeo->calcularArea() . "\n";   // 25
echo "Área do Retângulo: " . $retanguloGeo->calcularArea() . "\n"; // 28
echo "Área do Círculo: " . $circuloGeo->calcularArea() . "\n";     // 28.27433...

// Exercício 2 – Animais e Sons
// Crie uma classe pai `Animal` com o método `fazerSom()`. Implemente as classes:
// - `Cachorro` → "Au au!",
// - `Gato` → "Miau!",
// - `Vaca` → "Muuu!".

// ====================== Classe Pai ======================
class Animal {
    public function fazerSom() {
        echo "Som genérico de animal.\n";
    }
}

// ====================== Subclasses ======================

// CachorroAnimal
class CachorroAnimal extends Animal {
    public function __construct() {
        // Nenhum argumento necessário
    }
    public function fazerSom() {
        echo "Au au!\n";
    }
}

// GatoAnimal
class GatoAnimal extends Animal {
    public function __construct() {
        // Nenhum argumento necessário
    }
    public function fazerSom() {
        echo "Miau!\n";
    }
}

// VacaAnimal
class VacaAnimal extends Animal {
    public function __construct() {
        // Nenhum argumento necessário
    }
    public function fazerSom() {
        echo "Muuu!\n";
    }
}

// ====================== Testando ======================
$cachorroAnimal = new CachorroAnimal();
$gatoAnimal = new GatoAnimal();
$vacaAnimal = new VacaAnimal();

echo "Cachorro: ";
$cachorroAnimal->fazerSom();

echo "Gato: ";
$gatoAnimal->fazerSom();

echo "Vaca: ";
$vacaAnimal->fazerSom();

// Exercício 3 – Meios de Transporte
// Crie uma classe abstrata `Transporte` com o método `mover()`. Implemente as classes:

// - `Carro` → "O carro está andando na estrada",
// - `Barco` → "O barco está navegando no mar",
// - `Avião` → "O avião está voando no céu".
// - `Elevador` → "O Elevador está correndo pelo no prédio".

// ====================== Classe Abstrata ======================
abstract class Transporte {
    abstract public function mover();
}

// ====================== Subclasses ======================

// CarroTransp
class CarroTransp extends Transporte {
    public function mover() {
        echo "O carro está andando na estrada.\n";
    }
}

// BarcoTransp
class BarcoTransp extends Transporte {
    public function mover() {
        echo "O barco está navegando no mar.\n";
    }
}

// AviaoTransp
class AviaoTransp extends Transporte {
    public function mover() {
        echo "O avião está voando no céu.\n";
    }
}

// ElevadorTransp
class ElevadorTransp extends Transporte {
    public function mover() {
        echo "O elevador está correndo pelo prédio.\n";
    }
}

// ====================== Testando ======================
$carroTransp = new CarroTransp();
$barcoTransp = new BarcoTransp();
$aviaoTransp = new AviaoTransp();
$elevadorTransp = new ElevadorTransp();

echo "=== Testando Transporte ===\n";
$carroTransp->mover();
$barcoTransp->mover();
$aviaoTransp->mover();
$elevadorTransp->mover();

//======================================================================
// Exercício 4 – Notificações
//======================================================================

// Crie duas classes:
// - `Email` com o método `enviar()`, que retorna "Enviando email...",
// - `Sms` com o método `enviar()`, que retorna "Enviando SMS...".
// Classe Email

class Email {
    public function enviar() {
        return "Enviando email...";
    }
}

// Classe Sms
class Sms {
    public function enviar() {
        return "Enviando SMS...";
    }
}

// Função que aceita qualquer objeto com método enviar()
function notificar($meio) {
    echo $meio->enviar() . "\n";
}

// ===== Testando =====
$email = new Email();
$sms = new Sms();

notificar($email); // Saída: Enviando email...
notificar($sms);   // Saída: Enviando SMS...

//======================================================================
// Exercício 5 – Calculadora com Sobrecarga Simulada
//======================================================================
// Crie uma classe `Calculadora` com o método `somar()`.
// - Se receber 2 números, retorna a soma dos dois.
// - Se receber 3 números, retorna a soma dos três.

// OBS: Em PHP, não existe sobrecarga de métodos nativa como em Java ou C#. Mas podemos simular sobrecarga usando parâmetros opcionais ou a função func_get_args().


// Classe Calculadora
class Calculadora {

    // Método somar com sobrecarga simulada
    public function somar(...$numeros) {
        return array_sum($numeros);
    }
}

// ===== Testando =====
$calc = new Calculadora();

echo "Soma de 2 números: " . $calc->somar(5, 10) . "\n";      // Saída: 15
echo "Soma de 3 números: " . $calc->somar(3, 7, 2) . "\n";    // Saída: 12


//======================================================================
//EXTRA
//======================================================================

// Crie 3 Interfaces:
// Movel → Método mover()
// Abastecivel → Método abastecer($quantidade)
// Manutenivel → Método fazerManutencao()

// Crie as classes:
// Carro → Deve implementar Movel e Abastecivel.
// • mover() imprime que o carro está se movimentando.
// • abastecer($quantidade) imprime a quantidade abastecida.

// Bicicleta → Deve implementar Movel e Manutenivel.
// • mover() imprime que a bicicleta está pedalando.
// • fazerManutencao() imprime que a bicicleta foi lubrificada.

// Onibus → Deve implementar Movel, Abastecivel e Manutenivel.
// • mover() imprime que o ônibus está transportando passageiros.
// • abastecer($quantidade) imprime a quantidade abastecida.
// • fazerManutencao() imprime que o ônibus está passando por revisão.

interface Movel {
    public function mover();
}

interface Abastecivel {
    public function abastecer($quantidade);
}

interface Manutenivel {
    public function fazerManutencao();
}

// ====================== Classes ======================

// Classe CarroExtra → Movel + Abastecivel
class CarroExtra implements Movel, Abastecivel {
    public function mover() {
        echo "O carro está se movimentando.\n";
    }

    public function abastecer($quantidade) {
        echo "O carro foi abastecido com {$quantidade} litros.\n";
    }
}

// Classe BicicletaExtra → Movel + Manutenivel
class BicicletaExtra implements Movel, Manutenivel {
    public function mover() {
        echo "A bicicleta está pedalando.\n";
    }

    public function fazerManutencao() {
        echo "A bicicleta foi lubrificada.\n";
    }
}

// Classe OnibusExtra → Movel + Abastecivel + Manutenivel
class OnibusExtra implements Movel, Abastecivel, Manutenivel {
    public function mover() {
        echo "O ônibus está transportando passageiros.\n";
    }

    public function abastecer($quantidade) {
        echo "O ônibus foi abastecido com {$quantidade} litros.\n";
    }

    public function fazerManutencao() {
        echo "O ônibus está passando por revisão.\n";
    }
}

// ====================== Testando ======================
$carroExtra = new CarroExtra();
$bikeExtra = new BicicletaExtra();
$onibusExtra = new OnibusExtra();

echo "=== Testando Carro ===\n";
$carroExtra->mover();
$carroExtra->abastecer(50);

echo "\n=== Testando Bicicleta ===\n";
$bikeExtra->mover();
$bikeExtra->fazerManutencao();

echo "\n=== Testando Ônibus ===\n";
$onibusExtra->mover();
$onibusExtra->abastecer(200);
$onibusExtra->fazerManutencao();
