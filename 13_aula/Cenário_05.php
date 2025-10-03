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
class Obra {
    public $titulo;
    public function __construct($titulo) { $this->titulo = $titulo; }
    public function descrever() { echo "Obra: {$this->titulo}\n"; }
}

class Livro extends Obra {
    public function folhear() { echo "Folheando o livro {$this->titulo}\n"; }
}

class Revista extends Obra {
    public function lerArtigo() { echo "Lendo artigo da revista {$this->titulo}\n"; }
}

class Usuario {
    public $nome;
    public function __construct($nome) { $this->nome = $nome; }
    public function realizarEmprestimo(Obra $obra) { echo "{$this->nome} pegou {$obra->titulo}\n"; }
    public function devolver(Obra $obra) { echo "{$this->nome} devolveu {$obra->titulo}\n"; }
    public function apresentar() { echo "Usuário: {$this->nome}\n"; }
}

class Aluno extends Usuario {
    public function estudar() { echo "{$this->nome} está estudando\n"; }
}

class Professor extends Usuario {
    public function lecionar() { echo "{$this->nome} está lecionando\n"; }
}

// DEMONSTRAÇÃO
$livro = new Livro("Dom Casmurro");
$revista = new Revista("Super Interessante");
$aluno = new Aluno("José");
$professor = new Professor("Ana");

$livro->folhear();
$revista->lerArtigo();
$aluno->apresentar();
$professor->apresentar();
$aluno->realizarEmprestimo($livro);
$professor->realizarEmprestimo($revista);
$aluno->devolver($livro);
$professor->devolver($revista);
?>
