<?php
class Reservacion extends Conexion {
    public function __construct() {
        parent::__construct();
        $this->setTabla("rsv_solicitud");
    }

    
}

?>