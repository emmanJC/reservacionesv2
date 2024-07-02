<?php

    $tipos = $Rva->getTipoProducto();
?>

<header class="page-header">
    <h2>Inventario</h2>
</header>
                    <!-- start: page -->


<div class="row">
    <div class="col-lg-12">
        <div class="card  ">
									<div class="card-header">
										<h2 class="card-title">Agregar producto</h2>
                                        
                                        <div class="btn-group d-flex  pull-right" role="group">
                                            <a href="./?seccion=reservacion&accion=listaInventario" class="pr-2 btn btn-secondary mr-1 " > 
                                            <i class="fa-solid fa-arrow-left"></i>
                                            Volver a inventario</a>
                                        </div>
                                        <p class="card-subtitle">
                                            Todos los campos marcados con <span class="required">*</span> son obligatorios
                                        </p>
									</div>
									<div class="card-body">
          
                                    <form id="form" action="./controller/reservacion.php?accion=add_producto" method="post" class="form-horizontal  form-validate" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="nombre">Nombre producto <span class="required">*</span></label>
                                                <input type="text" class="form-control" placeholder="" id="nombre" name="nombre" required>
                                            </div> 
                                            <div class="col-md-6">
                                                <label for="cantidad">Cantidad <span class="required">*</span></label>
                                                <input type="num" class="form-control" placeholder="1, 2 , 3 ..." id="cantidad" name="cantidad" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="tipo">Tipo de empaque <span class="required">*</span></label>
                                                    <select name="tipo" class="form-control populate" required>
															<option value="">Seleccione una opción</option>
                                                            <?php
                                                                foreach($tipos as $tipo){
                                                            ?>
                                                                <option value="<?php echo $tipo->id ?>"> <?php echo $tipo->nombre ?></option>
                                                            <?php
                                                                }
                                                            ?>
													</select>
                                            </div>  
                                            <div class="col-md-12">
                                                <label for="descripcion">Descripción</label>
                                                <input type="text" class="form-control" placeholder="Con 10 Piezas" id="descripcion" name="descripcion">
                                            </div> 
                                            <div class="col-md-6"> 
                                                    <label for="img" class="control-label text-sm-end pt-2">Imagen JPG</label>
                                                    <div> <input type="file" name="img" id="img" class="form-control" accept='.jpg' ></div>     
                                            </div> 


                                        </div>

                                        <button type="submit" class="btn btn-primary mt-3 mb-3">Guardar</button>
                                    </form>


									</div> <!-- card-body -->


                                    




		</div>

                       
                                
    </div>
</div>