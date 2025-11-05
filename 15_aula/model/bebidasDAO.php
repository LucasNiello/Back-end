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
    /**
     * Busca uma bebida específica pelo seu ID
     * @param string $id
     * @return Bebida|null
     */
    public function buscarPorId($id) {
        $dados = $this->lerDados();
        
        foreach ($dados as $item) {
            if ($item['id'] === $id) {
                // Encontrado! Retorna o objeto Bebida
                return new Bebida(
                    $item['nome'],
                    $item['categoria'],
                    $item['volume'],
                    $item['valor'],
                    $item['qtd'],
                    $item['id']
                );
            }
        }
        return null; // Não encontrado
    }

    /**
     * Atualiza uma bebida existente no JSON
     * @param Bebida $bebidaAtualizada
     */
    public function atualizar(Bebida $bebidaAtualizada) {
        $id = $bebidaAtualizada->getId();
        $dados = $this->lerDados();

        // Encontra o índice do item a ser atualizado
        $indiceParaAtualizar = -1;
        foreach ($dados as $indice => $item) {
            if ($item['id'] === $id) {
                $indiceParaAtualizar = $indice;
                break;
            }
        }

        // Se encontrou, atualiza
        if ($indiceParaAtualizar !== -1) {
            $dados[$indiceParaAtualizar] = $bebidaAtualizada->toArray();
            $this->salvarDados($dados);
        }
    }
}

?>