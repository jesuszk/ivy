<?php

namespace src\database;

use Exception;
use PDO;
use PDOException;


class Database
{
    protected static ?PDO $pdo = null;
    protected static ?string $typeConnection = null;
    protected static ?string $host = null;
    protected static ?string $dbname = null;
    protected static ?string $username = null;
    protected static ?string $password = null;
    protected static ?string $service = null;
    protected static ?string $server = null;

    static function config(string $type, string $host, string $dbname, string $username, string $password, ?string $service = null, ?string $server = null)
    {
        self::$typeConnection = $type;
        self::$host = $host;
        self::$dbname = $dbname;
        self::$username = $username;
        self::$password = $password;
        self::$service = $service;
        self::$server = $server;
    }

    static function get()
    {
        return self::connect();
    }

    static function setConfig()
    {
        $config = !empty($_ENV['DB_FROM_FILE'])
            ? require $_ENV['DB_FROM_FILE']
            : [
                'DB_TYPE'     => $_ENV['DB_TYPE']     ?? null,
                'DB_HOST'     => $_ENV['DB_HOST']     ?? null,
                'DB_NAME'     => $_ENV['DB_NAME']     ?? null,
                'DB_USER'     => $_ENV['DB_USER']     ?? null,
                'DB_PASSWORD' => $_ENV['DB_PASSWORD'] ?? null,
            ];

        self::config(
            type: $config['DB_TYPE'],
            host: $config['DB_HOST'],
            username: $config['DB_USER'],
            password: $config['DB_PASSWORD'],
            dbname: 'sfp_ammx'
        );

        return new self;
    }

    static function instance(): PDO
    {
        return self::setConfig()::get();
    }

    /**
     * Method performs the database connection
     * @return PDO
     */
    protected static function connect(): PDO
    {
        try {
            self::$pdo = new PDO(self::dns(), self::$username, self::$password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$pdo->setAttribute(PDO::ATTR_TIMEOUT, 10);
            return self::$pdo;
        } catch (PDOException $e) {
            dd("Erro ao conectar com o banco de dados: " . $e->getMessage());
        }
    }

    /**
     * Obtains the type of DNS according to the informed connection
     * 
     * @return string
     */
    protected static function dns(): string
    {
        switch (self::$typeConnection) {
            case 'mysql':
                return "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8mb4";
            case 'sqlserver':
                return "sqlsrv:Server=" . self::$host . ";Database=" . self::$dbname . "";
            case 'informix':
                return "informix:host=" . self::$host . "; service=" . self::$service . "; database=" . self::$dbname . "; server=" . self::$server . "; protocol=olsoctcp";
            default:
                throw new Exception("Tipo de conexão inválido: " . self::$typeConnection . "");
        }
    }
}
