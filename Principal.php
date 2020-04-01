<?php
  session_start(); //SE INICIA LA SESIÓN DE ACUERDO AL USUARIO LOGEADO
  include 'db_connection.php';
  $conn = OpenCon(); //SE ABRE CONEXIÓN PHP HACIA LA BASE DE DATOS
  $conn1 = OpenCon(); //SE VUELVE ABRIR CONEXIÓN PHP HACIA LA BASE DE DATOS PARA PODER EJECTUR DOS QUERIES AL MISMO TIEMPO
      
  //SE DECLARA LA VARIABLE $habitaciones PARA CONSULTAR DATOS DE LAS HABITACIONES CON ESTADO DISPONIBLE
  $habitaciones = 'SELECT ID_Habitacion, NombreHabitacion FROM habitaciones WHERE Estado = "Disponible" ';
  $listaHabitaciones = $conn -> query($habitaciones);

  //SE DECLARA LA VARIABLE $cedulas PARA CONSULTAR DATOS DE LOS CLIENTES PARA AÑADIR LA RESERVA
  $cedulas = 'SELECT ID_Cedula, NombreCompleto FROM clientes';
  $listaCedulas = $conn -> query($cedulas);

  //CÓDIGO QUE SE EJECUTA AL PRESIONAR EL BOTÓN "Reservar"
  if(isset($_POST['btnReservar']))
  {
    //Variables donde se almacenas los datos de los campos del formulario
    $cedulaCl = $_POST['cedula'];
    $habHotel = $_POST['habitacion'];
    $in       = $_POST['entrada'];
    $out      = $_POST['salida'];

    //CONSULTA PARA INSERTAR UNA NUEVA RESERVA EN LA BASE DE DATOS
    $sql = "INSERT INTO reservasactivas (ID_Habitacion, ID_Cedula, FechaEntrada, FechaSalida)
    VALUES ('$habHotel', '$cedulaCl', '$in', '$out')";

    //CONSULTA PARA ACTUALIZAR EL ESTADO A "Ocupada" DE LA HABITACIÓN SOBRE LA CUAL SE HIZO LA RESERVA
    $sql1 = "UPDATE habitaciones SET Estado = 'Ocupada' WHERE ID_Habitacion = " . $habHotel;

    $conn-> query($sql); //SE EJECUTA EL QUERY "INSERT" CON LA PRIMER VARIABLE DE CONEXIÓN CREADA AL INICIO
    $conn1-> query($sql1); //SE EJECUTA EL QUERY "UPDATE" CON LA SEGUNDA VARIABLE DE CONEXIÓN CREADA AL INICIO

  }

  CloseCon($conn); //SE CIERRA LA CONEXIÓN A LA BASE DE DATOS
  
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Proyecto AWCS</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    
  <script>

		

  </script>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<! CÓDIGO DE LA PARTE SUPERIOR DE LA INTERFAZ, SE PRESENTA EL BOTÓN DE INICIO, EL DE SALIR Y EL DE BIENVENIDA -->
