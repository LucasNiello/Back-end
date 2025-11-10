<?php
// model/sua_classeDAO.php

// !!! ATUALIZE O NOME DO ARQUIVO AQUI !!!
require_once("sua_classe.php");

// !!! TROQUE 'SUA_CLASSE_DAO_AQUI' (ex: CerealDAO) !!!
class SUA_CLASSE_DAO_AQUI {
    
    // !!! VOCÊ PODE TROCAR O NOME DO ARQUIVO JSON !!!
    private $arquivo = __DIR__ . "/dados_itens.json"; 

    public function __construct() {
        if (!file_exists($this->arquivo)) {
            $this->salvarDados([]);
        }
    }

    // Funções privadas (lerDados, salvarDados) são genéricas, não precisam mexer.
    private function lerDados() {
        $json = file_get_contents($this->arquivo);
        $dados = json_decode($json, true);
        return $dados ? $dados : [];
    }
    private function salvarDados($dados) {
        $json = json_encode(array_values($dados), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($this->arquivo, $json);
    }

    public function listar() {
        $dados = $this->lerDados();
        $listaDeItens = []; // Nome da variável ficou mais genérico

        foreach ($dados as $item) {
            
            // !!! ATUALIZE AQUI COM OS CAMPOS DO SEU CONSTRUTOR !!!
            $objeto = new SUA_CLASSE_AQUI(
                $item['nome'],
                $item['categoria'],
                $item['volume'],
                $item['valor'],
                $item['qtd'],
                $item['id'] // O ID sempre por último
            );
            $listaDeItens[] = $objeto;
        }
        return $listaDeItens;
    }

    public function adicionar(SUA_CLASSE_AQUI $novoItem) { // !!! ATENÇÃO AO TIPO AQUI !!!
        $dados = $this->lerDados();
        $dados[] = $novoItem->toArray(); // Genérico, não mexe
        $this->salvarDados($dados);
    }

    // Excluir é 100% genérico, não precisa mexer.
    public function excluir($id) {
        $dados = $this->lerDados();
        $dadosFiltrados = array_filter($dados, function($item) use ($id) {
            return $item['id'] !== $id;
        });
        $this->salvarDados($dadosFiltrados);
    }
    
    public function buscarPorId($id) {
        $dados = $this->lerDados();
        
        foreach ($dados as $item) {
            if ($item['id'] === $id) {
                
                // !!! ATUALIZE AQUI COM OS CAMPOS DO SEU CONSTRUTOR !!!
                return new SUA_CLASSE_AQUI(
                    $item['nome'],
                    $item['categoria'],
                    $item['volume'],
                    $item['valor'],
                    $item['qtd'],
                    $item['id'] // O ID sempre por último
                );
            }
        }
        return null; // Não encontrado
    }

    // Atualizar é 99% genérico, só mude o tipo da variável
    public function atualizar(SUA_CLASSE_AQUI $itemAtualizado) { // !!! ATENÇÃO AO TIPO AQUI !!!
        $id = $itemAtualizado->getId();
        $dados = $this->lerDados();

        $indiceParaAtualizar = -1;
        foreach ($dados as $indice => $item) {
            if ($item['id'] === $id) {
                $indiceParaAtualizar = $indice;
                break;
            }
        }

        if ($indiceParaAtualizar !== -1) {
            $dados[$indiceParaAtualizar] = $itemAtualizado->toArray();
            $this->salvarDados($dados);
        }
    }
}
?>