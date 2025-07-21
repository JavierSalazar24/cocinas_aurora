<!-- Contenido -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panel de Control</h1>
    </div>

    <!-- Content Row Tarjetas -->
    <div class="row">

        <!-- Tarjeta admins -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="https://cocinas-aurora.herokuapp.com/control_panel/administradores" id="links-dashboard">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Administradores</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numAd ?></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-user-tie fa-3x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Tarjeta clientes -->
        <div class="col-xl-3 col-md-6 mb-4">
                <a href="https://cocinas-aurora.herokuapp.com/control_panel/clientes" id="links-dashboard">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Clientes</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numCl ?></div>
                                </div>                
                                <div class="col-auto"><i class="fas fa-user fa-3x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
        </div>

        <!-- Tarjeta ventas -->
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="https://cocinas-aurora.herokuapp.com/control_panel/ventas" id="links-dashboard">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ventas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numVe ?></div>
                            </div>
                            <div class="col-auto"><i class="fas fa-dollar-sign fa-3x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <!-- Tarjeta mensaje -->
        <div class="col-xl-3 col-md-6 mb-4">
                <a href="https://cocinas-aurora.herokuapp.com/control_panel/mensajes" id="links-dashboard">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Mensajes</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numMe ?></div>
                                </div>
                                <div class="col-auto"><i class="fas fa-comments fa-3x text-gray-300"></i></div>
                            </div>
                        </div>
                    </div>
                </a>
        </div>

    </div>

    <!-- Segunda columna -->
    <div class="row">
        <!-- Estadisticas -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-warning">Balance</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div> 
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5"> 
            <div class="card shadow mb-4"> 
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-warning">Estadísticas</h6>                        
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Administradores
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Clientes
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Ventas
                        </span>
                    </div>
                </div> 
            </div>
        </div> 
    </div>

    <!-- Notas y tarjetas -->
    <div class="row">
        <div class="col-lg-6 mb-4">
            <!-- Notas -->
            <div class="box box-warning">
                <div class="box-header">
                    <i class="ion ion-clipboard"></i>
                    <h3 class="box-title">Notas rápidas</h3>
                </div>
                <div class="box-body">
                    <ul class="todo-list">

                        <?php 
                            foreach ($consulta_notas as $nota) {
                        ?>
                        <li class="text-black">
                            <span class="handle">
                                <i class="fa fa-ellipsis-v"></i>
                                <i class="fa fa-ellipsis-v"></i>
                            </span>
                            <?php
                            if ($nota['estatus'] == "pendiente") {
                            ?> 
                                <p class="d-none" id="p_idNota"><?php echo $nota['_id']?></p>
                                <input type="checkbox" onclick="editarEstatusNota('notasI','<?php echo $nota['_id'] ?>')">
                                <span id="s_Nota" class="text"><?php echo $nota['nota'] ?></span>
                                <small class="badge badge-warning"><i class="fa fa-clock-o"></i> 
                                    <?php echo $nota['fecha'];?>
                                </small>
                                <div class="tools d-flex pt-1 pb-0">
                                    <i class="fa fa-edit" data-toggle="modal" data-target="#EditarNotaModal<?php echo $nota['_id'] ?>"></i>
                                    <i class="fa fa-trash-o" onclick="ConfirmarEliminacion('notasI','<?php echo $nota['_id'] ?>')"></i>
                                </div>
                            <?php
                            } else {
                            ?>
                                <p class="d-none" id="p_idNota"><?php echo $nota['_id']?></p>
                                <input type="checkbox" onclick="editarEstatusNota('notasI','<?php echo $nota['_id'] ?>')" checked>
                                <span class="text text-secondary"><s id="s_Nota"> <?php echo $nota['nota'] ?></s></span>
                                <small class="badge badge-secondary"><i class="fa fa-clock-o"></i> 
                                    <?php echo $nota['fecha'];?>
                                </small>
                                <div class="tools d-flex pt-1 pb-0">
                                    <i class="fa fa-edit" data-toggle="modal" data-target="#EditarNotaModal<?php echo $nota['_id'] ?>"></i>
                                    <i class="fa fa-trash-o" onclick="ConfirmarEliminacion('notasI','<?php echo $nota['_id'] ?>')"></i>
                                </div>
                            <?php
                            }
                            ?>                                             
                        </li>

                            <!-- Modal editar nota -->
                            <form id="editar" class="needs-validation" novalidate>
                                <div class="modal fade" id="EditarNotaModal<?php echo $nota['_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success">
                                                <h5 class="modal-title text-white" id="exampleModalLabel">Editar Nota</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="mb-3">
                                                    <label for="editar_nota" class="form-label">Nota:</label>
                                                    <textarea class="form-control" name="nota" id="nota_editar" required><?php echo $nota['nota'] ?></textarea>
                                                    <div class="valid-feedback">Correcto.</div>
                                                    <div class="invalid-feedback">Por favor ingresa un nota.</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" onclick="editarNota('notasI', '<?php echo $nota['_id'] ?>')">Editar nota</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        <?php
                            }
                        ?>
                    </ul>
                </div>
                <div class="box-footer clearfix no-border">
                    <button type="button" class="btn btn-dark pull-right" data-toggle="modal" data-target="#NotaModal">
                        <i class="fa fa-plus"></i> Agregar nota
                    </button>
                </div>
            </div>                    

            <!-- Tarjetas -->
            <div class="row">
                <!-- Guisos -->
                <div class="col-lg-6 mb-4">
                    <a href="https://cocinas-aurora.herokuapp.com/control_panel/guisos" id="links-dashboard">
                        <div class="card border-left-danger shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Guisos</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numGui ?></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-drum-steelpan fa-3x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Sopas -->
                <div class="col-lg-6 mb-4">
                    <a href="https://cocinas-aurora.herokuapp.com/control_panel/sopas" id="links-dashboard">
                        <div class="card border-left-secondary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Sopas</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numSo ?></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-soup fa-3x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Guarniciones -->
                <div class="col-lg-6 mb-4">
                    <a href="https://cocinas-aurora.herokuapp.com/control_panel/guarniciones" id="links-dashboard">
                        <div class="card border-left-dark shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Guarniciones</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numGua ?></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-salad fa-3x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Antojitos -->
                <div class="col-lg-6 mb-4">
                    <a href="https://cocinas-aurora.herokuapp.com/control_panel/antojitos" id="links-dashboard">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Antojitos</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numAn ?></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-taco fa-3x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Postres -->
                <div class="col-lg-6 mb-4">
                    <a href="https://cocinas-aurora.herokuapp.com/control_panel/postres" id="links-dashboard">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Postres</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numPo ?></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-pie fa-3x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Horarios -->
                <div class="col-lg-6 mb-4">
                    <a href="https://cocinas-aurora.herokuapp.com/control_panel/horarios" id="links-dashboard">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Horarios</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $numHo ?></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-clock fa-3x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Correo -->
                <div class="col-lg-6 mb-4">
                    <a href="https://cocinas-aurora.herokuapp.com/control_panel/correo" id="links-dashboard">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Correo</div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-envelope fa-3x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Calculadora -->
                <div class="col-lg-6 mb-4">
                    <a href="https://cocinas-aurora.herokuapp.com/control_panel/calculadora" id="links-dashboard">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Calculadora</div>
                                    </div>
                                    <div class="col-auto"><i class="fad fa-calculator-alt fa-3x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- Descargar APP -->
                <div class="col-lg-6 mb-4">
                    <a href="https://cocinas-aurora.herokuapp.com/control_panel/descargar" id="links-dashboard">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Descargar app</div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-download fa-3x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-5">
            <!-- Calendario -->
            <div class="mb-5 box text-white bg-gray-100 border-none">
                <div class="box-header bg-warning text-white">
                    <i class="fa fa-calendar"></i>
                    <h3 class="box-title">Calendario</h3>
                    <div class="pull-right box-tools">
                    <button type="button" class="btn btn-success btn-sm" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-sm" data-widget="remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="box-body no-padding bg-warning">
                    <div id="calendar" style="width: 100%"></div>
                </div>
            </div>            

            <!-- Approach -->
            <div class="card shadow mb-4 mt-5 text-black">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Cocinas Aurora</h6>
                </div>
                <div class="card-body text-justify">
                    <p>
                        Aquí podras eliminar, editar o consultar todos los datos importantes de los <b><a href="https://cocinas-aurora.herokuapp.com/control_panel/clientes" class="text-warning">clientes</a></b>, <b><a href="https://cocinas-aurora.herokuapp.com/control_panel/administradores" class="text-warning">administradores</a></b>, tus alimentos como: <b><a href="https://cocinas-aurora.herokuapp.com/control_panel/guisos" class="text-warning">guisos</a></b>, <b><a href="https://cocinas-aurora.herokuapp.com/control_panel/sopas" class="text-warning">sopas</a></b>, <b><a href="https://cocinas-aurora.herokuapp.com/control_panel/guarniciones" class="text-warning">guarniciones</a></b>, <b><a href="https://cocinas-aurora.herokuapp.com/control_panel/antojitos" class="text-warning">antojitos</a></b>, <b><a href="https://cocinas-aurora.herokuapp.com/control_panel/postres" class="text-warning">postres</a></b>, o las <b><a href="https://cocinas-aurora.herokuapp.com/control_panel/ventas" class="text-warning">ventas</a></b>, así como sus <b><a href="https://cocinas-aurora.herokuapp.com/control_panel/estadisticas" class="text-warning">estadísticas</a></b> o contestar <b><a href="https://cocinas-aurora.herokuapp.com/control_panel/mensajes" class="text-warning">mensajes</a></b> de los clientes.
                    </p>
                    <p>
                        Puedes crear <b><a href="https://cocinas-aurora.herokuapp.com/control_panel/notas" class="text-warning">notas</a></b> para que otros administradores puedan saber los pendientes que hay o las cosas que se van haciendo día a día, así como mandar <b><a href="https://cocinas-aurora.herokuapp.com/control_panel/correos" class="text-warning">correos</a></b> para contestar las dudas de los clientes.
                    </p>
                    <p>
                        <b>IMPORTANTE:</b> Los administradores root pueden consultar, editar o eliminar los datos anteriormente mencionados. Los administradores estandar pueden unicamente consultar dichos datos.
                    </p>
                    <p>
                        Para diferenciar, a los administradores root se les asignó el número 1 y a los administradores estandar el número 2.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
