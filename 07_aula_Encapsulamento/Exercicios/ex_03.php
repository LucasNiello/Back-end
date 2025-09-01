<!-- 3. Validação em setter
Crie uma classe Aluno com os atributos privados nome e nota.
o No setNota, garanta que a nota só pode ser entre 0 e 10. Se o
valor for inválido, armazene 0.
o Teste criando alunos com notas válidas e inválidas, exibindo os
resultados com getNota(). -->

<?php
// Classe Aluno
class Aluno {
    // ATRIBUTOS PRIVADOS → Encapsulamento
    private $nome;
    private $nota;

    // CONSTRUTOR → inicializa o nome e a nota
    public function __construct($nome, $nota) {
        $this->nome = $nome;
        $this->setNota($nota); 
        // Crítico: usamos o setter aqui para já aplicar a validação na criação
    }

    // SETTER da nota com validação
    public function setNota($nota) {
        // Garante que a nota esteja entre 0 e 10
        if (is_numeric($nota) && $nota >= 0 && $nota <= 10) {
            $this->nota = $nota;
        } else {
            // Crítico: valor inválido → armazenar como 0
            $this->nota = 0;
        }
    }

    // GETTER do nome
    public function getNome() {
        return $this->nome;
    }

    // GETTER da nota
    public function getNota() {
        return $this->nota;
    }
}

// ====== Testando a classe ======

// Nota válida
$aluno1 = new Aluno("Ana", 8);
echo "Aluno: " . $aluno1->getNome() . " - Nota: " . $aluno1->getNota() . "<br>";

// Nota inválida (maior que 10 → vira 0)
$aluno2 = new Aluno("Bruno", 15);
echo "Aluno: " . $aluno2->getNome() . " - Nota: " . $aluno2->getNota() . "<br>";

// Nota inválida (texto → vira 0)
$aluno3 = new Aluno("Carlos", "abc");
echo "Aluno: " . $aluno3->getNome() . " - Nota: " . $aluno3->getNota();
?>
