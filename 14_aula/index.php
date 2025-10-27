<?php
require_once 'CRUD.php';
require_once 'AlunoDAO.php';

$dao = new AlunoDAO(); // Objeto da classe AlunoDAO para testar métodos

// CREATE
//================================================================
$aluno1 = new Aluno(1, "Josias", "Engenharia");
$dao->criarAlunos($aluno1);

$aluno2 = new Aluno(2, "Victor Hugo", "Manicure");
$dao->criarAlunos($aluno2);

$aluno3 = new Aluno(3, "Beatriz", "Eletricista");
$dao->criarAlunos($aluno3);

$aluno4 = new Aluno(4, "Aurora", "Arquitetura");
$dao->criarAlunos($aluno4);

$aluno5 = new Aluno(5, "Oliver", "Gestão");
$dao->criarAlunos($aluno5);

$aluno6 = new Aluno(6, "Amanda", "Luta");
$dao->criarAlunos($aluno6);

$aluno7 = new Aluno(7, "Geysa", "Engenharia");
$dao->criarAlunos($aluno7);

$aluno8 = new Aluno(8, "Joab", "Elétrica");
$dao->criarAlunos($aluno8);

$aluno9 = new Aluno(9, "Miguel", "Streamer");
$dao->criarAlunos($aluno9);
// READ
//================================================================
echo "Listagem inicial:\n";
foreach ($dao->lerAlunos() as $aluno) {
    echo "ID: " . $aluno->getId() . ", Nome: " . $aluno->getNome() . ", Curso: " . $aluno->getCurso() . "\n";
}

// ATUALIZAR aluno
//================================================================
$dao->atualizarAlunos(2, "Victor Manuel", "Jardinagem");
$dao->atualizarAlunos(8, "Joana (operou)", "Elétrica");
$dao->atualizarAlunos(9, "Miguel", "Designer");
$dao->atualizarAlunos(6, "Amanda", "Logística");
$dao->atualizarAlunos(5, "Oliver", "Eletricista");
$dao->atualizarAlunos(7, "Clotilde", "Engenharia");
// READ
//================================================================
echo "Listagem inicial:\n";
foreach ($dao->lerAlunos() as $aluno) {
    echo "ID: " . $aluno->getId() . ", Nome: " . $aluno->getNome() . ", Curso: " . $aluno->getCurso() . "\n";
}

// EXCLUIR aluno
//================================================================
$dao->excluirAlunos(3);
$dao->excluirAlunos(4);
$dao->excluirAlunos(7);


// READ
//================================================================
echo "Listagem inicial:\n";
foreach ($dao->lerAlunos() as $aluno) {
    echo "ID: " . $aluno->getId() . ", Nome: " . $aluno->getNome() . ", Curso: " . $aluno->getCurso() . "\n";
}
?>


<!-- By: Lucas Terminiello -->