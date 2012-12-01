<?php
namespace atom\model;

use atom\database\DatabaseConnection;

/**
 */
class Indicador extends DatabaseConnection
{
    /**
     * @var integer id
     */
    protected $id = null;
    
    /**
     * @var string descripcion del tipo de indicador.
     */
    protected $descripcion = '';

    /**
     * @var string tipo de indicador.
     */
    protected $tipo = '';

    /**
     * @var string estado del indicador.
     */
    protected $estado = '';

    
    public function __construct($parameters = 'parameters.xml')
    {
        parent::__construct($parameters);
    }

    /**
     * Set data on entity
     * 
     * @param array $data
     */
    public function setData($data = array())
    {
        try {
            $this->descripcion = $data['descripcion'];
            $this->tipo = $data['tipo'];
            $this->estado = $data['estado'];
        } catch (\Exception $e) {
            $msg = "Error Indicador::setData:\n$e";
            error_log($msg);
        }
    }

    /**
     * Get data from entity
     * 
     * @return array
     */
    public function getData()
    {
        $data = array();
        try {
            $data[':descripcion'] = $this->descripcion;
            $data[':tipo'] = $this->tipo;
            $data[':estado'] = $this->estado;
        } catch (\Exception $e) {
            $msg = "Error Indicador::getData:\n$e";
            error_log($e);
            throw $e;
        }
        return $data;
    }

    /**
     * Save Data to the database
     */
    public function save()
    {
        try {
            $pdo = $this->getConnection();
            $query = 'INSERT INTO indicador '
                . ' (indicador_descripcion, indicador_tipo, indicador_estado)'
                . ' values (:descripcion, :tipo, :estado)';
            $stmt = $pdo->prepare($query);
            $data = $this->getData();
            $stmt->execute($data);
        } catch (\Exception $e) {
            $msg = "No Indicador::save:\n$e";
            error_log($e);
        }
    }
}

