<?php
namespace atom\database;


/**
 * DatabaseConnection
 *
 * @uses mysqli
 * Description: Manejo de las conecciones con la base de datos.
 */
class DatabaseConnection
{
    /**
     * Usuario de la base de datos
     * @var string $user        Usuario que se conecta a la base de datos
     */
    protected $user;

    /**
     * Password de la coneccion
     * @var string $password    Password del usuario
     */
    protected $password;

    /**
     * Base de datos a la que se conecta
     * @var string $database    Nombre de la Base de datos a la cual conectarse
     */
    protected $database;

    /**
     * Equipo en el que se encuentra la base de datos
     * @var string $host        Host en el que se encuentra la base de datos
     */
    protected $host;

    /**
     * Coneccion a la base de datos
     * @var mysqli  $connection Conneccion a la base de datos usando mysqli
     */
    protected $connection;

    /**
     * @var PDO $pdo            Conneccion a la base de datos mediante PDO
     */
    protected $pdo;

    /**
     * @param string $config_file   Archivo con los parametros de Coneccion
     */
    public function __construct($config_file = 'parameters.xml')
    {
        $this->configParameters($config_file);
        $this->connection = null;
    }

    /**
     * Constructor
     *
     * @param string $file          Archivo XML con los parametros de coneccion
     */
    protected function configParameters($file)
    {
        $config_dir = dirname(__DIR__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'config';
        $xml = simplexml_load_file($config_dir.DIRECTORY_SEPARATOR.$file);
        $database = $xml->xpath("/databases/database");
        $db = $database['0'];

        $this->user = $db->username;
        $this->password = $db->password;
        $this->host = $db->dbhost;
        $this->database = $db->dbname;
    }

    /**
     * Abre una coneccion con la base de datos Mediante PDO
     *
     * @return PDO
     * @throws \PDOException
     */
    public function getConnection()
    {
        $str_connection = sprintf(
            "mysql:host=%s;dbname=%s",
            $this->host,
            $this->database
        );
        try {
            $this->pdo = new \PDO($str_connection, $this->user, $this->password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec('SET NAMES "utf8"');
        } catch (\PDOException $e) {
            throw $e;
        }
        return $this->pdo;
    }

    /**
     * Close database connection
     */
    public function closeConnection()
    {
        if ($this->connection !== null) {
            $this->connection->close();
        }
    }

    private function cleanData($data)
    {
        $str = mb_convert_encoding($data, 'UTF-8', 'UTF-8');
        $str = htmlentities($str, ENT_QUOTES, 'UTF-8');
        return $str;
    }

    public function __destruct()
    {
        $this->closeConnection();
    }
}

