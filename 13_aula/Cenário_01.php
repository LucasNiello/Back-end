<!-- Exercícios para a extração de classes e métodos de

cenários reais

Cenário 1 – Viagem pelo Mundo
Um grupo de turistas vai visitar o Japão, o Brasil e o Acre. Em cada lugar da
Terra, eles poderão comer comidas típicas e nadar em rios ou praias.

Classes possíveis:

Turista

Local (com subclasses: Japao, Brasil, Acre)

ComidaTipica

RioOuPraia

Métodos:

Turista.visitar(Local)

Turista.comer(ComidaTipica)

Turista.nadar(RioOuPraia)
================================================================================ -->
<?php
class Local {
    public $nome;
    public function __construct($nome) { $this->nome = $nome; }
    public function descrever() { echo "Local: {$this->nome}\n"; }
}

class ComidaTipica {
    public $nome;
    public function __construct($nome) { $this->nome = $nome; }
    public function servir() { echo "Servindo: {$this->nome}\n"; }
}

class RioOuPraia {
    public $nome;
    public function __construct($nome) { $this->nome = $nome; }
    public function nadavel() { echo "{$this->nome} é nadável.\n"; }
}

class Turista {
    public $nome;
    public function __construct($nome) { $this->nome = $nome; }
    public function visitar(Local $local) { echo "{$this->nome} visita {$local->nome}\n"; }
    public function comer(ComidaTipica $comida) { echo "{$this->nome} come {$comida->nome}\n"; }
    public function nadar(RioOuPraia $lugar) { echo "{$this->nome} nada em {$lugar->nome}\n"; }
}

// DEMONSTRAÇÃO
$turista = new Turista("João");
$local = new Local("Japão");
$comida = new ComidaTipica("Sushi");
$praia = new RioOuPraia("Copacabana");
$local->descrever();
$comida->servir();
$praia->nadavel();
$turista->visitar($local);
$turista->comer($comida);
$turista->nadar($praia);
?>


<!-- 
CENÁRIO 1 – Viagem pelo Mundo
Classes: Local, ComidaTipica, RioOuPraia, Turista

RELACIONAMENTOS:

1. Turista → Local
   - Tipo: Associação
   - Justificativa: Turista “visita” um local, mas o local existe independentemente do turista.

2. Turista → ComidaTipica
   - Tipo: Associação
   - Justificativa: Turista “come” a comida típica, a comida existe independente do turista.

3. Turista → RioOuPraia
   - Tipo: Associação
   - Justificativa: Turista “nada” no rio ou praia, que existem separadamente.

Obs: Não há Agregação ou Composição nesse cenário, todos os relacionamentos são Associações simples.
 -->

