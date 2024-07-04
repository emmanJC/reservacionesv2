<?php
  
?>

<header class="page-header">
    <h2>Proovedores</h2>
</header>
                    <!-- start: page -->


<div class="row">
    <div class="col-lg-12">
        <div class="card  ">
									<div class="card-header">
										<h2 class="card-title">Selección </h2>
                                         
                                        <div class="btn-group d-flex  pull-right" role="group">
                                            <a href="?seccion=reservacion&accion=listaProovedores" class="btn btn-secondary mr-1"> <i class="fa-solid fa-arrow-left"></i> Volver a Lista</a> 
                                        </div>
                                        <p class="card-subtitle">
                                            Seleciona 3 Proovedores de la lista porporcionada<span class="required"></span>
                                        </p>
									</div>
                                
		</div>



        <section class="card card-modern card-big-info w-100">
                                <form id="form" action="./controller/reservacion.php?accion=add_proovedor" method="post" class="form-horizontal form-validate" enctype="multipart/form-data">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-2-5 col-xl-1-5 px-xl-3"> 
                                                <img src="./img/solicitud/evento.jpg" class="mw-100 mb-2" width="150" alt="Solicitud detalles">
												<h2 class="card-big-info-title  text-6">Información del proovedor</h2>
												<!-- <p class="card-big-info-desc">Add here the category description with all details and necessary information.</p> -->
											</div>
											<div class="col-lg-3-5 col-xl-4-5 px-lg-1"> 

                                                <div class="form-group row pb-2 justify-content-center align-items-center">
                                                    <label class="col-xl-3 col-lg-3 control-label text-lg-end">Nombre del proovedor <span class="required">*</span></label>
                                                    <div class="col-xl-6 col-lg-8 px-lg-0">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control form-control-sm" name="nombre" placeholder="MONITOREO Y VALIDACIÓN DE..." required>
                                                            <span class="input-group-text">
                                                                <i class="fa-solid fa-truck-arrow-right"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group row pb-2 justify-content-center align-items-center">
                                                    <label class="col-xl-3 col-lg-3 control-label text-lg-end">Correo electrónico <span class="required">*</span></label>
                                                    <div class="col-xl-6 col-lg-8 px-lg-0">
                                                        <div class="input-group">
                                                            <input type="email" class="form-control form-control-sm" name="correo" placeholder="correo@midominio.com" required>
                                                            <span class="input-group-text">
                                                                <i class="fas fa-envelope"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row pb-2 justify-content-center align-items-center">
                                                    <label class="col-xl-3 col-lg-3 control-label text-lg-end">Teléfono <span class="required">*</span></label>
                                                    <div class="col-xl-6 col-lg-8 px-lg-0">
                                                        <div class="input-group">
                                                            <input type="phone" class="form-control form-control-sm" name="telefono" placeholder=" " required>
                                                            <span class="input-group-text">
                                                                <i class="fa-solid fa-phone"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row pb-2 justify-content-center align-items-center">
                                                    <label class="col-xl-3 col-lg-3 control-label text-lg-end">Dirección</label>
                                                    <div class="col-xl-6 col-lg-8 px-lg-0">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control form-control-sm" name="direccion" placeholder=" " required>
                                                            <span class="input-group-text">
                                                                <i class="fa-solid fa-location-dot"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row pb-2 justify-content-center align-items-center">
                                                    <label class="col-xl-3 col-lg-3 control-label text-lg-end">Página web</label>
                                                    <div class="col-xl-6 col-lg-8 px-lg-0">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control form-control-sm" name="pagina" placeholder="https://www.midominio.com" required>
                                                            <span class="input-group-text">
                                                                <i class="fa-solid fa-globe"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
 
                                                <div class="form-group row pb-2 justify-content-center align-items-center">
                                                    <label class="col-xl-3 col-lg-3 control-label text-lg-end">Logo</label>
                                                    <div class="col-xl-6 col-lg-8 px-lg-0">
                                                        <div class="input-group">
                                                            
                                                        <input type="file" name="img" id="img" class="form-control " accept='.jpg' >
                                                            <span class="input-group-text"> 
                                                                <i class="fas fa-chalkboard-teacher"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>  
                                                

											</div>
										</div>
									</div> 
                                </form>

                            </section> 

                                
                            <div class="card card-modern">
									<div class="card-header">
										<h2 class="card-title">Menús</h2>
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

                                <!-- menu -->
                           
                                <div class="row mb-5 mt-5">
									<div class="col">
										<div class="d-flex flex-wrap bg-light custom-link-hover-effects custom-instructor-details">
											<div class="position-relative lazyload col-12 col-lg-3" style="background-position: center; background-size: cover; min-height: 302px; background-image: url('./img/team-1.jpg')">
											</div>
											<div class="col-lg-9 p-5">

												<div class="d-md-flex mb-4">
													<div class="ps-lg-0 mb-3 mb-md-0 pe-4 me-4 border-right">
														<div class="d-flex flex-row align-items-center h-100">
															<div class="p-0">
																<p class="mb-0 text-1 text-uppercase p-relative top-3">Full Name</p>
																<h4 class="mb-0 text-color-secondary text-6">Robert Doe</h4>
															</div>
														</div>
													</div>
													<div class="ps-lg-0 mb-3 mb-md-0 pe-4 me-4 border-right">
														<div class="d-flex flex-row align-items-center h-100">
															<div class="p-0">
																<p class="mb-0 text-1 text-uppercase p-relative top-3">Available Courses</p>
																<h4 class="mb-0 text-color-secondary text-3">12</h4>
															</div>
														</div>
													</div>
													<div class="ps-lg-0 mb-3 mb-md-0 pe-4 me-4 flex-grow-1">
														<div class="d-flex flex-row align-items-center h-100">
															<div class="p-0">
																<p class="mb-0 text-1 text-uppercase p-relative top-3">Average Rating</p>
																<h4 class="mb-0 text-color-secondary text-3">4.75</h4>
															</div>
														</div>
													</div>
													<div class="ps-lg-4">
														<div class="d-flex flex-row align-items-center h-100">
															<div class="p-0">
																<a href="#" class="btn btn-secondary font-weight-bold  btn-sm">Editar Menú</a>
															</div>
														</div>
													</div>
												</div>

												<div class="custom-read-more-style-1">
													<p class="text-3-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vulputate posuere tortor luctus vulputate. Cras laoreet pretium blandit. </p>
													<p class="text-3-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vulputate posuere tortor luctus vulputate. Cras laoreet pretium blandit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vulputate posuere tortor luctus vulputate. Cras laoreet pretium blandit. </p>
													<p class="text-3-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vulputate posuere tortor luctus vulputate. Cras laoreet pretium blandit. </p>
													 
												</div>

											</div>
										</div>
									</div>
								</div>
                                
    </div>
</div>