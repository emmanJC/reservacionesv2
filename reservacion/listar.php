<?php
 
$getSalas = $S->getSalas();
$list = $S->listSolicitudes();

?>
 


<header class="page-header">
    <h2>Reservaciones</h2>
</header>
<div class="row">
    <div class="col-lg-12 mt-2">
        <section class="card">
            <header class="card-header"> 
                <h2 class="card-title">Lista de reservaciones </h2>
                <div class="btn-group d-flex  pull-right" role="group">
                    <a href="./" class="btn btn-secondary mr-1"> <i class="fa-solid fa-arrow-left"></i> Volver a salas</a>         
                </div>
            </header>

            <div class="card-header">
                <div class="d-flex gap-1 pull-right">          
                        <a class="btn btn-sm btn-success text-rigth" href="#"><i class="fa fa-file-excel" aria-hidden="true"></i> Descargar lista</a>                                                
                </div>
            </div> 

            <div class="card-body table-responsive" >
                <table id="tablaReservaciones" class="table table-responsive table-striped datatable datatable-default">
                    <thead>
                        <tr>
                            <th>#</th>
							<th>Fecha de solicitud</th>
							<th>Nombre del evento</th>
							<th>Fecha del evento</th>
							<th>Hora de inicio</th>
							<th>Hora final</th>
							<th>Nombre de solicitante</th>
							<th>Correo solicitante</th>
							<th>Correo copia solicitante</th>
							<th>Área</th>
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
                        $i = 0;
                        if ($list) {

                            foreach ($list as $solicitud) {
            					$usuario = $U->getUsuarioById($solicitud->id_usuario);
								// var_dump($usuario);
                                $i++;
                                ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $solicitud->fecha_solicitud; ?></td>
                            <td><?php echo $solicitud->nombre; ?></td>
                            <td><?php echo $solicitud->fecha_evento; ?></td>
                            <td><?php echo $solicitud->start; ?></td>
                            <td><?php echo $solicitud->end; ?></td>
                            <td><?php echo $usuario->nombre .' '. $usuario->apellidop .' '. $usuario->apellidom?></td>
                            <td><?php echo $usuario->email; ?></td>
                            <td><?php echo $solicitud->correo_solicitante; ?></td>
                            <td><?php echo $solicitud->area; ?></td>
                            
                            <?php 
                             $sala_name = $S->getXsala($solicitud->sala);
                             $notYes = 1;
                            ?>

                            <td><?php echo $sala_name->nombre; ?></td>
                            <td><?php echo $solicitud->asistentes .' / '. $sala_name->capacidad; ?></td>
                            <td><?php echo ($solicitud->equipo == $notYes) ? 'Si' : 'No'; ?></td>
                            <td><?php echo ($solicitud->servicio == $notYes) ? 'Si' : 'No'; ?> 
                                <?php if($solicitud->servicio == 1) {  ?>
                                <!-- <br>Ver servicios -->
                                <?php 
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
                                    <a href="./?seccion=reservacion&accion=reserva&id=<?php echo $solicitud->id ?>"  class="text-3"><i class="far fa-eye"></i></a>
                                </td>
                                <td>
                                    <a href="./?seccion=reservacion&accion=reserva&id=<?php echo $solicitud->id ?> " class="btn btn-warning btn-sm d-inline-flex align-items-center py-0 px-1"><i class="far fa-eye me-1"></i> Resultados</a>
                                </td>

								<td><?php if ($solicitud->fecha_actualizacion != 0) {
                                        echo $solicitud->fecha_actualizacion;
									}
									?>
                                </td>
                            
                        </tr>
                        <?php
                        }
                        }
                        ?>
					</tbody>
                </table> 
            </div>
        </section>
    </div>  
</div>

<!-- estilo para que el ancho del input tipo search sea de 100% y no de 50% como en el css theme.css -->
<style>
    .dataTables_wrapper .dataTables_filter label {
        width: 100%;
    }
</style>