<?php
class Solicitud extends Conexion {
    public function __construct() {
        parent::__construct();
        $this->setTabla("rsv_salas");
    }
    public function getSalas() {
        $sql = "SELECT * FROM rsv_salas WHERE estatus = 1 order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    
    public function getSalas0() {
        $sql = "SELECT * FROM rsv_salas  order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    //no se esta utilizando a hoy 18/06/24
    public function getSalasXdia($fecha) {
        $sql = "SELECT r.id, r.sala, r.capacidad FROM rsv_salas r LEFT JOIN rsv_salas_reservadas res ON r.id = res.id_sala 
        AND DATE(res.fecha_reservada) = '$fecha' WHERE res.id IS NULL";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    public function getSalaXconsulta($id) {
        $sql = "SELECT rs.id as id_solicitud, rs.id_sala, rs.fecha_reservada, rs.hora_inicio, rs.hora_final, rs.fecha_registro, s.*  FROM rsv_salas_reservadas rs LEFT JOIN rsv_salas s 
        ON rs.id_sala = s.id WHERE rs.id = $id";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
    }

    public function getServicios() {
        $sql = "SELECT * FROM rsv_servicios  order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    public function getHorario1(){
        $sql = "SELECT * FROM rsv_horario WHERE NOT ((hora_inicio > '11:00:00' AND hora_fin < '13:00:00') OR (hora_inicio < '11:00:00' AND hora_fin >'13:00:00') OR (hora_inicio >= '11:00:00' AND hora_fin <='13:00:00')) order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getHorario(){
        $sql = "SELECT * FROM rsv_horario order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    //reservar
    public function solicitudesXUsuario($id) {
        $sql = "SELECT s.*, sala.nombre as sala_nombre, sala.capacidad as sala_capacidad FROM rsv_solicitud s
        LEFT JOIN rsv_salas sala 
        ON s.sala = sala.id
        WHERE s.id_usuario = $id order by s.id DESC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    public function getSolicitudXid($id) {
        $sql = "SELECT * FROM rsv_solicitud WHERE id = $id limit 1";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
    }
    //rsv_salas_temporal W
    // public function validarSalaReservaTemporal($id) {
    //     $sql = "SELECT count(id) FROM rsv_salas_reservadas WHERE id = $id order by id DESC";
    //     $sentencia = $this->conexion_db->prepare($sql);
    //     $sentencia->execute(array());
    //     $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
    //     return $resultado;
    // }
    // public function validarSolicitudCompleta($id) {
    //     $sql = "SELECT count(*) FROM rsv_solicitud WHERE id_reserva_sala = $id order by id_reserva_sala DESC";
    //     $sentencia = $this->conexion_db->prepare($sql);
    //     $sentencia->execute(array());
    //     $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
    //     return $resultado;
    // }
    // public function isEmailRegistrado($email, $evento) {
    //     $sql = "SELECT count(id) as registrado FROM participantes WHERE email=:email AND evento_id=:evento ";
    //     $sentencia = $this->conexion_db->prepare($sql);
    //     $sentencia->bindParam(':email', $email);
    //     $sentencia->bindParam(':evento', $evento);
    //     $sentencia->execute();
    //     $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
    //     return $resultado->registrado;
    // }

    public function existRsIdTemporal($id) {
    $sql = "SELECT count(id) as rsv_tmp FROM rsv_salas_reservadas WHERE id=:id AND estatus = 1";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->bindParam(':id', $id);
        $sentencia->execute();
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado->rsv_tmp;
    }
    public function validarSolicitudCompleta($id) {
        $sql = "SELECT count(*) as solicitud FROM rsv_salas_reservadas t1 
                JOIN rsv_solicitud t2 ON t1.id = t2.id_reserva_sala
                WHERE t1.id=:id";
            $sentencia = $this->conexion_db->prepare($sql);
            $sentencia->bindParam(':id', $id);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
            return $resultado->solicitud;
        }
    
    public function validarSalaReservaTemporal($id) {
        $sql = "SELECT id FROM rsv_salas_reservadas WHERE id = $id order by id DESC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
    }
    
    public function getEstatus($id) {
        $sql = "SELECT * FROM rsv_solicitud_estatus WHERE id = $id";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
    }
    // reservacion

    public function listSolicitudes($id) {
        $sql = "SELECT s.*, u.nombre as solicitante_nombre, u.apellidop as solicitante_apellidop, 
        u.apellidom as solicitante_apellidom, u.email as solicitante_email, sala.nombre as sala_nombre, sala.capacidad as sala_capacidad
        FROM rsv_solicitud s LEFT JOIN usuarios u 
        ON s.id_usuario = u.id 
        LEFT JOIN rsv_salas sala
        ON s.sala = sala.id
        WHERE s.id_admin = $id order by id DESC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getXsala($id) {
        $sql = "SELECT * FROM rsv_salas WHERE id = $id";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getSalasXid($id) {
        $sql = "SELECT * FROM rsv_salas WHERE id = $id";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    //servicios por solicitud
    public function getServiciosXSolicitud($id) {
        $sql = "SELECT * FROM rsv_solicitud_servicios WHERE id_solicitud = $id";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getServiciosXid($id) {
        $sql = "SELECT * FROM rsv_servicios WHERE id = $id";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    // revisar funcionalidad
    public function filterSalasByFechas($inicio , $fin , $id_sala  ) {
        $sql = "SELECT * FROM rsv_salas WHERE id = $id_sala";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
	}
    
    public function getEventosCalendario() {
        $sql = "SELECT nombre as title, color, textColor, url, start, end FROM rsv_solicitud order by id DESC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        // return $resultado;
        return json_encode($resultado);

    }

    //salas 
    public function getPosiciones() {
        $sql = "SELECT * FROM rsv_posiciones where id_sala=1 ORDER BY id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        // return $resultado;
        return json_encode($resultado);

    }

    //horarios

    public function salaHorarioXEstatus($id, $fecha) {
        $sql = "SELECT * FROM rsv_salas_reservadas WHERE id_sala = $id AND fecha_reservada = '$fecha' AND estatus = 1 ORDER BY `hora_inicio` ASC ";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getHorarioXsala($hora_inicio, $hora_fin){
        $sql = "SELECT * FROM rsv_horario WHERE ((hora_inicio > '$hora_inicio' AND hora_fin < '$hora_fin') OR (hora_inicio < '$hora_inicio' AND hora_fin >'$hora_fin') OR (hora_inicio >= '$hora_inicio' AND hora_fin <='$hora_fin')) order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getHorarioInicio(){
        $sql = "SELECT hora_inicio FROM rsv_horario order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getHorarioFinal(){
        $sql = "SELECT hora_fin FROM rsv_horario order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    public function getSolicitudIdXKey($id) {
        $sql = "SELECT * FROM rsv_solicitud WHERE rva_key = $id limit 1";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
    }
  
}

?>