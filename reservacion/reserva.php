<?php
if(!isset($_GET['id'])){
    exit;
}

$solicitud = $S->getSolicitudXid($_GET['id']);
$sala_name = $S->getXsala($solicitud->sala);
$estatus = $S->getEstatus($solicitud->estatus);
$notYes = 1;
$usuario = $U->getUsuarioById($solicitud->id_usuario);
$servicioXsolicitud = $S->getServiciosXSolicitud($_GET['id']);
// var_dump($servicioXsolicitud);
// var_dump($usuario);
?>
<header class="page-header">
    <h2>Solicitud de reservación</h2>
</header>

<!-- start: page -->
<div class="row">
    <div class="col">
        <div class="card-header">

        </div>
    </div>
    
</div>

<div class="row">
        <div class="col-xl-5 mb-4 mb-xl-0">

                <div class="card card-modern">
                    <div class="card-header">
                        <h2 class="card-title">Detalles de la solicitud</h2>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                    <!-- <div class="col-xl-auto me-xl-5 pe-xl-5 mb-4 mb-xl-0">
                                        <h3 class="text-color-dark font-weight-bold text-4 line-height-1 mt-0 mb-3">Fecha solicitud</h3>
                                        <ul class="list list-unstyled list-item-bottom-space-0">
                                                <li>Fecha solicitud: </li>
                                                 
                                        </ul>
                                    </div> -->
                                    <div class="col-xl-auto me-xl-5 pe-xl-5 mb-4 mb-xl-0">
                                        <h3 class="text-color-dark font-weight-bold text-4 line-height-1 mt-0 mb-3">Datos del solicitante</h3>
                                        <ul class="list list-unstyled list-item-bottom-space-0">
                                                <li class="text-4">Fecha solicitud: <strong> <?php echo $solicitud->fecha_solicitud?></strong></li>
                                                <li class="text-4">Nombre: <strong><?php echo $usuario->nombre .' '. $usuario->apellidop .' '. $usuario->apellidom?> </strong> </li>
                                                <li class="text-4">Área: <strong>DM </strong> </li>
                                                <li class="text-4">Correo: <strong> <?php echo $usuario->email?></strong> </li>
                                                <li class="text-4">Correo para copia <strong><?php echo $solicitud->correo_solicitante?> </strong> </li>
                                        </ul>
                                    </div>

                                    <div class="col-xl-auto me-xl-5 pe-xl-5 mb-4 mb-xl-0">
                                        <h3 class="text-color-dark font-weight-bold text-4 line-height-1 mt-0 mb-3">Administrador asignado</h3>
                                        <ul class="list list-unstyled list-item-bottom-space-0">
                                                <li class="text-4">Nombre: <strong>Ale Pruebas </strong></li>
                                                <li class="text-4">Correo: <strong>pruebas@jc-innovation.com </strong></li>
                                        </ul>
                                    </div>
                                    <div class="col-xl-auto me-xl-5 pe-xl-5 mb-4 mb-xl-0">
                                        <h3 class="text-color-dark font-weight-bold text-4 line-height-1 mt-0 mb-3">Estatus</h3>
                                        <p class="text-4"> <i class="fas fa-circle" style="color:<?php echo $estatus->color?>"></i>  <strong><?php echo $estatus->nombre ?></strong></p>
                                    </div>

                            </div>


                        
                    </div>
                </div>

        </div>


        <div class="col-xl-7">

								<div class="card card-modern">
									<div class="card-header">
										<h2 class="card-title">Información del evento o reunión</h2>
									</div>
									<div class="card-body">
										<div class="row">
											<div class="col-xl-auto me-xl-5 pe-xl-5 mb-4 mb-xl-0">
												<h3 class="text-color-dark font-weight-bold text-4 line-height-1 mt-0 mb-3">Datos</h3>
												<ul class="list list-unstyled list-item-bottom-space-0">
													<li class="text-4">Espacio: <strong><?php echo $sala_name->nombre?></strong> </li>
													<li class="text-4">Fecha del evento: <strong><?php echo $solicitud->fecha_evento?></strong> </li>
													<li class="text-4">Hora de inicio: <strong><?php echo $solicitud->hora_inicio?></strong> </li>
													<li class="text-4">Hora final: <strong><?php echo $solicitud->hora_fin?></strong> </li>
													<li class="text-4">Nombre del evento: <strong><?php echo $solicitud->nombre?></strong> </li>
												</ul>
                                                
											</div>
											<div class="col-xl-auto me-xl-5  pe-xl-5 mb-4 mb-xl-0">
												<h3 class="font-weight-bold text-color-dark text-4 line-height-1 mt-0 mb-3">Requerimientos</h3>
												<ul class="list list-unstyled list-item-bottom-space-0">
													<li class="text-4">Equipo requerido: <strong><?php echo $solicitud->equipo == $notYes ? 'Si' : 'No' ;?></strong></li>
													<li class="text-4">Servicio de alimentos y bebidas: <strong><?php echo $solicitud->servicio == $notYes ? 'Si' : 'No' ;?></strong></li> 
												</ul> 
                                                <strong class="d-block text-color-dark">Número de participantes:</strong>
                                                <p class="text-4"><strong><?php echo $solicitud->asistentes ;?> Personas</strong></p>
											</div>
										</div>
									</div>
								</div>

							</div>






