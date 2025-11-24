<?php

class Emprestimo {
    private $id;
    private $livroId;
    private $usuarioNome; 
    private $dataEmprestimo;
    private $dataPrevistaDevolucao;
    private $dataDevolucao; 

    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    
    public function getLivroId() { return $this->livroId; }
    public function setLivroId($livroId) { $this->livroId = $livroId; }
    
    public function getUsuarioNome() { return $this->usuarioNome; }
    public function setUsuarioNome($usuarioNome) { $this->usuarioNome = $usuarioNome; }
    
    public function getDataEmprestimo() { return $this->dataEmprestimo; }
    public function setDataEmprestimo($dataEmprestimo) { $this->dataEmprestimo = $dataEmprestimo; }
    
    public function getDataPrevistaDevolucao() { return $this->dataPrevistaDevolucao; }
    public function setDataPrevistaDevolucao($dataPrevistaDevolucao) { $this->dataPrevistaDevolucao = $dataPrevistaDevolucao; }
    
    public function getDataDevolucao() { return $this->dataDevolucao; }
    public function setDataDevolucao($dataDevolucao) { $this->dataDevolucao = $dataDevolucao; }
}