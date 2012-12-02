<?php

namespace atom\test\query;

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

    protected function getDataSet()
    {
        $fixture = $this->fixtures.'/Database/querys/municipio_input.xml';
        $ds1 = $this->createMySQLXMLDataSet($fixture);
        $fixture = $this->fixtures.'/Database/querys/indicador_input.xml';
        $ds2 = $this->createMySQLXMLDataSet($fixture);
        $fixture = $this->fixtures.'/Database/querys/indice_input.xml';
        $ds3 = $this->createMySQLXMLDataSet($fixture);
        
        $compositeDs = new \PHPUnit_Extensions_Database_DataSet_CompositeDataSet(array());
        $compositeDs->addDataSet($ds1);
        $compositeDs->addDataSet($ds2);
        $compositeDs->addDataSet($ds3);
        
        return $compositeDs;
    }

    public function testGetMunicipios()
    {
        $this->assertEquals(35, count($this->municipio->getMunicipiosByDepartamento('or')));
        $this->assertEquals(10, count($this->municipio->getMunicipiosByMunicipioName('cha')));
    }
}

