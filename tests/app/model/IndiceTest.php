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
    }

    public function getDataSet()
    {
        $fixture = $this->fixtures.'/Database/empty-database.xml';
        $ds = $this->createMySQLXMLDataSet($fixture);

        $compositeDs = new \PHPUnit_Extensions_Database_DataSet_CompositeDataSet(array());
        $compositeDs->addDataSet($ds);

        return $compositeDs;
    }

    public function testInitialStateOfIndice()
    {
        $fixture = $this->fixtures.'/Database/empty-database.xml';
        $expected = $this->createMySQLXMLDataSet($fixture);
        
        $actual = new \PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
        $actual->addTable('indice');
        
        $this->assertEquals(0, $this->getConnection()->getRowCount('indice'));
    }
}