<?php 
    $id = $_GET['id'];
    $usuario_id = $_SESSION[AMBIENTE]['usuario']['id'];
    $salaConsulta = $S->getSalaXconsulta($id);
    $servicios = $S->getServicios($id);
    $usuario = $U->getUsuarioById($usuario_id);

    // var_dump($salaConsulta);
 ?> 

                     <header class="page-header">
						<h2>Solicitud de reservación de sala o auditorio</h2>
                        <!-- <h3>Hora: <?php echo $salaConsulta->fecha_registro?></h3> -->
					</header>

                    <?php 
                 
                    $validar1 = $S->existRsIdTemporal($_GET['id']);
                    $validar2 = $S->validarSolicitudCompleta($_GET['id']);

                    if(!$validar1){
                        exit;
                    }
                    if($validar2){
                        exit;
                    }

                    ?>
                    <!-- start: page -->
                    <form class="form-horizontal form-validate" action="controller/solicitud.php?accion=alta_solicitud" method="post">

                        <div class="row mt-2">
                                <div class="col">
                                    <section class="card card-big-info">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-2-5 col-xl-1-5 px-xl-3"> 
                                                    <img src="./img/solicitud/solicitud.jpg" class="mw-100 mb-2" width="150" alt="Solicitud detalles">
                                                    <h2 class="card-big-info-title text-6">Detalles de la solicitud</h2> 
                                                </div>
                                                
                                                            <input hidden type="text" name="sala" value=" <?php echo $salaConsulta->id_sala; ?>">
                                                            <input hidden type="text" name="fecha_evento" value=" <?php echo $salaConsulta->fecha_reservada; ?>">
                                                            <input hidden type="text" name="hora_inicio" value=" <?php echo $salaConsulta->hora_inicio; ?>">
                                                            <input hidden type="text" name="hora_fin" value=" <?php echo $salaConsulta->hora_final; ?>">
                                                            <input hidden type="text" name="id_reserva_sala" value="<?php echo $salaConsulta->id_solicitud ?>">
                                                            <input hidden type="text" name="id_usuario" value="<?php echo $usuario_id ?>"> 
                                                            <input hidden type="text" name="id_admin" value="<?php echo $salaConsulta->admin?>"> 
                                                            <input hidden type="text" name="start" value=" <?php echo  $salaConsulta->fecha_reservada .' '.$salaConsulta->hora_inicio; ?>">
                                                            <input hidden type="text" name="end" value=" <?php echo  $salaConsulta->fecha_reservada .' '.$salaConsulta->hora_final; ?>">
                                                <div class="col-lg-3-5 col-xl-4-5">
                                                    
                                                    <div class="d-flex flex-wrap mb-4 justify-content-between">
                                                        <?php
                                                            $fechaSolicitud= $salaConsulta->fecha_reservada;
                                                            $newfechaSolicitud= new DateTime($fechaSolicitud);
                                                        ?>

                                                        <div class="ps-md-0 mb-3 mb-lg-4 pe-4 me-4 border-right">
                                                            <div class="d-flex flex-row align-items-center h-100">
                                                                <div class="p-0">
                                                                    <p class="mb-0 text-3 text-uppercase p-relative top-3 fw-normal">Fecha del evento</p>
                                                                    <h4 class="mb-0 text-color-primary text-6 fw-bold"> <?php echo $newfechaSolicitud->format('d-m-Y'); ?> </h4>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <div class="ps-md-0 mb-3 mb-lg-4 pe-4 me-4 border-right">
                                                            <div class="d-flex flex-row align-items-center h-100">
                                                                <div class="p-0">
                                                                    <p class="mb-0 text-3 text-uppercase p-relative top-3 fw-normal">Espacio</p>
                                                                    <h4 class="mb-0 text-color-primary text-6 fw-bold"> <?php echo $salaConsulta->nombre; ?> </h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php $horaInicio= $salaConsulta->hora_inicio;
                                                                $horaFinal= $salaConsulta->hora_final;
                                                                $newHoraInicio= new DateTime($horaInicio);
                                                                $newHoraFinal= new DateTime($horaFinal);
                                                                $meridiano = 'am';
                                                                
                                                                if($salaConsulta->hora_inicio >='12:00:00' || $salaConsulta->hora_final >='12:00:00'){
                                                                    $meridiano = 'pm';
                                                                }?>
                                                        <div class="ps-md-0 mb-3 mb-lg-4  pe-4 me-4 border-right">
                                                            <div class="d-flex flex-row align-items-center h-100">
                                                                <div class="p-0">
                                                                    <p class="mb-0 text-3 text-uppercase p-relative top-3 fw-normal">Hora de inicio</p>
                                                                    <h4 class="mb-0 text-color-primary text-6 fw-bold"><?php echo $newHoraInicio->format('H:i') .' '. $meridiano?> </h4>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                        <div class="ps-md-0 mb-3 mb-lg-4 pe-4 me-4 border-right">
                                                            <div class="d-flex flex-row align-items-center h-100">
                                                                <div class="p-0">
                                                                    <p class="mb-0 text-3 text-uppercase p-relative top-3 fw-normal">Hora final</p>
                                                                    <h4 class="mb-0 text-color-primary text-6 fw-bold"><?php echo $newHoraFinal->format('H:i') .' '. $meridiano?></h4>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="ps-md-0 mb-3 mb-lg-4 pe-4 me-4">
                                                            <div class="d-flex flex-row align-items-center h-100">
                                                                <div class="p-0">
                                                                    <p class="mb-0 text-3 text-uppercase p-relative top-3 fw-normal">Nombre del solicitante</p>
                                                                    <h4 class="mb-0 text-color-primary text-6 fw-bold">
                                                                        
                                                                    <?php echo $usuario->nombre .' '. $usuario->apellidop .' '. $usuario->apellidom ?>
                                                                    </h4>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>


                                                                <!-- <?php var_dump($usuario); ?> -->

                                                </div>



                                            </div>
                                        </div>
                                    </section>
                                </div>
                            </div>
						
						<div class="row mt-4">
							<div class="col">
								<section class="card card-big-info">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-2-5 col-xl-1-5 px-xl-3">
                                                <!-- <i class="card-big-info-icon bx bx-id-card"></i> -->
                                                <img src="./img/solicitud/evento.jpg" class="mw-100 mb-2" width="150" alt="Solicitud detalles">
												<h2 class="card-big-info-title  text-6">Información del evento o reunión</h2>
												<!-- <p class="card-big-info-desc">Add here the category description with all details and necessary information.</p> -->
											</div>
											<div class="col-lg-3-5 col-xl-4-5 px-lg-1"> 

                                                <div class="form-group row pb-2 justify-content-center align-items-center">
                                                    <label class="col-xl-3 col-lg-3 control-label text-lg-end">Nombre del evento</label>
                                                    <div class="col-xl-6 col-lg-8 px-lg-0">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control form-control-sm" name="nombre" placeholder="MONITOREO Y VALIDACIÓN DE..." required>
                                                            <span class="input-group-text">
                                                                <!-- <i class="fas fa-user"></i> -->
                                                                <i class="fas fa-chalkboard-teacher"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group row pb-2 justify-content-center align-items-center">
                                                    <label class="col-xl-3 col-lg-3 control-label text-lg-end pt-1">Área solicitante</label>
                                                    <div class="col-xl-6 col-lg-8 px-lg-0">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control form-control-sm" name="area" placeholder="DM" required>
                                                            <span class="input-group-text">
                                                                <i class="fas fa-id-card-alt"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div> -->
 


                                                <div class="form-group row pb-2 justify-content-center align-items-center">
                                                    <label class="col-xl-3 col-lg-3 control-label text-lg-end">Correo electrónico para copia</label>
                                                    <div class="col-xl-6 col-lg-8 px-lg-0">
                                                        <div class="input-group">
                                                            <input type="email" class="form-control form-control-sm" name="correo_solicitante" placeholder="correo@midominio.com" required>
                                                            <span class="input-group-text">
                                                                <i class="fas fa-envelope"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row pb-2 justify-content-center">
                                                    <label class="col-xl-3 col-lg-3 control-label text-lg-end py-lg-2">Asistentes</label>
                                                    <div class="col-xl-6 col-lg-8 px-lg-0">
                                                        <div data-plugin-spinner data-plugin-options='{ "value":<?php echo $salaConsulta->capacidad ?>, "step": 1, "min": 1, "max": <?php echo $salaConsulta->capacidad ?> }'>
                                                            <div class="input-group">
                                                                <button type="button" class="btn btn-default btn-sm  spinner-up">
                                                                    <i class="fas fa-plus"></i>
                                                                </button>
                                                                <input type="text" class="spinner-input form-control form-control-sm" maxlength="3" readonly name="asistentes">
                                                                <button type="button" class="btn btn-default btn-sm spinner-down">
                                                                    <i class="fas fa-minus"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <p>Capacidad máxima <?php echo $salaConsulta->capacidad ?></p>
                                                    </div>
                                                </div>
                                                

											</div>
										</div>
									</div>
								</section>
							</div>
						</div>

                        <!-- requerimientos -->
                        <div class="row mt-4">
							<div class="col">
								<section class="card card-big-info">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-2-5 col-xl-1-5 px-xl-3">
                                                <!-- <i class="card-big-info-icon bx bx-id-card"></i> -->
                                                <img src="./img/solicitud/audio-video.jpg" class="mw-100 mb-2" width="150" alt="Solicitud detalles">
												<h2 class="card-big-info-title text-6">Requerimientos</h2>
												<!-- <p class="card-big-info-desc">Add here the category description with all details and necessary information.</p> -->
											</div>

											<div class="col-lg-3-5 col-xl-4-5 px-lg-1">
                                                <div class="row align-items-center justify-content-center mb-4">
                                                    <div class="col-xl-3 col-lg-3 col-sm-3 text-center">
                                                        <label for="equipo" class="d-block">
                                                            <!-- <img src="../img/demos/hotel/rooms/room-1.jpg" class="img-fluid my-3 my-md-0" alt=""> -->
															<img width="90" height="90" alt="" class="img-fluid" src="./img/solicitud/Equipo-de-audio.jpg">

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-8 col-sm-8">
                                                        <label for="equipo" class="d-flex justify-content-between">
                                                            <h5 class="text-transform-none text-5 font-weight-bold mt-2 mb-0">Audio y video</h5>
                                                            <div class="custom-room-suite-info p-relative top-6">
                                                                    <div class="switch switch-info">
                                                                        <input id="equipo" type="checkbox" name="equipo" data-plugin-ios-switch checked="checked" />
                                                                    </div>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>

											</div>

										</div>
									</div>
								</section>
							</div>
						</div>

                        <!-- servicios -->

                        <div class="row mt-4">
							<div class="col">
								<section class="card card-big-info">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-2-5 col-xl-1-5 px-xl-3"> 
                                                <img src="./img/solicitud/alimentos-bebidas.jpg" class="mw-100 mb-2" width="150" alt="Solicitud servicio alimentos y bebidas">
												<h2 class="card-big-info-title text-6 ">Servicio de alimentos y bebidas</h2>
											</div>

											<div class="col-lg-3-5 col-xl-4-5 px-lg-1">
                                                
                                            <?php 
                                                foreach($servicios as $servicio){
                                            ?>
                                                <div class="row mx-0 align-items-center justify-content-center mb-3 pb-3 border-bottom">
                                                    <div class="col-xl-3 col-lg-3 col-sm-3 text-center">
                                                        <label for="<?php echo 'servicio_'.$servicio->id ?>" class="d-block">
															<img width="90" height="90" alt="" class="img-fluid" src="./img/solicitud/<?php echo 'servicio_'.$servicio->id ?>.jpg">

                                                        </label>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-8 col-sm-8">
                                                        <label for="<?php echo 'servicio_'.$servicio->id ?>" class="d-flex justify-content-between">
                                                            <h5 class="text-transform-none text-5 font-weight-bold mt-2 mb-0"><?php echo $servicio->nombre; ?></h5>
                                                               
                                                            <div class="custom-room-suite-info p-relative top-6">
                                                                    <div class="switch switch-warning">
                                                                        <input id="<?php echo 'servicio_'.$servicio->id ?>" type="checkbox" name="<?php echo 'servicio_'.$servicio->id ?>" data-plugin-ios-switch />
                                                                    </div>
                                                            </div>
                                                        </label>
                                                    </div>

                                                    <?php 
                                                        if($servicio->id == 8){
                                                    ?>
                                                        <div id="contenedor_srv8" class="form-group row pb-4 justify-content-center pt-4 visually-hidden">
                                                            <label class="col-md-2 control-label text-lg-end">¿Cuál?</label>
                                                            <div class="col-md-6">
                                                                <div class="input-group">
                                                                    <input id="servicio_id8" type="text" class="form-control form-control-sm" name="servicio_id8" placeholder="Describe otro servicio">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-question"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                     
                                                    
                                                    <?php
                                                        }
                                                    ?>

                                                </div>

                                            <?php    
                                                }
                                            
                                            ?>
                                                


										</div>
									</div>
								</section>
							</div>
						</div>

                        <!-- botones completar solicitud -->
                        <div class="row mt-4">
                            <div class="col">
                                <section class="card card-modern card-big-info w-100">
                                    <div class="card-footer">
                                        <div class="row action-buttons justify-content-end  px-lg-2">
                                            <div class="col-12 col-md-auto"> 
                                                <button type="submit" class="btn btn-primary mt-3 mb-3 d-flex align-items-center"><i class='bx bx-mail-send text-4 me-2'></i> Enviar solicitud</button>
                                            </div>
                                            <div class="col-12 col-md-auto px-md-0 mt-3 mt-md-0">
                                                <a href="controller/solicitud.php?accion=liberarHorarioSala&id=<?php echo $_GET['id'] ?>" class="cancel-button btn btn-danger mt-3 mb-3 d-flex align-items-center"><i class="fa-solid fa-x text-4 me-2"></i> Cancelar</a>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>

					</form>
					<!-- end: page -->

                    