<?php
namespace atom\test\database;

/**
 * Disables foreign key checks temporarily.
 */
class TruncateOperation extends \PHPUnit_Extensions_Database_Operation_Truncate
{
    public function execute(
        \PHPUnit_Extensions_Database_DB_IDatabaseConnection $connection,
        \PHPUnit_Extensions_Database_DataSet_IDataSet $dataSet
    ) {
        $connection->getConnection()->query("SET foreign_key_checks = 0");
        parent::execute($connection, $dataSet);
        $connection->getConnection()->query("SET foreign_key_checks = 1");
    }
}

abstract class Generic_Tests_DatabaseTestCase extends \PHPUnit_Extensions_Database_TestCase
{
    static private $pdo = null;

    private $conn = null;
    protected $fixtures;
    protected $parameters;

    final public function getConnection()
    {
        if (null === $this->conn) {
            if (null === self::$pdo) {
                self::$pdo = new \PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }

        return $this->conn;
    }

    public function getSetUpOperation()
    {
        $cascadeTruncates = true; // If you want cascading truncates, false otherwise. If unsure choose false.

        return new \PHPUnit_Extensions_Database_Operation_Composite(
            array(
                new TruncateOperation($cascadeTruncates),
                \PHPUnit_Extensions_Database_Operation_Factory::INSERT()
            )
        );
    }

    protected function getFixturesDirectory()
    {
        return dirname(__DIR__)
            .DIRECTORY_SEPARATOR
            .'..'
            .DIRECTORY_SEPARATOR
            .'fixtures';
    }
}

