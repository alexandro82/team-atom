<?php
namespace atom\model;

use atom\database\DatabaseConnection;

/**
 *
 */
class Municipio extends DatabaseConnection
{
    /**
     * @var id
     */
    protected $id = null;
    
    /**
     * @var string Nombre del municipio.
     */
    protected $nombre = '';

    /**
     * @var string Departamento al que pertenece el municipio.
     */
    protected $departamento = '';

    /**
     * @var string longitud coordenadas.
     */
    protected $longitud = '';

    /**
     * @var string latitud coordenadas.
     */
    protected $latitud = '';

    /**
     * @var string categoria del municipio.
     */
    protected $categoria = '';

    /**
     * @var string codigo del municipio en el INE
     */
    protected $codigo_ine = '';

    /**
     * @var string codigo anterior del municipio en el INE
     */
    protected $codigo_ine_anterior = '';

    /**
     * @var string codigo en el ministerio de economia.
     */
    protected $codigo_economia_finanzas = '';

    /**
     * @var string estado del municipio.
     */
    protected $estado = '';

    public function __construct($parameters = 'parameters.xml')
    {
        parent::__construct($parameters);
    }

    /**
     * @param array Data
     * @return
     *
     * @throws \Exception
     */
    public function setData($data = array())
    {
        try {
            $this->nombre = $data['nombre'];
            $this->departamento = $data['departamento'];
            $this->longitud = $data['longitud'];
            $this->latitud = $data['latitud'];
            $this->categoria = $data['categoria'];
            $this->codigo_ine = $data['codigo_ine'];
            $this->codigo_ine_anterior = $data['codigo_ine_anterior'];
            $this->codigo_economia_finanzas = $data['codigo_economia_finanzas'];
            $this->estado = $data['estado'];
        } catch (\Exception $e) {
            $msg = "Error Entity Municipio::setData:\n$e";
            error_log($msg);
            throw $e;
        }
    }

    /**
     * @return array of data from municipio
     *
     * @throws \Exception
     */
    public function getData()
    {
        $data = array();
        try {
            $data[':nombre'] = $this->nombre;
            $data[':departamento'] = $this->departamento;
            $data[':longitud'] = $this->longitud;
            $data[':latitud'] = $this->latitud;
            $data[':categoria'] = $this->categoria;
            $data[':codigo_ine'] = $this->codigo_ine;
            $data[':codigo_ine_anterior'] = $this->codigo_ine_anterior;
            $data[':codigo_economia_finanzas'] = $this->codigo_economia_finanzas;
            $data[':estado'] = $this->estado;
        } catch (\Exception $e) {
            $msg = "Error Entity Municipio::getData:\n$e";
            error_log($msg);
            throw $e;
        }
        return $data;
    }

    /**
     * Save data on the database
     * 
     * @throws \Exception
     */
    public function save()
    {
        try {
            $pdo = $this->getConnection();
            $query = 'INSERT INTO municipio (municipio_nombre, '
                . ' municipio_departamento, municipio_longitud, '
                . ' municipio_latitud, municipio_categoria, '
                . ' municipio_codigo_ine, municipio_codigo_ine_anterior, '
                . ' municipio_codigo_economia_finanzas, municipio_estado ) '
                . ' values (:nombre, :departamento, :longitud, :latitud, '
                . ' :categoria, :codigo_ine, :codigo_ine_anterior, '
                . ' :codigo_economia_finanzas, :estado) ';
            $stmt = $pdo->prepare($query);
            $data = $this->getData();
            $stmt->execute($data);
        } catch (\Exception $e) {
            $msg = "Erro Entity Municipio::save:.\n$e";
            error_log($msg);
            throw $e;
        }
    }
}
