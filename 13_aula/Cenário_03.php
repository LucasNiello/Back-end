<!-- Cenário 3 – Fantasia e Destino
John Snow, Papai Smurf, Deadpool e Dexter estão em uma jornada. Durante o
caminho, começa a chover, e eles precisam amar uns aos outros para superar as
dificuldades. No fim da jornada, eles celebram ao comer juntos.

Classes:

Personagem (subclasses: JohnSnow, PapaiSmurf, Deadpool, Dexter)

Jornada

Clima (ex.: Chuva)

Métodos:

Personagem.amar(Personagem outro)

Personagem.superarDificuldades()

Personagem.comerJunto(Comida)

Jornada.iniciar()

Clima.mudar()
================================================================================= -->
<?php
class Personagem {
    public $nome;
    public function __construct($nome) { $this->nome = $nome; }
    public function amar(Personagem $outro) { echo "{$this->nome} ama {$outro->nome}\n"; }
    public function superarDificuldades() { echo "{$this->nome} supera dificuldades\n"; }
    public function comerJunto() { echo "{$this->nome} comemora comendo junto\n"; }
    public function apresentar() { echo "Olá, eu sou {$this->nome}\n"; }
}

class Clima {
    public function mudar($condicao) { echo "Clima mudou para {$condicao}\n"; }
    public function atual() { echo "O clima está imprevisível\n"; }
}

// DEMONSTRAÇÃO
$john = new Personagem("John Snow");
$smurf = new Personagem("Papai Smurf");
$clima = new Clima();
$john->apresentar();
$smurf->apresentar();
$clima->mudar("chuva");
$john->amar($smurf);
$smurf->superarDificuldades();
$john->comerJunto();
?>
