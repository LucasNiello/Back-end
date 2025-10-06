<!-- Cenário 4 – Ciclo da Vida
Na Terra, pessoas podem engravidar, nascer, crescer, fazer escolhas e até doar
sangue para ajudar outras.

Classes:

Pessoa

Métodos:

Pessoa.engravida()

Pessoa.nascer()

Pessoa.crescer()

Pessoa.fazerEscolha(Escolha)

Pessoa.doarSangue(OutroPessoa)
================================================================================= -->
<?php
class Pessoa {
    public $nome;
    public function __construct($nome) { $this->nome = $nome; }
    public function engravida() { echo "{$this->nome} pode engravidar\n"; }
    public function nascer() { echo "{$this->nome} nasceu\n"; }
    public function crescer() { echo "{$this->nome} está crescendo\n"; }
    public function fazerEscolha($escolha) { echo "{$this->nome} escolheu {$escolha}\n"; }
    public function doarSangue() { echo "{$this->nome} doou sangue\n"; }
    public function apresentar() { echo "Sou {$this->nome}\n"; }
}

// DEMONSTRAÇÃO
$pessoa = new Pessoa("Carlos");
$pessoa->apresentar();
$pessoa->nascer();
$pessoa->crescer();
$pessoa->fazerEscolha("ser programador");
$pessoa->doarSangue();
?>

<?php
/*
CENÁRIO 4 – Ciclo da Vida
Classes: Pessoa

RELACIONAMENTOS:

- Todas as ações (nascer, crescer, fazerEscolha, doarSangue, engravidar) são métodos da própria classe.
- Não há relacionamento entre classes externas, logo:
  - Não há Associação, Agregação ou Composição.
*/
?>
