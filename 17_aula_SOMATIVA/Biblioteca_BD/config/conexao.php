<?php

/**
 * Conexao - Classe que implementa o padrão Singleton para gerenciar a conexão PDO.
 */
class Conexao {

    private static $instance; // Instância única da conexão PDO (Princípio do Singleton).
    
    // --- Configurações do Banco de Dados ---
    private const HOST = 'localhost';
    private const DB_NAME = 'biblioteca_db'; 
    private const USER = 'root'; 
    private const PASS = '1234'; // PC lab.DEV(SEnaiSP) | PC lab.Samuel (1234)
    // ---------------------------------------

    /**
     * Construtor privado. Impede a criação de objetos através de 'new Conexao()'.
     */
    private function __construct() {}

    /**
     * Retorna a instância única da conexão PDO. Se não existir, a cria.
     * @return PDO Objeto de conexão PDO.
     */
    public static function getConexao() {
        if (!isset(self::$instance)) { // Verifica se a conexão já foi estabelecida.
            try {
                $dsn = 'mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME . ';charset=utf8';
                
                self::$instance = new PDO($dsn, self::USER, self::PASS, [
                    // Lança exceções em caso de erro no SQL.
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    
                    // Define o modo de retorno dos dados como Array Associativo.
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                // Em caso de falha, interrompe a execução e exibe o erro.
                die("Erro de Conexão: " . $e->getMessage()); 
            }
        }
        
        return self::$instance;
    }
}