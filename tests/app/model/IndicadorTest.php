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

    protected function getDataSet()
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

    public function testInsertTwoRowsOnIndicador()
    {
        $data_input01 = array (
                'descripcion' => 'EJECUCION DE RECURSOS',
                'tipo' => 'SUBINDICE',
                'estado' => '1',
            );
        $data_input02 = array (
                'descripcion' => 'GESTION FINANCIERA',
                'tipo' => 'INDICADOR',
                'estado' => '1',
            );
        $this->indicador->setData($data_input01);
        $this->indicador->save();
        $this->indicador->setData($data_input02);
        $this->indicador->save();

        $this->assertEquals(2, $this->getConnection()->getRowCount('indicador'));

        $fixture = $this->fixtures.'/Database/fixture-indicador01.xml';
        $expected = $this->createMySQLXMLDataSet($fixture);

        $actual = new \PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
        $actual->addTable('indicador');

        $this->assertDataSetsEqual($expected, $actual);
    }
}