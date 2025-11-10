<?php
// controller/seu_controller.php

// !!! ATUALIZE OS NOMES DOS ARQUIVOS !!!
require_once("../model/sua_classe.php");
require_once("../model/sua_classeDAO.php");

// !!! TROQUE 'SEU_CONTROLLER_AQUI' (ex: CerealController) !!!
class SEU_CONTROLLER_AQUI {
    private $dao;

    public function __construct() {
        // !!! ATUALIZE O NOME DA CLASSE DAO AQUI !!!
        $this->dao = new SUA_CLASSE_DAO_AQUI();
    }

    public function listarItens() { // Mudei o nome para 'listarItens'
        return $this->dao->listar();
    }

    // !!! ATUALIZE OS PARÂMETROS COM OS SEUS CAMPOS !!!
    public function adicionarItem($nome, $categoria, $volume, $valor, $qtd) {
        
        // !!! ATUALIZE AQUI COM SEUS CAMPOS (sem o ID) !!!
        $novo = new SUA_CLASSE_AQUI($nome, $categoria, $volume, $valor, $qtd);
        $this->dao->adicionar($novo);
    }

    public function excluirItem($id) { // Mudei o nome para 'excluirItem'
        $this->dao->excluir($id);
    }
   
    public function buscarItemPorId($id) { // Mudei o nome para 'buscarItemPorId'
        return $this->dao->buscarPorId($id);
    }

    /**
     * Novo método para atualizar
     */
    // !!! ATUALIZE OS PARÂMETROS COM OS SEUS CAMPOS (com o ID) !!!
    public function atualizarItem($id, $nome, $categoria, $volume, $valor, $qtd) {
        
        // !!! ATUALIZE AQUI COM SEUS CAMPOS (com o ID no final) !!!
        $item = new SUA_CLASSE_AQUI($nome, $categoria, $volume, $valor, $qtd, $id);
        $this->dao->atualizar($item);
    }
}
?>