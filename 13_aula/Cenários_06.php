<!-- Cenário 6 – Leia o enunciado do problema
"Um sistema de cinema deve permitir que clientes comprem ingressos para
sessões de filmes." 

Classes:

Cliente

Ingresso

Sessao

Filme

Métodos:

Cliente.comprarIngresso(Sessao)

Sessao.reservarAssento()

Ingresso.gerar()

================================================================================== -->
<?php
class Filme {
    public $titulo;
    public function __construct($titulo) { $this->titulo = $titulo; }
    public function exibirTrailer() { echo "Exibindo trailer de {$this->titulo}\n"; }
}

class Sessao {
    public $filme;
    public $horario;
    public function __construct(Filme $filme, $horario) {
        $this->filme = $filme;
        $this->horario = $horario;
    }
    public function reservarAssento($assento) { echo "Assento {$assento} reservado para {$this->filme->titulo}\n"; }
    public function detalhes() { echo "Sessão de {$this->filme->titulo} às {$this->horario}\n"; }
}

class Ingresso {
    public $sessao;
    public $cliente;
    public function __construct(Sessao $sessao, Cliente $cliente) { $this->sessao = $sessao; $this->cliente = $cliente; }
    public function gerar() { echo "Ingresso gerado para {$this->cliente->nome}\n"; }
    public function validar() { echo "Ingresso válido para {$this->sessao->filme->titulo}\n"; }
}

class Cliente {
    public $nome;
    public function __construct($nome) { $this->nome = $nome; }
    public function comprarIngresso(Sessao $sessao) { echo "{$this->nome} comprou ingresso para {$sessao->filme->titulo}\n"; }
    public function apresentar() { echo "Cliente: {$this->nome}\n"; }
}

// DEMONSTRAÇÃO
$filme = new Filme("Matrix");
$filme->exibirTrailer();
$sessao = new Sessao($filme, "20h");
$sessao->detalhes();
$cliente = new Cliente("Bruno");
$cliente->apresentar();
$cliente->comprarIngresso($sessao);
$sessao->reservarAssento("A10");
$ingresso = new Ingresso($sessao, $cliente);
$ingresso->gerar();
$ingresso->validar();
?>
