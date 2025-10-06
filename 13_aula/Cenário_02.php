<!-- Cenário 2 – Heróis e Personagens
O Batman, o Superman e o Homem-Aranha estão em uma missão. Eles precisam
fazer treinamentos especiais no Cotil e, depois, irão ao shopping para doar
brinquedos às crianças.

Classes:

Heroi (subclasses: Batman, Superman, HomemAranha)

Treinamento

Shopping

Brinquedo

Crianca

Métodos:

Heroi.treinar(Treinamento)

Heroi.doarBrinquedo(Crianca)

Shopping.receberDoacao(Heroi, Brinquedo)
=================================================================================-->

<?php
class Heroi {
    public $nome;
    public function __construct($nome) { $this->nome = $nome; }
    public function treinar($lugar) { echo "{$this->nome} treina em {$lugar}\n"; }
    public function doarBrinquedo($local) { echo "{$this->nome} doa brinquedo em {$local}\n"; }
    public function apresentar() { echo "Sou o herói {$this->nome}\n"; }
}

class Crianca {
    public $nome;
    public function __construct($nome) { $this->nome = $nome; }
    public function receberBrinquedo() { echo "{$this->nome} recebeu um brinquedo\n"; }
}

// DEMONSTRAÇÃO
$heroi = new Heroi("Batman");
$crianca = new Crianca("Maria");
$heroi->apresentar();
$heroi->treinar("Cotil");
$heroi->doarBrinquedo("Shopping");
$crianca->receberBrinquedo();
?>

<?php
/*
CENÁRIO 2 – Heróis e Personagens
Classes: Heroi, Crianca

RELACIONAMENTOS:

1. Heroi → Crianca
   - Tipo: Associação
   - Justificativa: Herói “doa brinquedo” para a criança, mas a criança existe independentemente do herói.

Obs: Não há Agregação ou Composição nesse cenário, é uma relação de Associação direta.
*/
?>
