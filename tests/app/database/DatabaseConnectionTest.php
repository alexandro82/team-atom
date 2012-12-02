<?php
namespace atom\test\database;

use atom\test\database\Generic_Tests_DatabaseTestCase;

class DatabaseConnectionTest extends Generic_Tests_DatabaseTestCase
{

    public function __construct()
    {
        $this->fixtures = $this->getFixturesDirectory();
    }

    protected function getDataSet()
    {
        return $this->createMySQLXMLDataSet($this->fixtures.'/Database/empty-database.xml');
    }

    public function testEmptyDatabase()
    {
        $this->assertEquals(0, $this->getConnection()->getRowCount('municipio'));
        $this->assertEquals(0, $this->getConnection()->getRowCount('indicador'));
        $this->assertEquals(0, $this->getConnection()->getRowCount('indice'));
    }
}

