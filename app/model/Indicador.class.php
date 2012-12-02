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
            $msg = "Error Indicador::save:\n$e";
            error_log($e);
        }
    }

    public function getIndicadorByName($i = null)
    {
        $data = array();
        try {
            $indicador = null;
            if (null === $i) {
                $indicador = '%%';
            } else {
                $indicador = '%' . $i . '%';
            }
            $query = " SELECT * "
                . " FROM indicador "
                . " WHERE indicador_descripcion like :indicador "
                . " ORDER BY indicador_descripcion ASC ";
            $pdo = $this->getConnection();
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':indicador', $indicador);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $msg = "Error Indicador::getIndicadorByName:\n$e";
            error_log($msg);
        }
        return $data;
    }
}

