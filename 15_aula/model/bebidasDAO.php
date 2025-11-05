<?php
// 15_aula/model/bebidasDAO.php

require_once("bebidas.php");

class BebidaDAO {
    private $arquivo = __DIR__ . "/dados.json"; 

    public function __construct() {
        if (!file_exists($this->arquivo)) {
            $this->salvarDados([]);
        }
    }

    private function lerDados() {
        $json = file_get_contents($this->arquivo);
        $dados = json_decode($json, true);
        return $dados ? $dados : [];
    }

    private function salvarDados($dados) {
        // Salva os dados, garantindo que arrays vazios se tornem [] e não {}
        $json = json_encode(array_values($dados), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents($this->arquivo, $json);
    }

    public function listar() {
        $dados = $this->lerDados();
        $listaDeBebidas = [];

        foreach ($dados as $item) {
            $bebida = new Bebida(
                $item['nome'],
                $item['categoria'],
                $item['volume'],
                $item['valor'],
                $item['qtd'],
                $item['id'] // <-- Passando o ID
            );
            $listaDeBebidas[] = $bebida;
        }
        return $listaDeBebidas;
    }

    public function adicionar(Bebida $novaBebida) {
        $dados = $this->lerDados();
        $dados[] = $novaBebida->toArray();
        $this->salvarDados($dados);
    }

    /**
     * Exclui uma bebida pelo seu ID único
     * @param string $id
     */
    public function excluir($id) {
        $dados = $this->lerDados();

        // Filtra o array, mantendo apenas os itens
        // cujo ID seja DIFERENTE do ID que queremos excluir.
        $dadosFiltrados = array_filter($dados, function($item) use ($id) {
            return $item['id'] !== $id;
        });

        // Salva os dados filtrados (já re-indexados pelo array_filter)
        $this->salvarDados($dadosFiltrados);
    }
}
?>