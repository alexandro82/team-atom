<?php
namespace atom\model;

use atom\database\DatabaseConnection;

/**
 *
 */
class Municipio extends DatabaseConnection
{
    public function __construct($parameters = 'parameters.xml')
    {
        parent::__construct($parameters);
    }
}

