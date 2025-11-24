<?php

class Conexao {
    private static $instance;
    private const HOST = 'localhost';
    private const DB_NAME = 'biblioteca_db'; 
    private const USER = 'root'; 
    private const PASS = 'SenaiSP'; 

    private function __construct() {}

    /**
     * @return PDO Retorna o objeto PDO da conexão.
     */
    public static function getConexao() {
        if (!isset(self::$instance)) {
            try {
                $dsn = 'mysql:host=' . self::HOST . ';dbname=' . self::DB_NAME . ';charset=utf8';
                self::$instance = new PDO($dsn, self::USER, self::PASS, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]);
            } catch (PDOException $e) {
                die("Erro de Conexão: " . $e->getMessage());
            }
        }
        return self::$instance;
    }
}