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

    /**
     * Get Municipio By Indice
     */
    public function getIndiceByIndicadorAndYear($indicador_id, $year)
    {
        $data = array();
        try {
            $pdo = $this->getConnection();
            $query = 'select i.id, '
                . ' i.indice_gestion as gestion, '
                . ' i.indice_valor as valor, '
                . ' i.municipio_id, '
                . ' m.municipio_nombre as municipio, '
                . ' m.municipio_longitud as longitud, '
                . ' m.municipio_latitud as latitud, '
                . ' m.municipio_departamento as departamento, '
                . ' i.indicador_id, '
                . ' ir.indicador_descripcion as indicador,'
                . ' i.indice_estado '
                . ' from indice i '
                . ' left join indicador ir on (ir.id = i.indicador_id) '
                . ' left join municipio m on (m.id = i.municipio_id) '
                . ' where i.indicador_id = :indicador_id '
                . ' and i.indice_gestion = :year '
                . ' order by i.municipio_id ';
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':indicador_id', $indicador_id);
            $stmt->bindValue(':year', $year);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $msg = "Error Indice::getIndiceByIndicadorAndYear:\n$e";
            error_log($msg);
        }
        return $data;
    }

    /**
     * Get Municipio By Indice
     */
    public function getIndiceByIndicador($indicador_id)
    {
        $data = array();
        try {
            $pdo = $this->getConnection();
            $query = 'select i.id, '
            . ' i.indice_gestion as gestion, '
            . ' i.indice_valor as valor, '
            . ' i.municipio_id, '
            . ' m.municipio_nombre as municipio, '
            . ' m.municipio_categoria as categoria, '
            . ' i.indicador_id, '
            . ' ir.indicador_descripcion as indicador,'
            . ' i.indice_estado '
            . ' from indice i '
            . ' left join indicador ir on (ir.id = i.indicador_id) '
            . ' left join municipio m on (m.id = i.municipio_id) '
            . ' where i.indicador_id = :indicador_id '
            . ' order by i.municipio_id ';
            $stmt = $pdo->prepare($query);
            $stmt->bindValue(':indicador_id', $indicador_id);
            $stmt->execute();
            $data = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            $msg = "Error Indice::getIndiceByIndicadorAndYear:\n$e";
            error_log($msg);
        }
        return $data;
    }
}

