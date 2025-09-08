<?php
// Criando uma interface simples

// Crie uma interface Forma, que oobrigue as classes que a implementam a ter um método calcularArea().
// crie as classes Quadrado e Circulo que implementam a interface Forma e fornecem suas próprias implementações do método calcularArea().

//Area quadrado = lado * lado
//Area circulo = pi * raio^2

interface Forma {
    public function calcularArea();
}

class Quadrado implements Forma {
    private $lado;

    public function __construct($lado) {
        $this->lado = $lado;
    }

    public function calcularArea() {
        return $this->lado * $this->lado;
    }
}

class Circulo implements Forma {
    private $raio;

    public function __construct($raio) {
        $this->raio = $raio;
    }

    public function calcularArea() {
        return pi() * pow($this->raio, 2); // pow($this->raio, 2) eleva o valor de $this->raio ao quadrado
    }
}


// Exemplo de uso:
$quadrado = new Quadrado(4); // Cria um objeto Quadrado com lado 4
echo "Área do quadrado: " . $quadrado->calcularArea() . PHP_EOL; // Exibe a área do quadrado

$circulo = new Circulo(3); // Cria um objeto Circulo com raio 3
echo "Área do círculo: " . $circulo->calcularArea() . PHP_EOL; // Exibe a área do círculo

/**
 * Observação:
 * PHP_EOL é uma constante do PHP que representa o caractere de quebra de linha apropriado para o sistema operacional onde o script está sendo executado.
 * No Windows, equivale a "\r\n"; no Linux/Unix, equivale a "\n".
 */

echo "Digite o lado do quadrado: ";
$inputLado = trim(fgets(STDIN));
$quadrado2 = new Quadrado($inputLado);
echo "Área do quadrado informado: " . $quadrado2->calcularArea() . PHP_EOL;

echo "Digite o raio do círculo: ";
$inputRaio = trim(fgets(STDIN));
$circulo2 = new Circulo($inputRaio);
echo "Área do círculo informado: " . $circulo2->calcularArea() . PHP_EOL;



// Agora crie mais duas classes e calcule a area dos mesmos.
// 1 -> Pentágono
// 2 -> Heptágono

class Pentagono implements Forma {
    private $lado;
    private $apotema; // apotema é a linha que vai do centro do polígono até o meio de um dos lados. ela é usada para calcular a área de polígonos regulares.

    public function __construct($lado, $apotema) {
        $this->lado = $lado;
        $this->apotema = $apotema; 
    }

    public function calcularArea() {
        // Área = (Perímetro * Apótema) / 2
        $perimetro = 5 * $this->lado;
        return ($perimetro * $this->apotema) / 2;
    }
}

class Heptagono implements Forma {
    private $lado;
    private $apotema;

    public function __construct($lado, $apotema) {
        $this->lado = $lado;
        $this->apotema = $apotema; 
    }

    public function calcularArea() {
        // Área = (Perímetro * Apótema) / 2
        $perimetro = 7 * $this->lado;
        return ($perimetro * $this->apotema) / 2;
    }
}

// Leitura dos dados do usuário para Pentágono
echo "Digite o lado do pentágono: ";
$ladoPentagono = trim(fgets(STDIN));
echo "Digite a apótema do pentágono: ";
$apotemaPentagono = trim(fgets(STDIN));
$pentagono = new Pentagono($ladoPentagono, $apotemaPentagono);
echo "Área do pentágono: " . $pentagono->calcularArea() . PHP_EOL;

// Leitura dos dados do usuário para Heptágono
echo "Digite o lado do heptágono: ";
$ladoHeptagono = trim(fgets(STDIN));
echo "Digite a apótema do heptágono: ";
$apotemaHeptagono = trim(fgets(STDIN));
$heptagono = new Heptagono($ladoHeptagono, $apotemaHeptagono);
echo "Área do heptágono: " . $heptagono->calcularArea() . PHP_EOL;


/*

             /\
            /  \
           /    \
          /      \
         /   a    \
        /          \
       /------------\
      /\            /\
     /  \          /  \
    /    \        /    \
   /      \      /      \
  /        \    /        \
 /          \  /          \
/------------\/------------\
          Perímetro
 */



?>