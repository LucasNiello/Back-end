<?php

/**
 * Classe Emprestimo (Entidade/Model)
 * Representa um registro único na tabela 'emprestimos' do banco de dados.
 * É um container de dados, não contém lógica de negócio ou acesso ao DB.
 */
class Emprestimo {
    // --- Atributos/Propriedades (Mapeiam as colunas da tabela) ---
    private $id;                    // Chave primária do empréstimo.
    private $livroId;               // Chave estrangeira (ID do Livro).
    private $usuarioNome;           // Nome da pessoa que realizou o empréstimo.
    private $dataEmprestimo;        // Data em que o empréstimo foi realizado.
    private $dataPrevistaDevolucao; // Data limite para a devolução.
    private $dataDevolucao;         // Data real da devolução (nulo se pendente). 

    // -----------------------------------------------------------
    // --- Métodos Getters e Setters (Acesso e Modificação) ---
    // -----------------------------------------------------------

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; } // Setter: Define o valor da propriedade.
    
    public function getLivroId() { return $this->livroId; }
    public function setLivroId($livroId) { $this->livroId = $livroId; }
    
    public function getUsuarioNome() { return $this->usuarioNome; } // Getter: Retorna o valor da propriedade.
    public function setUsuarioNome($usuarioNome) { $this->usuarioNome = $usuarioNome; }
    
    public function getDataEmprestimo() { return $this->dataEmprestimo; }
    public function setDataEmprestimo($dataEmprestimo) { $this->dataEmprestimo = $dataEmprestimo; }
    
    public function getDataPrevistaDevolucao() { return $this->dataPrevistaDevolucao; }
    public function setDataPrevistaDevolucao($dataPrevistaDevolucao) { $this->dataPrevistaDevolucao = $dataPrevistaDevolucao; }
    
    public function getDataDevolucao() { return $this->dataDevolucao; }
    public function setDataDevolucao($dataDevolucao) { $this->dataDevolucao = $dataDevolucao; }
}