<?php

class Animal {
    private $especie;
    private $habitat;
    private $sexo;
    private $alimentacao;

    public function __construct($especie, $habitat, $sexo, $alimentacao) {
       $this-> setEspecie($especie);
       $this-> setHabitat($habitat);
       $this-> setSexo($sexo);
       $this-> setAlimentacao($alimentacao);
    }

    public function getEspecie() {
    return $this->especie;
    }

    public function setEspecie($especie) {
        $this->especie = $especie;
    }

    public function getHabitat() {
        return $this->habitat;
    }

    public function setHabitat($habitat) {
        $this->habitat = $habitat;
    }

    public function getSexo() {
        return $this->sexo;
    }

    public function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    public function getAlimentacao() {
        return $this->alimentacao;
    }

    public function setAlimentacao($alimentacao) {
        $this->alimentacao = $alimentacao;
    }
}


class cachorro extends Animal {
    private $raca;
    private $porte;

    public function __construct($especie, $habitat, $sexo, $alimentacao, $raca, $porte) {
        parent::__construct($especie, $habitat, $sexo, $alimentacao);
        $this->setRaca($raca);
        $this->setPorte($porte);
    }

    public function getRaca() {
        return $this->raca;
    }

    public function setRaca($raca) {
        $this->raca = $raca;
    }

    public function getPorte() {
        return $this->porte;
    }

    public function setPorte($porte) {
        $this->porte = $porte;
    }
}

class pangolim extends Animal {
    private $N_escamas;

    public function __construct($especie, $habitat, $sexo, $alimentacao, $N_escamas) {
        parent::__construct($especie, $habitat, $sexo, $alimentacao);
        $this->setN_escamas($N_escamas);
    }

    public function getN_escamas() {
        return $this->N_escamas;
    }

    public function setN_escamas($N_escamas) {
        $this->N_escamas = $N_escamas;
    }
}

class Macaco extends Animal {
    private $tempo_dormindo;
    private $qtde_bananas_dia;
    private $cor;

    public function __construct($especie, $habitat, $sexo, $alimentacao, $cor, $tempo_dormindo, $qtde_bananas_dia) {
        parent::__construct($especie, $habitat, $sexo, $alimentacao);
        $this->setTempo_dormindo($tempo_dormindo);
        $this->setQtde_bananas_dia($qtde_bananas_dia);
    }

    public function setTempo_dormindo($tempo_dormindo) {
        $this->tempo_dormindo = $tempo_dormindo;
    }

    public function getTempo_dormindo() {
        return $this->tempo_dormindo;
    }

    public function setQtde_bananas_dia($qtde_bananas_dia) {
        $this->qtde_bananas_dia = $qtde_bananas_dia;
    }

    public function getQtde_bananas_dia() {
        return $this->qtde_bananas_dia;
    }
}

// ====================================================================================================================
// Crie uma classe filha "Gato" que herda de "Animal" e adicione o atributo "tipo_ronronar".
// ====================================================================================================================

class gato extends Animal {
    private $tipo_ronronar;

    public function __construct($especie, $habitat, $sexo, $alimentacao, $tipo_ronronar) {
        parent::__construct($especie, $habitat, $sexo, $alimentacao);
        $this->setTipo_ronronar($tipo_ronronar);
    }

    public function getTipo_ronronar() {
        return $this->tipo_ronronar;
    }

    public function setTipo_ronronar($tipo_ronronar) {
        $this->tipo_ronronar = $tipo_ronronar;
    }


}

?>

<!-- ==================================================================================================================
     ================================================================================================================== -->

<!-- “por que tem dois :: em parent::__construct?”

Explicação simples:

O :: é chamado de operador de resolução de escopo em PHP.

Ele serve para acessar métodos estáticos ou métodos/propriedades da classe pai diretamente pela classe.
Como você está chamando o construtor do pai, a sintaxe é:

parent::__construct()


parent → indica que você quer acessar algo da classe pai (não da atual).

:: → é o operador que conecta quem (no caso parent) com o que (no caso __construct).

__construct → é o construtor que está na classe pai.

Por que não é só um :?

Porque em PHP:

: sozinho → é usado para abrir blocos (if: endif;, for: endfor;) em alternative syntax.

:: → é o operador próprio de classes (static, parent, self).

Exemplo:

self::metodo();
parent::metodo();
Classe::metodoEstatico();


👉 Então parece que são “dois pontos duas vezes”, mas na real é um único operador ::. -->