<?php 
    $usuario_id = $_SESSION[AMBIENTE]['usuario']['id'];
    if(isset($_GET['fecha_evento'])){
        $fechaConsulta = $_GET['fecha_evento']; 
        $getSalas = $S->getSalas(); 
    }
    $fechaActual = date('Y-m-d');
    $fechaMinCalendario = date("Y-m-d", strtotime($fechaActual."+ 2 days"));
 ?> 

                     <header class="page-header">
						<h2>Solicitud de reservación de sala o auditorio</h2>
                        <?php echo $fechaMinCalendario; ?>
					</header>
    <?php 
    // var_dump($rol);
    // ./controller/reservar.php?accion=consultarFecha
  
    ?>
        <!-- start: page --> 
            <div class="row">
                <div class="col">
                    <section class="card">
                        
                   
                        <header class="card-header ">
                            <h2 class="card-title t3">
                               Fecha del evento
                            </h2>
                            <form action="./" method="GET" class="row">
                                <input type="hidden" name="seccion" value="solicitud">
                                <input type="hidden" name="accion" value="consultar">
                                    <div class="form-group d-inline col-6">                                    
                                        <input type="date" <?php if (!empty($fechaConsulta)): ?> value="<?php echo $fechaConsulta ?>" <?php  endif ?>" min="<?php echo $fechaMinCalendario ?>" class="form-control bg-color-grey text-4 h-auto py-2" data-msg-required="YYYY-MM-DD" placeholder="YYYY-MM-DD" name="fecha_evento" id="fecha_evento" required>                                    
                                            <!-- <p>Las reservaciones son con mínimo 2 días de anticipación.</p> -->
                                    </div>
                                    <div class="btn-group col-6 d-flex justify-content-end " role="group">
                                        <button type="submit" class="btn btn-primary">Consultar disponibilidad</button>
                                   
                                        <a href="./?seccion=solicitud&accion=listar" class="pr-2 btn btn-secondary mr-1" > 
                                            <i class="fa-solid fa-arrow-left"></i> Volver a reservaciones
                                        </a>
                                    </div>
                            </form>
                             
                        </header>

                        <?php 
                              if(!empty($fechaConsulta)){
                                $diaMes = explode ("-", $fechaConsulta);  
                                $formatoMes = new DateTime($fechaConsulta);
                                $arrayMeses=array(
                                    "Ene.","Feb.","Mar.","Abr.","May.","Jun.","Jul.","Agos.","Sep.","Oct.","Nov.","Dec."
                                ); 
                                $mes = $formatoMes->format('m'); 
                                $mesText=$arrayMeses[$mes-1]; 

                                $horarios = $S->getHorario();

                                // var_dump($horarios);

                                //pruebas list horario
                                // $inicio = '09:00:00';
                                // $fin = '18:00:00';
                                // $intervaloHorario = 15;
                                // $tiempoIntervalo = 'm';

                                // // $listHorarios = array('hora_inicio', 'hora_final');
                                // // $h_inicio = date("H:i:s", strtotime($inicio."+ 15 minutes"));
                                // // echo $h_inicio;

                                // // $list_hora_inicio []='hora_inicio'=>$inicio;
                                // $list_hora_inicio = array( 'hora_inicio' => $inicio);

                                // var_dump($list_hora_inicio);
                                // // // for ($i = 1; $i <= 10; $i++) {
                                // // //     echo $i;
                                // // // }
                                // $h_inicio = $inicio;
                                // for($i = 1;  ; $i++){
                                     
                                //     $h_inicio = date("H:i:s", strtotime($h_inicio."+ 15 minutes"));
                                //     if($h_inicio > $fin){
                                //         break;
                                //     }
                                //     // array_push($list_hora_inicio['hora_inicio'], $h_inicio);
                                // // echo $h_inicio . '<br>';
                                // // $list_hora_inicio[] = 'hora_inicio' => $h_inicio;
                                //     // $list_hora_inicio['hora_inicio'] = $h_inicio;
                                //     $list_hora_inicio[] = array('hora_inicio' => $h_inicio);
                                // }
                           


                                // // $list_hora_inicio = array();
                                // // $num_elements = 5;
                                // // $tipo = "Inicio";
                                // // // Utilizar un bucle for para agregar elementos al array
                                // // for ($i = 0; $i < $num_elements; $i++) {
                                // //     // Agregar un nuevo elemento al array con las claves 'hora_inicio' y 'tipo'
                                // //     $list_hora_inicio[] = array('hora_inicio' => $inicio, 'tipo' => $tipo);
                                // // }
                                // // print_r($list_hora_inicio);
                        ?>

                        <div class="card-body">
                            <div class="row">
                            <?php                      

                           

                                foreach($getSalas as $n => $sala){
                                    // echo $sala->id;

                                    $salasXfecha = $S->salaHorarioXEstatus($sala->id, $_GET['fecha_evento']);
                                    $horariosInicio = $S->getHorarioInicio();
                                    $horariosFinal = $S->getHorarioFinal();
                                    $hi = array();
                                    $hf = array();
                                    foreach ($horariosInicio as $hstart){
                                        array_push($hi, $hstart->hora_inicio);
                                    }
                                    foreach ($horariosFinal as $hend){
                                        array_push($hf, $hend->hora_fin);
                                    }
                                    $horarioIncioSala = array();
                                    $horarioFinalSala = array(); 


                                    // if($salasXfecha){ 
                                    //     foreach($salasXfecha as $salaXfecha){ 
                                    //         $horarioXsala = $S->getHorarioXsala($salaXfecha->hora_inicio, $salaXfecha->hora_final);
                                    //         foreach($horarioXsala as $hora_fin_sala){ 
                                    //             array_push($horarioFinalSala, $hora_fin_sala->hora_fin);                       
                                    //         }
                                              
                                    //     }
                                    //     var_dump($horarioFinalSala);
                                    //     $newHorarioXsalaF = array_diff($hf, $horarioFinalSala);
                                    //         foreach($newHorarioXsalaF as $h_finsala){
                                    //                 echo $h_finsala;
                                    //             }
                                    // }


                                    // var_dump($salasXfecha);
                                    // print_r($salasXfecha);
                                // if($salasXfecha){ 
                                //     $horariosInicio = $S->getHorarioInicio();
                                //     $horarioIncioSala = array();

                                //     $hsI = array();
                                //     foreach ($horariosInicio as $hi){
                                //         array_push($hsI, $hi->hora_inicio);
                                //     }
                                //     foreach($salasXfecha as $salaXfecha){ 
                                //         $horarioXsala = $S->getHorarioXsala($salaXfecha->hora_inicio, $salaXfecha->hora_final);
                                //         foreach($horarioXsala as $hora_inicio_sala){ 
                                //         //   echo '<br>' . $hora_inicio_sala->hora_inicio;
                                //           array_push($horarioIncioSala, $hora_inicio_sala->hora_inicio);
                                //         } 
                                      
                                //         // $horaInicio = array_unique($horarioIncioSala);
                                //         // var_dump($horaInicio);
                                       
                                //         // array_push($horariosInicio, $horarioIncioSala);
                                //         // var_dump($horariosInicio);

                                //     }
                                //     echo '<br> <br> hi ';
                                //     var_dump( $horariosInicio);
                                //     echo '<br> <br> i ';

                                //     var_dump($horarioIncioSala);
                                //     // array_push( $horarioIncioSala, $horariosInicio);

                                //     echo '<br> <br> new in ';

                                //     $newHorarioXsala = array_diff($hsI, $horarioIncioSala);
                                //     var_dump($newHorarioXsala);
                                   


                                // } 



                                
                                

                                
                                    // if($salasXfecha){ 
                                    //     foreach($salasXfecha as $salaXfecha){ 
                                    //         echo '<br><br>ini: '.$salaXfecha->hora_inicio .' fin: '. $salaXfecha->hora_final;
                                    //         $horarioXsala = $S->getHorarioXsala($salaXfecha->hora_inicio, $salaXfecha->hora_final);
                                    //         foreach($horarioXsala as $hora_inicio_sala){ 
                                    //             echo '<br>' .$hora_inicio_sala->hora_inicio . ' fin: ' .$hora_inicio_sala->hora_fin;
                                    //         }
                                    //     }
                                    // }else{
                                    //     echo '<br><br>todo libre';
                                    //     // foreach($horarios as $horario){ 
                                    //     //     echo '<br>' .$horario->hora_inicio . ' fin: ' .$horario->hora_fin;

                                    //     // }
                                    // }
                                    
                                //     $salasXfecha = $S->salaHorarioXEstatus($sala->id, $_GET['fecha_evento']);
                                // // var_dump($salasXfecha);
                                //     foreach($salasXfecha as $salaXfecha){
                                //         echo '<br><br>';
                                //         echo $salaXfecha->id;
                                         
                                //         // var $tiempoEspera= 15;
                                //         $horarioXsala = $S->getHorarioXsala($salaXfecha->hora_inicio, $salaXfecha->hora_final);
                                //         var_dump($horarioXsala);

                                //         foreach($horarioXsala as $hora){
                                          
                                //         // $fechaMinCalendario = date("Y-m-d", strtotime($fechaActual."+ 2 days"));
                                //             // $salaXfecha->hora_inicio
                                //            echo $hora->hora_fin;
                                //         }
                                //     }
                                //     echo '<br><br>';
                                    // var_dump($horarioXsala);
                                    // var_dump($sala->id); 
                                    $disponibilidad= true;
                                    if($salasXfecha){ 
                                        $horariosDisponibles = array();
                                        foreach($salasXfecha as $salaXfecha){ 
                                            $horarioXsala = $S->getHorarioXsala($salaXfecha->hora_inicio, $salaXfecha->hora_final);
                                            foreach($horarioXsala as $hora_inicio_sala){ 
                                                array_push($horariosDisponibles, $hora_inicio_sala->hora_inicio);                       
                                            }
                                              
                                        }
                                        $horariosXsalas = array_diff($hi, $horariosDisponibles);
                                        if(!empty($horariosXsalas)){
                                            $disponibilidad= true;
                                        }else{
                                            $disponibilidad= false;
                                        }
                                    }
                                    if($disponibilidad){ 
                                    
                            ?>
                            
                            <div class="col-md-6 col-sm-6 col-lg-4 mb-5 pb-0 ">
                                <!-- <img src="img/Sala_1.jpg" class="img-fluid w-100" alt="">  -->
                                <img src="img/salas/Sala_<?php echo $sala->id ?>.jpg" class="img-fluid w-100" alt="Sala_<?php echo $sala->id ?>"> 
                                
                                <div class="px-3  shadow-sm">
                                    
                                            <div class="d-flex flex-wrap mb-4">
                                                <div class="post-date text-1 mb-md-0 mb-3 me-0  pe-2 border-right">
                                                    <span class="day border-radius-0 text-dark bg-gradient"><?php echo $diaMes [2]; ?></span>
                                                    <span class="month border-radius-0 text-4 bg-success"> <?php echo $mesText; ?></span>
                                                </div>
                                                <div class="px-2 mb-md-0 mb-3  mx-1  border-right">
                                                    <div class="d-flex flex-row align-items-center h-100">
                                                        <div class="p-0">
                                                            <p class="mb-0 text-3 text-uppercase p-relative top-3 fw-normal">Espacio</p>
                                                            <h4 class="mb-0 text-color-primary text-5 fw-bold"><?php echo $sala->nombre ?> </h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ps-md-0 mb-3 mb-md-0 ms-2 ">
                                                    <div class="d-flex flex-row align-items-center h-100">
                                                        <div class="p-0">
                                                            <p class="mb-0 text-3 text-uppercase p-relative top-3 fw-normal">Capacidad</p>
                                                            <h4 class="mb-0 text-color-primary text-5 fw-bold"><?php echo $sala->capacidad ?></h4>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>

                                        <div class="custom-read-more-style-1">
                                            <form action="./controller/solicitud.php?accion=rsv_sala" method="post">                                            
                                                <div class="my-3">
                                                        <p class="text-4 text-uppercase text-color-primary fw-bold">Horarios disponibles</p>
                                                       
                                                        <div class="input-daterange input-group" data-plugin-datepicker>
                                                            <span class="input-group-text">
                                                                <i class="far fa-clock"></i>
                                                            </span>
                                                            
                                                            <select class="form-control" name="hora_inicio" data-plugin-multiselect data-plugin-options='{ "maxHeight": 200 }' id="hora_inicio" required data-msg-required="Elige la hora de inicio">
                                                                <option value="" selected>Inicio</option>

                                                                    <?php 
                                                                    // $salasXfecha = $S->salaHorarioXEstatus($sala->id, $_GET['fecha_evento']);
                                                                    if($salasXfecha){ 
                                                                        foreach($salasXfecha as $salaXfecha){ 
                                                                            $horarioXsala = $S->getHorarioXsala($salaXfecha->hora_inicio, $salaXfecha->hora_final);
                                                                            foreach($horarioXsala as $hora_inicio_sala){ 
                                                                                array_push($horarioIncioSala, $hora_inicio_sala->hora_inicio);                       
                                                                            }
                                                                              
                                                                        }
                                                                        $newHorarioXsala = array_diff($hi, $horarioIncioSala);
                                                                            foreach($newHorarioXsala as $h_iniciosala){
                                                                                
                                                                            

                                                                        ?>
                                                                            <option value="<?php echo $h_iniciosala ?>" ><?php echo $h_iniciosala ?></option>

                                                                        <?php
                                                                        }
                                                                    }else{
                                                                    ?>
                                                                        <?php foreach($horarios as $horario){ ?>
                                                                            <option value="<?php echo $horario->hora_inicio ?>" ><?php echo $horario->hora_inicio ?></option>
                                                                        <?php
                                                                        }
                                                                    }
                                                                        ?>
                                                            </select>
                                                               
                                                            
                                                            <span class="input-group-text border-start-0 border-end-0 rounded-0">
                                                                a
                                                            </span>
                                                            <select class="form-control" name="hora_final" data-plugin-multiselect id="hora_final" required data-msg-required="Elige la hora final">
                                                                <option value="" selected>Fin</option>
                                                                    <?php 
                                                                     if($salasXfecha){ 
                                                                        foreach($salasXfecha as $salaXfecha){ 
                                                                            $horarioXsala = $S->getHorarioXsala($salaXfecha->hora_inicio, $salaXfecha->hora_final);
                                                                            foreach($horarioXsala as $hora_fin_sala){ 
                                                                                array_push($horarioFinalSala, $hora_fin_sala->hora_fin);                       
                                                                            }
                                                                              
                                                                        } 
                                                                        $newHorarioXsalaF = array_diff($hf, $horarioFinalSala);
                                                                            foreach($newHorarioXsalaF as $h_finsala){

                                                                        ?>
                                                                            <option value="<?php echo $h_finsala ?>" ><?php echo $h_finsala?></option>

                                                                        <?php
                                                                        }
                                                                    }else{

                                                                    
                                                                    ?>

                                                                        <?php foreach($horarios as $horario){ ?>
                                                                            <option value="<?php echo $horario->hora_fin   ?>"><?php echo $horario->hora_fin?></option>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                            </select> 
                                                        </div>
                                                </div>

                                                    <input hidden type="text" name="id_sala" id="id_sala" value="<?php echo $sala->id ?>">
                                                    <input hidden type="text" name="usuario" id="usuario" value="<?php echo $usuario_id?>">
                                                    <input hidden type="text" name="fecha_reservada" id="fecha_reservada" value="<?php echo $fechaConsulta ?>">
                                                <div class="text-end card-footer p-0">
                                                    <button type="submit" class="room-suite-info-book btn btn-primary my-3" title="">Reservar</button>
                                                </div>
                                            </form>
                                        </div><!-- custom -->
                                </div> 
                            </div>
                            
                            <?php
                                 } //disponibilidad
                                
                              }
                            ?>
                        </div>    <!-- row -->
                        </div> <!-- card-body -->
                        <?php
                            }
                        ?>

                    </section>

                    
                    </div>
                </div>
					 
        <!-- end: page -->

                    