<div class="wrapper">

  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Inicio</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <?php
          session_destroy(); //SE CIERRA LA SESIÓN AL PRESIONAR BOTÓN DE "SALIR"
        ?>
        <a href="//localhost:80/ProyectoAWCS/index.php" class="nav-link">Salir</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <b><a href="#" class="nav-link">
          <?php
           //SE CONSULTA LA VARIABLE DE SESIÓN CON EL NOMBRE DE LA MISMA OBTENIDAS EN EL LOGIN.
           echo "Bienvenido, " . $_SESSION["NombreSesion"] ;
          ?>
        </a>
      </b>
      </li>
    </ul>
  </nav>
  
  <! CÓDIGO DEL MENÚ LATERAL, EN EL CUAL SE MUESTRAN LAS OPCIONES QUE PUEDE EJECUTAR CADA USUARIO DE ACUERDO A SU ROL -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link" style="border-bottom:0px!important">
      <img src="dist/img/Logo.png" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Gran Casa CR</span>
    </a>
	
	 <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


          <?php if($_SESSION["Rol"] == 1) { ?>

            <! SE VALIDA SI EL VALOR DE LA VARIABLE DE SESIÓN "ROL" ES 1, LO QUE ES IGUAL A "ADMINISTRADOR" 
            CUENTA CON MÁS OPCIONES DE MENÚ-->

           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="far fa-calendar-alt"></i>
              <p>
                Reservas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#iframe" class="nav-link">
                  <i class="fas fa-plus-circle"></i>
                  <p>Nueva Reserva</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="Principal.php" class="nav-link">
                  <i class="far fa-check-circle"></i>
                  <p>Activas</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="Principal.php" class="nav-link">
                  <i class="fas fa-history"></i>
                  <p>Histórico</p>
                </a>
              </li>             
            </ul>
          </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-bed"></i>
              <p>
                Habitaciones
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Principal.php" class="nav-link">
                  <i class="fas fa-check-double"></i>
                  <p>Disponibles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Principal.php" class="nav-link">
                  <i class="fas fa-ban"></i>
                  <p>Ocupadas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Principal.php" class="nav-link">
                  <i class="fas fa-book-open"></i>
                  <p>Registrar</p>
                </a>
              </li>             
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-users"></i>
              <p>
                Clientes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Principal.php" class="nav-link">
                  <i class="fas fa-user-cog"></i>
                  <p>Administraci&oacute;n de Clientes</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Principal.php" class="nav-link">
                  <i class="fas fa-user-clock"></i>
                  <p>Historial de Hospedajes</p>
                </a>
              </li>      
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-briefcase"></i>
              <p>
                Empleados
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Principal.php" class="nav-link">
                  <i class="fas fa-business-time"></i>
                  <p>Administraci&oacute;n de Empleados</p>
                </a>
              </li>      
            </ul>
          </li>

          <?php }?> 



          <?php if($_SESSION["Rol"] == 2) { ?>

          <! SE VALIDA SI EL VALOR DE LA VARIABLE DE SESIÓN "ROL" ES 2, LO QUE ES IGUAL A "EMPLEADO" 
          CUENTA CON MENOS OPCIONES DE MENÚ-->

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="far fa-calendar-alt"></i>
              <p>
                Reservas
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Principal.php" class="nav-link">
                  <i class="far fa-check-circle"></i>
                  <p>Activas</p>
                </a>
              </li> 
              <li class="nav-item">
                <a href="Principal.php" class="nav-link">
                  <i class="fas fa-history"></i>
                  <p>Histórico</p>
                </a>
              </li>             
            </ul>
          </li>


          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-bed"></i>
              <p>
                Habitaciones
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Principal.php" class="nav-link">
                  <i class="fas fa-check-double"></i>
                  <p>Disponibles</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Principal.php" class="nav-link">
                  <i class="fas fa-ban"></i>
                  <p>Ocupadas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Principal.php" class="nav-link">
                  <i class="fas fa-book-open"></i>
                  <p>Registrar</p>
                </a>
              </li>             
            </ul>
          </li>

          <?php }?>
          
        </ul>
      </nav>
    </div>
	
  </aside>


  <! SE CREA EL FORMULARIO QUE PERMITIRÁ REALIZAR UNA RESERVA AL COMPLETAR LOS CAMPOS Y PRESIONAR EL BOTÓN -->    
  <form action="" method="post">
  
  <div class="content-wrapper">

    <section class="content">
    <div class="container-fluid">
        <br/>
                <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Reservar Habitación</h3>
            </div>
           
        <div class="card-body">


                <div class="row" style="margin-bottom: 4%;">

                  <! SE CREA UN DROPDOWN EN DONDE SE MUESTRAN LOS NOMBRES DE LOS CLIENTES REGISTRADOS -->
                  <div class="col-6">
                    <p style="text-align: left;">Cliente</p>
                    <select class="form-control" id="tipoCedula" size=1 name="cedula">
                      <?php
                        //SE LLAMA A LA VARIABLE "$listaCedulas" CREADA AL INICIO DEL CÓDIGO
                        //SE RECORRE LA VARIABLE Y SE INSERTAN LOS DATOS EN EL DROPDOWN 
                        echo "<option value='0'>Seleccione</option>";
                        while($row1 = mysqli_fetch_array($listaCedulas)) 
                          {
                            echo "<option value=" .$row1['ID_Cedula'] . ">" . $row1['NombreCompleto'] . "</option>";
                          }
                      ?>
                    </select>
                  </div>

                  <! SE CREA UN DROPDOWN EN DONDE SE MUESTRAN LOS NOMBRES DE LAS HABITACIONES DISPONIBLES -->
                  <div class="col-6">
                    <p style="text-align: left;">Habitación</p>
                    <select class="form-control" id="tipoHabitacion" size=1 name="habitacion">
                      <?php
                        //SE LLAMA A LA VARIABLE "$listaHabitaciones" CREADA AL INICIO DEL CÓDIGO
                        //SE RECORRE LA VARIABLE Y SE INSERTAN LOS DATOS EN EL DROPDOWN 
                        echo "<option value='0'>Seleccione</option>";
                        while($row1 = mysqli_fetch_array($listaHabitaciones)) 
                          {
                            echo "<option value=" .$row1['ID_Habitacion'] . ">" . $row1['NombreHabitacion'] . "</option>";
                          }
                      ?>
                    </select>
                  </div>

                </div>

                <! SE CREAN LOS CAMPOS DE TIPO FECHA PARA LOS DATOS CORRESPONDIENTES -->
                <div class="row" style="margin-bottom: 4%;">

                  <div class="col-6">
                    <p style="text-align: left;">Fecha de Entrada</p>
                    <input type="date" class="form-control" style="text-align: center;" name="entrada">
                  </div>

                  <div class="col-6">
                    <p style="text-align: left;">Fecha de Salida</p>
                    <input type="date" class="form-control" style="text-align: center;" name="salida">
                  </div>

                </div>

                <div class="row">

                  <div class="col-12">
                    <input class="btn btn-success form-control" type="submit" id="btnReservar" name="btnReservar" value="Reservar"></input>
                  </div>

        </div>

      </div>
	  </div>
    </section>

  </div>

  </form>
  
  <footer class="main-footer">
    <strong>Proyecto AWCS &copy; 2020. </strong>
    Todos los Derechos Reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="plugins/chart.js/Chart.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/demo.js"></script>

</body>
</html>
