<header class="page-header">
    <h2>Evaluación</h2>
</header>

<div class="row">
    <div class="col-lg-12 mt-2">
        <section class="card">
            <header class="card-header"> 
                <h2 class="card-title">Lista preguntas </h2>
                <div class="btn-group d-flex  pull-right" role="group">
                    <a href="./" class="btn btn-secondary mr-1"> <i class="fa-solid fa-arrow-left"></i> Volver a salas</a> 
                    <a class="btn btn-success text-rigth" href="./?seccion=reservacion&accion=agregarProducto"><i class="fa-solid fa-plus" aria-hidden="true"></i> Agregar pregunta</a>                        
                </div>
                <br>
                
            </header>

            <div class="card-header">
            <div class="d-flex gap-1 pull-right">          
                        <a class="btn btn-sm btn-success text-rigth" href="descargarInventario.php"><i class="fa fa-file-excel" aria-hidden="true"></i> Descargar lista</a>                        
                        <!-- <a class="btn btn-sm btn-warning add-btn" href=" "><i class="fa-solid fa-chart-pie"></i> Graficar </a> -->
                </div>
            </div>
            <div class="card-body table-responsive-md justify-content-between">
                <table class="table table-responsive-md table-hover mb-none datatable-default">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Pregunta</th>
                            <th scope="col">Orden</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Estatus</th>
                            <th scope="col" colspan="1">Acciones</th>                        
                        </tr>
                    </thead>
                    <tbody>
                         
                        
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
 
 