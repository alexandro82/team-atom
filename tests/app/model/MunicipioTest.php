<?php
namespace atom\test\model;

use atom\model\Municipio;
use atom\test\database\Generic_Tests_DatabaseTestCase;

class MunicipioTest extends Generic_Tests_DatabaseTestCase
{
    private $municipio;

    public function __construct()
    {
        $fixtures_dir = dirname(__DIR__) . DIRECTORY_SEPARATOR
            . '..' . DIRECTORY_SEPARATOR . 'fixtures';
        $this->fixtures = $this->getFixturesDirectory();
        $this->parameters = 'parameters_test.xml';    
    }

    public function setUp()
    {
        $this->municipio = new Municipio($this->parameters);
        parent::setUp();
    }

    public function getDataSet()
    {
        $ds = $this->createMySQLXMLDataSet($this->fixtures.'/Database/fixture-municipio01.xml');

        $compositeDs = new \PHPUnit_Extensions_Database_DataSet_CompositeDataSet(array());
        $compositeDs->addDataSet($ds);

        return $compositeDs;
    }

    public function testInitialStateOfMunicipio()
    {
        $fixture = $this->fixtures.'/Database/fixture-municipio01.xml';
        $expected = $this->createMySQLXMLDataSet($fixture);
        $actual = new \PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
        $actual->addTable('municipio');

        $this->assertDataSetsEqual($expected, $actual);
    }
}