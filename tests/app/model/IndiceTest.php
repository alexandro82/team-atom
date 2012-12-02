<?php
namespace atom\test\model;

use atom\model\Indice;
use atom\test\database\Generic_Tests_DatabaseTestCase;

class IndiceTest extends Generic_Tests_DatabaseTestCase
{
    private $indice;

    public function __construct()
    {
        $fixtures_dir = dirname(__DIR__) . DIRECTORY_SEPARATOR
        . '..' . DIRECTORY_SEPARATOR . 'fixtures';
        $this->fixtures = $this->getFixturesDirectory();
        $this->parameters = 'parameters_test.xml';  
    }

    public function setUp()
    {
        $this->indice = new Indice($this->parameters);
        parent::setUp();
    }

    protected function getDataSet()
    {
        $fixture = $this->fixtures.'/Database/fixture-indice01.xml';

        return $this->createMySQLXMLDataSet($fixture);
    }

    public function testInitialStateOfIndice()
    {
        $fixture = $this->fixtures.'/Database/empty-database.xml';
        $expected = $this->createMySQLXMLDataSet($fixture);
        
        $actual = new \PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
        $actual->addTable('indice');
        
        $this->assertEquals(0, $this->getConnection()->getRowCount('indice'));
    }

    public function testInsertTwoRowsOnIndice()
    {
        $data_input01 = array (
            'gestion' => '1999',
            'valor' => '100',
            'municipio_id' => '1',
            'indicador_id' => '1',
            'estado' => '1'
        );
        $data_input02 = array (
            'gestion' => '2000',
            'valor' => '199',
            'municipio_id' => '2',
            'indicador_id' => '2',
            'estado' => '1'
        );

        $this->assertEquals(2, $this->getConnection()->getRowCount('municipio'));
        $this->assertEquals(2, $this->getConnection()->getRowCount('indicador'));
        $this->assertEquals(0, $this->getConnection()->getRowCount('indice'));
        
        $this->indice->setData($data_input01);
        $this->indice->save();
        $this->indice->setData($data_input02);
        $this->indice->save();

        $this->assertEquals(2, $this->getConnection()->getRowCount('indice'));

        $fixture = $this->fixtures.'/Database/fixture-indice01-output.xml';
        $expected = $this->createMySQLXMLDataSet($fixture);

        $actual = new \PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
        $actual->addTable('indice');
        $this->assertDataSetsEqual($expected, $actual);
    }
}