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
// Classe que representa um FILME
class Filme {
    // Atributo público que guarda o título do filme
    public $titulo;

    // Construtor: executado automaticamente ao criar um novo filme
    // Recebe o título e o armazena no atributo da classe
    public function __construct($titulo) { 
        $this->titulo = $titulo; 
    }

    // Método que exibe o trailer do filme
    public function exibirTrailer() { 
        echo "Exibindo trailer de {$this->titulo}\n"; 
    }
}

// Classe que representa uma SESSÃO de cinema
class Sessao {
    // Cada sessão está ligada a um filme e tem um horário específico
    public $filme;
    public $horario;

    // Construtor: exige um objeto do tipo Filme e um horário
    public function __construct(Filme $filme, $horario) {
        $this->filme = $filme;
        $this->horario = $horario;
    }

    // Método para reservar um assento na sessão
    public function reservarAssento($assento) { 
        echo "Assento {$assento} reservado para {$this->filme->titulo}\n"; 
    }

    // Método que mostra os detalhes da sessão
    public function detalhes() { 
        echo "Sessão de {$this->filme->titulo} às {$this->horario}\n"; 
    }
}

// Classe que representa o INGRESSO de um cliente para uma sessão
class Ingresso {
    public $sessao;   // Guarda o objeto Sessao
    public $cliente;  // Guarda o objeto Cliente

    // Construtor: precisa de uma sessão e um cliente
    public function __construct(Sessao $sessao, Cliente $cliente) { 
        $this->sessao = $sessao; 
        $this->cliente = $cliente; 
    }

    // Método que gera o ingresso
    public function gerar() { 
        echo "Ingresso gerado para {$this->cliente->nome}\n"; 
    }

    // Método que valida o ingresso (confirma se é válido)
    public function validar() { 
        echo "Ingresso válido para {$this->sessao->filme->titulo}\n"; 
    }
}

// Classe que representa o CLIENTE
class Cliente {
    public $nome;

    // Construtor: define o nome do cliente ao criar o objeto
    public function __construct($nome) { 
        $this->nome = $nome; 
    }

    // Método que simula a compra de um ingresso
    public function comprarIngresso(Sessao $sessao) { 
        echo "{$this->nome} comprou ingresso para {$sessao->filme->titulo}\n"; 
    }

    // Método que apresenta o cliente
    public function apresentar() { 
        echo "Cliente: {$this->nome}\n"; 
    }
}

// -------------------------
// DEMONSTRAÇÃO DO SISTEMA
// -------------------------

// Criando um objeto Filme
$filme = new Filme("Matrix");
$filme->exibirTrailer(); // Chama o método que mostra o trailer

// Criando uma sessão para o filme
$sessao = new Sessao($filme, "20h");
$sessao->detalhes(); // Exibe os detalhes da sessão

// Criando um cliente
$cliente = new Cliente("Bruno");
$cliente->apresentar(); // Exibe o nome do cliente
$cliente->comprarIngresso($sessao); // Cliente compra o ingresso

// Reservando um assento na sessão
$sessao->reservarAssento("A10");

// Criando o ingresso do cliente para a sessão
$ingresso = new Ingresso($sessao, $cliente);
$ingresso->gerar();   // Gera o ingresso
$ingresso->validar(); // Valida o ingresso
?>

<!-- 
CENÁRIO 6 – Cinema
Classes: Filme, Sessao, Ingresso, Cliente

RELACIONAMENTOS:

1. Sessao → Filme
   - Tipo: Composição
   - Justificativa: Sessão depende do filme; se a sessão acabar, o vínculo com aquele filme na sessão deixa de existir no contexto.

2. Ingresso → Sessao
   - Tipo: Agregação
   - Justificativa: Ingresso referencia uma sessão, mas a sessão existe independentemente do ingresso.

3. Ingresso → Cliente
   - Tipo: Associação
   - Justificativa: Ingresso pertence a um cliente, mas cliente existe sem necessariamente ter um ingresso.

4. Cliente → Sessao
   - Tipo: Associação
   - Justificativa: Cliente compra ingresso para sessão, mas existe independentemente.

Obs: Relações foram identificadas considerando o ciclo de vida e dependência entre objetos.
 -->
