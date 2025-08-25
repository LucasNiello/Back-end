<!-- 
 -- Exercício 5: Crie um método para a classe 'Cachorro' chamado de 'latir', no qual exibe uma mensagem "O cachorro $nome está latindo!" 
-- Exercício  6: Crie outro método para a classe 'Cachorro' chamado de 'marcar território', no qual exibe uma mensagem "O cachorro $nome da raça $raça está marcando território". 
-- Exercício 7: Crie um método para a classe 'Usuários' chamado de 'Testando Reservista' no qual testa se o usuário é homem e caso sim exiba uma mensagem "Apresente seu certificado de reservista do tiro de guerra!", caso não, exiba uma mensagem "Tudo certo". 
-- Exercício 8: Crie um método para a classe 'Usuários' chamado de 'Casamento' que teste se o estado civil é igual a 'Casado' e caso sim exiba a mensagem "Parabéns pelo seu casamento de $anos_casado anos!" e caso não, exiba uma mensagem de "oloco". O valor de anos de casamento será informado na hora de chamar o método para o objeto em específico. 
 -->

<?php

// Classe Cachorro
class Cachorro {
    public $nome;
    public $idade;
    public $raca;
    public $castrado;
    public $sexo;

    // Construtor com valores padrão
    public function __construct($nome = "", $idade = 0, $raca = "", $castrado = false, $sexo = "") {
        $this->nome = $nome;
        $this->idade = $idade;
        $this->raca = $raca;
        $this->castrado = $castrado;
        $this->sexo = $sexo;
    }

    // Exercício 5: método latir
    public function latir() {
        echo "O cachorro $this->nome está latindo!\n";
    }

    // Exercício 6: método marcarTerritorio
    public function marcarTerritorio() {
        echo "O cachorro $this->nome da raça $this->raca está marcando território.\n";
    }
}

// Classe Usuarios
class Usuarios {
    public $nome;
    public $sexo;         // "Masculino" ou "Feminino"
    public $estadoCivil;  // "Casado", "Solteiro" etc.

    // Exercício 7: método Testando Reservista
    public function testandoReservista() {
        if ($this->sexo === "Masculino") {
            echo "Apresente seu certificado de reservista do tiro de guerra!\n";
        } else {
            echo "Tudo certo\n";
        }
    }

    // Exercício 8: método Casamento
    public function casamento($anos_casado) {
        if ($this->estadoCivil === "Casado") {
            echo "Parabéns pelo seu casamento de $anos_casado anos!\n";
        } else {
            echo "oloco\n";
        }
    }
}

// -------------------------
// Testando os métodos

// Cachorros
$cachorro1 = new Cachorro("Rex", 3, "Vira-lata", true, "Masculino");
$cachorro1->latir();
$cachorro1->marcarTerritorio();

$cachorro2 = new Cachorro();
$cachorro2->nome = "Bolt";
$cachorro2->raca = "Labrador";
$cachorro2->latir();
$cachorro2->marcarTerritorio();

// Usuários
$usuario1 = new Usuarios();
$usuario1->nome = "Carlos";
$usuario1->sexo = "Masculino";
$usuario1->estadoCivil = "Casado";
$usuario1->testandoReservista();
$usuario1->casamento(5);

$usuario2 = new Usuarios();
$usuario2->nome = "Maria";
$usuario2->sexo = "Feminino";
$usuario2->estadoCivil = "Solteiro";
$usuario2->testandoReservista();
$usuario2->casamento(0);

?>
