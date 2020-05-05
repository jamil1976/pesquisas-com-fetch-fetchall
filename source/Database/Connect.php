<?php


namespace Source\Database;

use PDO;
use PDOException;

class Connect
{
    private const HOST = "localhost";
    private const USER = "root";
    private const DBNAME = "fullstackphp";
    private const PASSWD = "";

    /*
     *  DEFAULT_FETCH_MODE - Define que o retorno da consulta sempre sera um objeto(FETCH_OBJECT)
     * poderia ser array(FETCH_ASSOC);
     * CASE_NATURAL - Mantem o mesmo nome de colunas no caso de uma migração de banco de dados.
     *
     * */
    private const OPTIONS = [
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
      PDO::ATTR_CASE => PDO::CASE_NATURAL
    ];

    /**
     * Armazena o obj de conexão. Por ser static ele pertence a classe e garante que teremos somente UM obj conexão
     * 
     * @var 
     */
    private static $instance;

    /**
     * O metodo verifica se não existe uma conexão PDO. Se true então criamos a conexão
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if(empty(self::$instance)){
            try {

                self::$instance = new PDO(
                    "mysql:host=". self::HOST.";dbname=".self::DBNAME,
                    self::USER,
                    self::PASSWD,
                    self::OPTIONS
                );

            } catch (PDOException $e) {
                die("<h1>Erro ao conectar...</h1>");
            }
        }

        return self::$instance;
    }


    final private function __construct()
    {
        // Para garantir que nao teremos instancias desta classe
    }

    final private function __clone()
    {
        // Para garantir que nao teremos instancias desta classe
    }



}