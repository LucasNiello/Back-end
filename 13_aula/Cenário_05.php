<!-- Cenário 5 – Analise o problema com linguagem natural
"Um sistema de biblioteca deve permitir que usuários (alunos e professores)
façam empréstimos de livros e revistas."

Classes:

Usuario (subclasses: Aluno, Professor)

Livro

Revista

Emprestimo

Métodos:

Usuario.realizarEmprestimo(Obra)

Usuario.devolver(Obra)

Emprestimo.registrar()
================================================================================== -->
<?php
declare(strict_types=1); // Ativa tipagem mais rigorosa no PHP

// Classe base: representa qualquer tipo de obra da biblioteca (livro, revista, etc.)
class Obra {
    // Os atributos são privados para proteger os dados (ENCAPSULAMENTO)
    private string $titulo;
    private bool $emprestado = false;
    private ?Usuario $emprestadoPor = null; // Guarda quem pegou emprestado (ou null se estiver disponível)

    public function __construct(string $titulo) {
        $this->titulo = $titulo;
    }

    // Métodos "get" permitem acessar informações privadas com segurança
    public function getTitulo(): string {
        return $this->titulo;
    }

    public function isEmprestado(): bool {
        return $this->emprestado;
    }

    public function getEmprestadoPor(): ?Usuario {
        return $this->emprestadoPor;
    }

    // Método que tenta emprestar a obra
    // Retorna true se o empréstimo for bem-sucedido, false se já estiver emprestada
    public function emprestar(Usuario $usuario): bool {
        if ($this->emprestado) {
            return false;
        }
        $this->emprestado = true;
        $this->emprestadoPor = $usuario;
        return true;
    }

    // Método que marca a obra como devolvida
    public function devolver(): void {
        $this->emprestado = false;
        $this->emprestadoPor = null;
    }

    // Método que exibe uma descrição simples
    public function descrever(): void {
        echo "Obra: {$this->titulo}\n";
    }
}

// Classe Livro (HERANÇA da classe Obra)
class Livro extends Obra {
    public function folhear(): void {
        echo "Folheando o livro {$this->getTitulo()}\n";
    }
}

// Classe Revista (também herda de Obra)
class Revista extends Obra {
    public function lerArtigo(): void {
        echo "Lendo artigo da revista {$this->getTitulo()}\n";
    }
}

// Classe base para usuários da biblioteca
class Usuario {
    protected string $nome;

    public function __construct(string $nome) {
        $this->nome = $nome;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function apresentar(): void {
        echo "Usuário: {$this->nome}\n";
    }

    // Método que tenta realizar um empréstimo
    public function realizarEmprestimo(Obra $obra): void {
        if ($obra->emprestar($this)) {
            echo "{$this->nome} pegou '{$obra->getTitulo()}' emprestado.\n";
        } else {
            $quemTem = $obra->getEmprestadoPor()?->getNome() ?? "alguém";
            echo "Não foi possível: '{$obra->getTitulo()}' já está com {$quemTem}.\n";
        }
    }

    // Método para devolver uma obra
    public function devolver(Obra $obra): void {
        if ($obra->isEmprestado() && $obra->getEmprestadoPor() === $this) {
            $obra->devolver();
            echo "{$this->nome} devolveu '{$obra->getTitulo()}'.\n";
        } else {
            echo "{$this->nome} não pode devolver '{$obra->getTitulo()}' (não está com ele).\n";
        }
    }
}

// Subclasse Aluno (HERDA de Usuario)
class Aluno extends Usuario {
    public function estudar(): void {
        echo "{$this->nome} está estudando.\n";
    }
}

// Subclasse Professor (HERDA de Usuario)
class Professor extends Usuario {
    public function lecionar(): void {
        echo "{$this->nome} está lecionando.\n";
    }
}

// -------------------------
// DEMONSTRAÇÃO DO SISTEMA
// -------------------------

$livro = new Livro("Dom Casmurro");
$revista = new Revista("Super Interessante");
$aluno = new Aluno("José");
$professor = new Professor("Ana");

// Ações específicas
$livro->folhear();
$revista->lerArtigo();

$aluno->apresentar();
$professor->apresentar();

// José pega o livro
$aluno->realizarEmprestimo($livro);

// Ana tenta pegar o mesmo livro (falha)
$professor->realizarEmprestimo($livro);

// José devolve o livro
$aluno->devolver($livro);

// Ana agora consegue pegar
$professor->realizarEmprestimo($livro);

// Ana tenta devolver uma obra que realmente está com ela (ok)
$professor->devolver($livro);

// José tenta devolver a revista sem ter pegado (falha)
$aluno->devolver($revista);
?>
<?php
/*
CENÁRIO 5 – Biblioteca
Classes: Obra, Livro, Revista, Usuario, Aluno, Professor

RELACIONAMENTOS:

1. Livro → Obra
   - Tipo: Herança (não é Associação, Agregação ou Composição, mas vale mencionar)
   - Justificativa: Livro é um tipo de Obra.

2. Revista → Obra
   - Tipo: Herança
   - Justificativa: Revista é um tipo de Obra.

3. Aluno → Usuario
   - Tipo: Herança
   - Justificativa: Aluno é um tipo de usuário.

4. Professor → Usuario
   - Tipo: Herança
   - Justificativa: Professor é um tipo de usuário.

5. Usuario → Obra
   - Tipo: Associação
   - Justificativa: Usuario realiza empréstimos de obras, mas a obra existe independentemente do usuário.

Obs: Não há Composição ou Agregação explícita.
*/
?>
