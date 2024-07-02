<header class="page-header">
    <h2>Evaluación</h2>
</header>

<!-- start: page -->


<div class="row">
    <div class="col-lg-12">
        <div class="card  ">
									<div class="card-header">
										<h2 class="card-title">Configuración</h2>
                                        
                                        <div class="btn-group d-flex  pull-right" role="group">
                                            <a href="./?seccion=reservacion&accion=lista" class="pr-2 btn btn-secondary mr-1 " > 
                                            <i class="fa-solid fa-arrow-left"></i>
                                            Volver a reservaciones</a>
                                        </div>
                                        <p class="card-subtitle">
                                            Todos los campos marcados con <span class="required">*</span> son obligatorios
                                        </p>
									</div>
                                    <div class="card-header">
                                       
                                    </div>
									<div class="card-body">
          
                                    <form id="form" action="./controller/reservacion.php?accion=add_producto" method="post" class="form-horizontal  form-validate" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="nombre">Nombre <span class="required">*</span></label>
                                                <input type="text" class="form-control" placeholder="" id="nombre" name="nombre" required>
                                            </div> 
                                            <div class="col-12">
                                                <label for="nombre">Tipo<span class="required">*</span></label>
                                                <input type="text" class="form-control" placeholder="Evaluación Equipo PES" id="nombre" name="nombre" required>
                                            </div> 
                                            <div class="col-12">
                                                <label for="nombre">Puntaje máximo <span class="required">*</span></label>
                                                <input type="text" class="form-control" placeholder="10" id="nombre" name="nombre" required>
                                            </div> 
                                         
                                            <!-- <div class="col-md-6">
                                                <label for="nombre">Calificación <span class="required">*</span></label>
                                                <input type="num" class="form-control" placeholder="" id="nombre" name="nombre" required>
                                            </div>  -->
                                            <!-- <div class="col-md-6">
                                                <label for="tipo">Tipo de Calificación <span class="required">*</span></label>
                                                    <select name="tipo" class="form-control populate" required>
															<option value="">Seleccione una opción</option>
															<option value="0">Puntaje</option>
															<option value="1">Satisfacción</option>
                                                            
													</select>
                                            </div>   -->


                                        </div>

                                        <button type="submit" class="btn btn-primary mt-3 mb-3">Guardar</button>
                                    </form>


									</div> <!-- card-body -->


                                    




		</div>

                       
                                
    </div>
</div>