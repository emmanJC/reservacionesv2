<?php  
    $usuario_id = $_SESSION[AMBIENTE]['usuario']['id'];
    $solicitudes=$S->solicitudIdUsuario($usuario_id);
    var_dump($usuario_id);
 ?>                

    <header class="page-header">
        <h2>Reservaciones</h2>        
    </header>

    <!-- start: page -->
    <div class="row">
        <div class="col-lg-12">
            <section class="card">
                <header class="card-header"> 
                    <h2 class="card-title">Lista de reservaciones </h2>
                    <div class="btn-group d-flex  pull-right" role="group">
                        <a href="./" class="btn btn-secondary mr-1"> <i class="fa-solid fa-arrow-left"></i> Volver a salas</a>         
                    </div>
                </header>
                
                <div class="card-body table-responsive" > 
				    <table class="table table-responsive table-striped datatable datatable-default">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha de solicitud</th>
                                <th>Nombre del evento</th>
                                <th>Fecha del evento</th>
                                <th>Hora de inicio</th>
                                <th>Hora final</th>
                                <th>Sala o auditorio</th>
                                <th>Número de participantes</th>
                                <th>Equipo requerido</th>
                                <th>Servicio</th>
                                <th>Estatus</th>
                                <th>Acciones</th>
                                <th>Evaluación</th>
                                <th>Fecha actualización</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if($solicitudes){
                                $i = 1;
                                $notYes = 1;
                                foreach($solicitudes as $solicitud){  
                                    if($solicitud->servicio_tipo == 1){
                                        $servicio_color = '#F57392';
                                        $tipo_servicio = 'PES'; 
                                    }else if($solicitud->servicio_tipo == 2){
                                        $servicio_color = '#E97132';
                                        $tipo_servicio = 'Proovedor';
                                    }else{
                                        $servicio_color = '#E97132';
                                        $tipo_servicio = 'Mixto';
                                    }
                                                                                        
                            ?>
                            <tr>

                                <td><?php echo $i .' '. $solicitud->id?></td>
                                <td><?php echo $solicitud->fecha_solicitud; ?></td>
                                <td><?php echo $solicitud->nombre ;?></td>
                                <td><?php echo $solicitud->fecha_evento ;?></td>
                                <td><?php echo $solicitud->hora_inicio ;?></td>
                                <td><?php echo $solicitud->hora_fin ;?></td>

                                <?php
                                    $sala_name = $S->getXsala($solicitud->sala);
                                ?>
                                <td><?php echo $sala_name->nombre ;?></td>
                                <td><?php echo $solicitud->asistentes ;?></td>
                                <td><?php echo $solicitud->equipo == $notYes ? 'Si' : 'No' ;?></td>
                                <td>
                                    <!-- <?php echo $solicitud->servicio == $notYes ? 'Si' : 'No'; ?> -->
                                     <?php if ( $solicitud->servicio == $notYes ){
                                    ?>        
                                        <div class="text-2 d-inline-flex align-items-center"> <i class="fas fa-circle me-1" style="color:<?php echo $servicio_color?>"></i>  <strong><?php echo $tipo_servicio ?></strong></div>
                                    <?php 
                                        }else{
                                            echo 'Sin servicio';
                                        }
                                    ?>

                                </td>                               

                                <td>
                                    <?php 
                                        $estatus = $S->getEstatus($solicitud->estatus);
                                    ?>
                                        <div class="text-2 d-inline-flex align-items-center"> <i class="fas fa-circle me-1" style="color:<?php echo $estatus->color?>"></i>  <strong><?php echo $estatus->nombre_admin ?></strong></div>

                                    <!-- <a href="" class="btn btn-<?php echo $estatus->color ;?>"><?php echo $estatus->nombre_admin ;?> </a> -->
                                </td>

                                <td class="actions text-center"> 
                                    <a href="./?seccion=reservacion&accion=reserva&id=<?php echo $solicitud->id ?> "><i class="far fa-eye"></i></a>
                                </td>
                                
                                <td>
                                    <a href="./?seccion=reservacion&accion=reserva&id=<?php echo $solicitud->id ?> " class="btn btn-warning btn-sm d-inline-flex align-items-center py-0 px-1"><i class="far fa-eye me-1"></i> Evaluar</a>
                                </td>
                                
                                <td><?php if ($solicitud->fecha_actualizacion != 0) {
                                        echo $solicitud->fecha_actualizacion;
                                }
                                ?>
                                </td>
                    
                            </tr>   
                            <?php 
                                $i++;
                                }
                            }
                            ?>
                            
                            
                            
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
        
    </div>
