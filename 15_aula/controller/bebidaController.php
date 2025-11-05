<?php
// 15_aula/controller/bebidaController.php

require_once("../model/bebidas.php");
require_once("../model/bebidasDAO.php");

class BebidaController {
    private $dao;

    public function __construct() {
        //
        // A CORREÇÃO ESTÁ AQUI:
        //
        $this->dao = new BebidaDAO();
    }

    public function listarBebidas() {
        return $this->dao->listar();
    }

    public function adicionarBebida($nome, $categoria, $volume, $valor, $qtd) {
        // Criamos a bebida sem passar o ID, para que ele seja gerado
        $nova = new Bebida($nome, $categoria, $volume, $valor, $qtd);
        $this->dao->adicionar($nova);
    }

    /**
     * Novo método para exclusão
     */
    public function excluirBebida($id) {
        $this->dao->excluir($id);
    }
}
?>