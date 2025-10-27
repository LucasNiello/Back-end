<?php

class AlunoDAO { // Implementação das operações CRUD para a classe Aluno
    private $alunos = [];
   

    //============================================================
    //JSON
    //============================================================

    private $arquivo= "alunos.json"; // Criação do arquivo JSON para armazenamento

    // Construtor para carregar os dados do arquivo JSON ao instanciar o DAO
public function __construct() {
    if (file_exists($this->arquivo)) {
        $dadosJson = file_get_contents($this->arquivo);
        $dadosArray = json_decode($dadosJson, true);
        if ($dadosArray) {
            foreach ($dadosArray as $id => $info) {
                $this->alunos[$id] = new Aluno(
                    $info['id'],
                    $info['nome'],
                    $info['curso']
                );
            }
        }
    } else {
        // cria o arquivo vazio se não existir
        file_put_contents($this->arquivo, json_encode([], JSON_PRETTY_PRINT));
    }
}

private function salvarEmArquivo() { // Metodo auxiliar para salvar o array de alunos no arquivo JSON
    $dados = [];
    foreach ($this->alunos as $id => $aluno) {
        $dados[$id]=[
            'id' => $aluno->getId(),
            'nome' => $aluno->getNome(),
            'curso' => $aluno->getCurso()
        ];
    }
    file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
}


//CREATE
//============================================================
    public function criarAlunos(Aluno $aluno) {
        $this->alunos[$aluno->getId()] = $aluno;
        $this->salvarEmArquivo();
    }

    public function lerAlunos() {
        return $this->alunos;
    }
//Atualizar
//============================================================
    public function atualizarAlunos($id, $novoNome, $novoCurso) {
        if (isset($this->alunos[$id])) {
            $this->alunos[$id]->setNome($novoNome);
            $this->alunos[$id]->setCurso($novoCurso);

            // Mensagem automática sempre que atualizar
            echo "Aluno ID {$id} atualizado para {$novoNome} ({$novoCurso})\n";
        } else {
            echo "Aluno ID {$id} não encontrado.\n";
        }
        $this->salvarEmArquivo();

        /** ISSET()
         * Verifica se o índice 'id' existe no array 'alunos' e não é NULL
         * ISSET() é uma função PHP que determina se uma variável está definida e não é NULL
         * Retorna TRUE se a variável existe e tem valor diferente de NULL
         * Retorna FALSE se a variável não existe ou tem valor NULL
         */
    }

//EXCLUIR
//============================================================
    public function excluirAlunos($id) {
        if (isset($this->alunos[$id])) {
            unset($this->alunos[$id]);
            echo "Aluno ID {$id} excluído com sucesso.\n";
        } else {
            echo "Aluno ID {$id} não encontrado para exclusão.\n";
        }
        $this->salvarEmArquivo();
    }
}
//By: Lucas Terminiello
?>


