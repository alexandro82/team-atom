<?php
namespace atom\model;

use atom\database\DatabaseConnection;

/**
 */
class Indice extends DatabaseConnection
{
    /**
     * @var integer municipio_id Municipio id
     */
    protected $municipio_id = null;

    /**
     * @var integer indicador_id Indicador de id
     */
    protected $indicador_id = null;

    /**
     * @var string gestion
     */
    protected $gestion = '';

    /**
     * @var string valor
     */
    protected $valor = '';

    /**
     * @var string estado
     */
    protected $estado = '';
    
    public function __construct($parameters = 'parameters.xml')
    {
        parent::__construct($parameters);
    }

    /**
     * Set Data to the entity
     *
     * @param array $data
     * @throw \Exception
     */
    public function setData($data = array())
    {
        try {
            $this->municipio_id = $data['municipio_id'];
            $this->indicador_id = $data['indicador_id'];
            $this->gestion = $data['gestion'];
            $this->valor = $data['valor'];
            $this->estado = $data['estado'];
        } catch (\Exception $e) {
            $msg = "Error Entity Indice::setData:\n$e";
            error_log($msg);
            throw $e;
        }
    }

    /**
     * Get Data from the entity
     *
     * @return array
     * @throws \Exception
     */
    public function getData()
    {
        $data = array();
        try {
            $data['municipio_id'] = $this->municipio_id;
            $data['indicador_id'] = $this->indicador_id;
            $data['gestion'] = $this->gestion;
            $data['valor'] = $this->valor;
            $data['estado'] = $this->estado;
        } catch (\Exception $e) {
            $msg = "Error Entity Indice::getData:\n$e";
            error_log($msg);
            throw $e;
        }
        return $data;
    }

    /**
     * Save entity on the database
     * @throws \Exception
     */
    public function save()
    {
        try {
            $pdo = $this->getConnection();
            $query = 'INSERT INTO indice (municipio_id, indicador_id, '
                . ' indice_gestion, indice_valor, indice_estado ) '
                . ' values (:municipio_id, :indicador_id, :gestion, '
                . ' :valor, :estado )';
            $stmt = $pdo->prepare($query);
            $data = $this->getData();
            $stmt->execute($data);
        } catch (\Exception $e) {
            $msg = "Error Entity Indice::save:\n$e";
            error_log($msg);
            throw $e;
        }
    }
}