</div>



<!-- requerimientos -->


                        <div class="row">
							<div class="col">

								<div class="card card-modern">
									<div class="card-header">
										<h2 class="card-title">Requerimientos</h2>
									</div>
									<div class="card-body">
										<div class="ecommerce-timeline mb-3">
											<div class="ecommerce-timeline-items-wrapper">
												<div class="ecommerce-timeline-item d-flex justify-content-between align-items-center">
													<p class="text-4">Audio y video</p>
                                                    <img width="90" height="90" alt="" class="img-fluid" src="./img/solicitud/Equipo-de-audio.jpg">
												</div>
												
											</div>
										</div> 
									</div>
								</div>

							</div>
						</div>

<!-- servicios -->


                        <div class="row">
							<div class="col">

								<div class="card card-modern">
									<div class="card-header">
										<h2 class="card-title">Servicio de alimentos y bebidas</h2>
									</div>
									<div class="card-body">
										<div class="ecommerce-timeline mb-1">
											<div class="ecommerce-timeline-items-wrapper">

                                            <?php
                                                // $servicios = $S->getServicios($servicioXsolicitud->id_servicio);

                                            //    var_dump($servicioXsolicitud);
                                                foreach($servicioXsolicitud as $servicioXsolicitud){
                                                    //  echo $servicio->id_servicio;
                                                    $servicios = $S->getServiciosXid($servicioXsolicitud->id_servicio);
                                               
                                                // var_dump($servicios);
                                                foreach($servicios as $servicio){

                                            ?>
												<div class="ecommerce-timeline-item d-flex justify-content-between align-items-center">
													<p class="text-4"><?php echo $servicio->nombre ?> <span><?php echo $servicioXsolicitud->descripcion ?></span></p>
                                                    <img width="40" height="40" alt="" class="img-fluid" src="./img/solicitud/<?php echo 'servicio_'.$servicio->id ?>.jpg">
                                                </div>

                                                <?php
                                                    } 
                                                }
                                                ?>
                                                 
												
											</div> 
										</div> 
                                        



									</div>
								</div>

							</div>
						</div>


                        <div class="row">

                            <div class="col">
                            <div class="card card-modern">
									<div class="card-header">
										<h2 class="card-title">Proveedor</h2>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<table class="table table-ecommerce-simple table-ecommerce-simple-border-bottom table-borderless table-striped mb-0" style="min-width: 380px;">
												<thead>
													<tr>
														<th width="10%" class="ps-4">#</th>
														<th width="40%">Nombre</th>
														<th width="15%" class="text-end">Personas</th>
														<th width="20%" class="text-end">Costo por persona</th>
														<th width="15%" class="text-end">Costo Total</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td class="ps-4"><a href="ecommerce-products-form.html"><strong>1</strong></a></td>
														<td><a href="ecommerce-products-form.html"><strong>Eventos La Fete</strong></a></td>
														<td class="text-end"><?php echo $solicitud->asistentes ;?></td>
														<td class="text-end">$170</td>
														<td class="text-end">$<?php  echo ( $solicitud->asistentes * 170)?></td>
													</tr>
													<tr>
														<td class="ps-4"><a href="ecommerce-products-form.html"><strong>2</strong></a></td>
														<td><a href="ecommerce-products-form.html"><strong>Panetela</strong></a></td>
														<td class="text-end"><?php echo $solicitud->asistentes ;?></td>
														<td class="text-end">$255</td>
														<td class="text-end">$<?php echo ($solicitud->asistentes *255) ;?></td>
													</tr>
													<!-- <tr>
														<td class="ps-4"><a href="ecommerce-products-form.html"><strong>3</strong></a></td>
														<td><a href="ecommerce-products-form.html"><strong>Product Name Example 3</strong></a></td>
														<td class="text-end">$132</td>
														<td class="text-end">1</td>
														<td class="text-end">$132</td>
													</tr> -->
												</tbody>
											</table>
										</div>

										 
									</div>
								</div>      
                            
                            </div>
                        </div>