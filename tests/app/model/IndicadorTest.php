<?php

namespace atom\test\model;

use atom\model\Indicador;
use atom\test\database\Generic_Tests_DatabaseTestCase;

class IndicadorTest extends Generic_Tests_DatabaseTestCase
{
    private $indicador;

    public function __construct()
    {
        $fixtures_dir = dirname(__DIR__) . DIRECTORY_SEPARATOR
            . '..' . DIRECTORY_SEPARATOR . 'fixtures';
        $this->fixtures = $this->getFixturesDirectory();
        $this->parameters = 'parameters_test.xml';
    }

    public function setUp()
    {
        $this->indicador = new Indicador($this->parameters);
        parent::setUp();
    }

    public function getDataSet()
    {
        $fixture = $this->fixtures.'/Database/empty-database.xml';
        $ds = $this->createMySQLXMLDataSet($fixture);

        $compositeDs = new \PHPUnit_Extensions_Database_DataSet_CompositeDataSet(array());
        $compositeDs->addDataSet($ds);

        return $compositeDs;
    }

    public function testInitialStateOfIndicador()
    {
        $fixture = $this->fixtures.'/Database/empty-database.xml';
        $expected = $this->createMySQLXMLDataSet($fixture);

        $actual = new \PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
        $actual->addTable('indicador');

        $this->assertEquals(0, $this->getConnection()->getRowCount('indicador'));
    }
}