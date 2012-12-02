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
        $ds = $this->createMySQLXMLDataSet($this->fixtures.'/Database/empty-database.xml');

        $compositeDs = new \PHPUnit_Extensions_Database_DataSet_CompositeDataSet(array());
        $compositeDs->addDataSet($ds);

        return $compositeDs;
    }

    public function testInitialStateOfMunicipio()
    {
        $fixture = $this->fixtures.'/Database/empty-database.xml';
        $expected = $this->createMySQLXMLDataSet($fixture);
        $actual = new \PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
        $actual->addTable('municipio');
        $this->assertEquals(0, $this->getConnection()->getRowCount('municipio'));
    }

    public function testInsertOneRowOnMunicipio()
    {
        $data_input01 = array(
                'nombre' => 'San Borja',
                'departamento' => 'Beni',
                'longitud' => '-66.6796807',
                'latitud' => '-14.9252762',
                'categoria' => 'C',
                'codigo_ine' => '80302',
                'codigo_ine_anterior' => '80302',
                'codigo_economia_finanzas' => '1808',
                'estado' => '1',
            );
        $data_input02 = array(
                'nombre' => 'Santa Rosa',
                'departamento' => 'Beni',
                'longitud' => '-66.737239',
                'latitud' => '-13.4617941',
                'categoria' => 'B',
                'codigo_ine' => '80303',
                'codigo_ine_anterior' => '80303',
                'codigo_economia_finanzas' => '1809',
                'estado' => '1',
            );
        $this->municipio->setData($data_input01);
        $this->municipio->save();
        $this->municipio->setData($data_input02);
        $this->municipio->save();

        $this->assertEquals(2, $this->getConnection()->getRowCount('municipio'));

        $fixture = $this->fixtures.'/Database/fixture-municipio01.xml';
        $expected = $this->createMySQLXMLDataSet($fixture);
        
        $actual = new \PHPUnit_Extensions_Database_DataSet_QueryDataSet($this->getConnection());
        $actual->addTable('municipio');
        $this->assertDataSetsEqual($expected, $actual);
    }
}