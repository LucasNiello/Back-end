<?php

class Eletrodomestico
{
    private $nome;
    private $marca;
    private $potencia;
    private $garantia;
    private $voltagem;
    private $preco;

    public function __construct($nome, $marca, $potencia, $garantia, $voltagem, $preco)
    {
// =======================================================================================================================================================
// Erro: inversão de valores -> potencia e voltagem
// =======================================================================================================================================================
        $this->setNome($nome);
        $this->setMarca($marca);
        $this->setPotencia($potencia); // Corrigido
        $this->setGarantia($garantia);
        $this->setVoltagem($voltagem); // Corrigido
        $this->setPreco($preco);
    }

    public function exibirDados(){
        return "\n\n| INFO.\nDispositivo: {$this->getNome()}\nMarca: {$this->getMarca()}\nPotencia: {$this->getPotencia()}W\nGarantia: {$this->getGarantia()}\nVoltagem: {$this->getVoltagem()}V\nPreço: R$ {$this->getPreco()}";
    }

    public function setNome($nome)
    {
        $this->nome = ucwords(strtolower($nome));
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setMarca($marca)
    {
        $this->marca = ucwords(strtolower($marca));
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function setPotencia($potencia)
    {
        if ($potencia > 0) {
            $this->potencia = $potencia;
        } else {
            echo "\n[ERRO] Valor inválido!";
        }
    }

    public function getPotencia()
    {
        return $this->potencia;
    }

    public function setGarantia($garantia)
    {
        if (is_bool($garantia)) {
            $this->garantia = $garantia;
        } else {
            echo "\n[ERRO] Valor inválido! Insira apenas true/false.";
        }
    }

    public function getGarantia()
    {
        if ($this->garantia) {
            return "Ativa";
        } else {
            return "Expirada";
        }
    }

    public function setVoltagem($voltagem)
    {
        if ($voltagem > 0) {
            $this->voltagem = $voltagem;
        } else {
            echo "\n[ERRO] Valor inválido!";
        }
    }

    public function getVoltagem()
    {
        return $this->voltagem;
    }

    public function setPreco($preco)
    {
        if ($preco > 0) {
            $this->preco = number_format($preco, 2, ',', '.');
        } else {
            echo "\n[ERRO] Valor inválido!";
        }
    }

    public function getPreco()
    {
        return $this->preco;
    }
// =======================================================================================================================================================
// Erro: inversão de valores ligar/desligar
// =======================================================================================================================================================
    public function ligarDispositivo()
    {
        echo "\n\n{$this->nome} foi LIGADO(A)!";  // Corrigido
    }

    public function desligarDispositivo()
    {
        echo "\n{$this->nome} foi DESLIGADO(A)!"; // Corrigido
    }
}

// =======================================================================================================================================================
// Erro: falta do echo ao chamar o método exibirDados
// =======================================================================================================================================================
echo "----MICROONDAS----";
$eletro1 = new Eletrodomestico("Microondas", "Eletrolux", 1600, true, 127, 521.55);
$eletro1->ligarDispositivo();
$eletro1->desligarDispositivo();
echo $eletro1->exibirDados();    // Corrigido

echo "\n\n----GELADEIRA----";
$eletro2 = new Eletrodomestico("Geladeira", "Brastemp", 250, false, 220, 3695.69);
$eletro2->ligarDispositivo();
$eletro2->desligarDispositivo();
echo $eletro2->exibirDados();    // Corrigido

echo "\n\n----AR CONDICIONADO----";
$eletro3 = new Eletrodomestico("Ar Condicionado", "Sansung", 2000, true, 220, 2599);
$eletro3->ligarDispositivo();
$eletro3->desligarDispositivo();
echo $eletro3->exibirDados();    // Corrigido

// Fim do código da equipe RAMOS


// CONTINUAÇÃO
//Criar duas novas subclasses que herdem da classe Eletrodomestico: liquidificador e churrasqueira de controle remoto.



