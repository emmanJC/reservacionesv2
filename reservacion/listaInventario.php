<!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> -->
<?php
 $inventario = $Rva->getInventario(); 
?>   

        <header class="page-header">
            <h2>Inventario</h2>
        </header>
<div class="row">
    <div class="col-lg-12 mt-2">
        <section class="card">
            <header class="card-header"> 
                <h2 class="card-title">Lista de insumos </h2>
                <div class="btn-group d-flex  pull-right" role="group">
                    <a href="./" class="btn btn-secondary mr-1"> <i class="fa-solid fa-arrow-left"></i> Volver a salas</a> 
                    <a class="btn btn-success text-rigth" href="./?seccion=reservacion&accion=agregarProducto"><i class="fa-solid fa-plus" aria-hidden="true"></i> Agregar producto</a>                        
                </div>
                <br>
                
            </header>

            <div class="card-header">
            <div class="d-flex gap-1 pull-right">          
                        <a class="btn btn-sm btn-success text-rigth" href="descargarInventario.php"><i class="fa fa-file-excel" aria-hidden="true"></i> Descargar lista</a>                        
                        <!-- <a class="btn btn-sm btn-warning add-btn" href=" "><i class="fa-solid fa-chart-pie"></i> Graficar </a> -->
                </div>
            </div>
            <!-- <div class="card-header  border-0">
                    <div class="d-md-flex align-items-center">
                        <h5 class="card-title mb-3 mb-md-0 flex-grow-1">Listado de preguntas </h5>
                        <div class="flex-shrink-0">
                            <div class="d-flex gap-1 flex-wrap">                                
                                <a class="btn btn-success add-btn" href="./?seccion=eventos&accion=preguntas&id" ><i class="fa-solid fa-plus"></i> Agregar Pregunta </a>
                                <a class="btn btn-secondary pr-2  mr-1" href="./?seccion=eventos&accion=editar&id"><i class="fa-solid fa-arrow-left"></i> Volver a evento</a>                                
                            </div>
                        </div>                        
                    </div>
                    <div class="d-flex gap-1 flex-wrap">                                
                        <a class="btn btn-info mr-1 pr-2 " href=" "  target="_blank" > 
                                <i class="fa-solid fa-magnifying-glass"></i>
                                Vista previa
                        </a>    
                        <a class="btn btn-success text-rigth" href=" "><i class="fa fa-file-excel" aria-hidden="true"></i> Descargar resultados</a>                        
                        <a class="btn btn-warning add-btn" href=" "><i class="fa-solid fa-chart-pie"></i> Graficar </a>
                    </div>

                    
                    

                </div>  -->
            

            <div class="card-body table-responsive-md justify-content-between" >
                <!-- <center> -->                         
                <table id="tablaInventario" class="table table-responsive-md table-hover mb-none datatable-default">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Descripción</th> 
                            <th colspan="2">Acciones</th> 
                            <th>Fecha actualización</th> 
                        </tr>
                    </thead>
                    <tbody> 
                           
                                <?php
                                    $i=0;
                                    foreach($inventario as $producto){
                                        $i++; 
                                        $cantidad = $producto->cantidad;
                                ?>
                            <tr>
                                <td><?php echo $i ?></td> 
                                <td>
                                    <?php
                                        if($producto->img != null){
                                    ?>
                                        <img src="./img/inventario/inventario_<?php echo $producto->id.'.'.$producto->img ?>" width="40" alt="Producto">
                                    <?php
                                        }else{
                                    ?>
                                        <img src="./img/inventario/not_image.jpg" width="40" alt="No image">
                                    <?php
                                        }
                                    ?>
                                    <span class="ms-2"> <?php echo $producto->nombre; ?> </span>
                                </td>
                                <td><?php echo $producto->cantidad .' '. $producto->tipos;  if($cantidad>1) : ?>s<?php endif; ?></td>
                                <td><?php echo $producto->descripcion;?></td>
                                <td class="actions">
                                    <a href="./?seccion=reservacion&accion=editarProducto&id=<?php echo $producto->id ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar producto"><i class="fas fa-pencil-alt"></i></a> 
                                </td>
                                <td class="actions">
                                    <a href="./controller/reservacion.php?accion=borrar_producto&id=<?php echo base64_encode($producto->id) ?>&estatus=<?php echo base64_encode($producto->estatus) ?>" onclick="return confirm('¿Está seguro de borrar éste producto?\nUna vez eliminado no podrá recuperar la información.')" class="delete-row text-danger ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar producto"><i class="far fa-trash-alt"></i></a>
                                </td>
                                <td><?php if ($producto->fecha_update != 0 || $producto->fecha_update !='0000-00-00 00:00:00') {
                                        echo $producto->fecha_update;
									}
									?>
                                </td>
                            </tr> 

                                <?php
                                     }
                                ?>
                    </tbody>
                </table>
                <!-- </center> -->
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

<!-- <script type="text/javascript">
    $(document).ready(function () {
        $('#tablaSolicitudes').DataTable({
            dom: 'lBtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'Lista Asistentes',
                    text: '<button class="btn btn-success" name="boton"><i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;&nbsp; Lista de asistentes en excel</button>',
                    titleAttr: 'Descargar Lista',

                }
            ]

        });
    });
</script> -->