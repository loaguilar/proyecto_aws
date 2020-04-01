<?php
  session_start();
  include 'db_connection.php';
  $conn = OpenCon();
      
  $habitaciones = 'SELECT ID_Habitacion, NombreHabitacion FROM habitaciones';
  $listaHabitaciones = $conn -> query($habitaciones);

  $cedulas = 'SELECT ID_Cedula, NombreCompleto FROM clientes';
  $listaCedulas = $conn -> query($cedulas);

  CloseCon($conn);
  
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
          session_destroy();
        ?>
        <a href="//localhost:80/ProyectoAWCS/index.php" class="nav-link">Salir</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <b><a href="#" class="nav-link">
          <?php
           echo "Bienvenido, " . $_SESSION["NombreSesion"] ;
          ?>
        </a>
      </b>
      </li>
    </ul>
  </nav>
  
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link" style="border-bottom:0px!important">
      <img src="dist/img/Logo.png" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Gran Casa CR</span>
    </a>
	
	 <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <?php if($_SESSION["Rol"] == 1) { ?>

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

                  <div class="col-6">
                    <p style="text-align: left;">Cédula Cliente</p>
                    <select class="form-control" id="tipoCedula" size=1>
                      <?php
                        echo "<option value='0'>Seleccione</option>";
                        while($row1 = mysqli_fetch_array($listaCedulas)) 
                          {
                            echo "<option value=" .$row1['ID_Cedula'] . ">" . $row1['NombreCompleto'] . "</option>";
                          }
                      ?>
                    </select>
                  </div>

                  <div class="col-6">
                    <p style="text-align: left;">Habitación</p>
                    <select class="form-control" id="tipoHabitacion" size=1>
                      <?php
                        echo "<option value='0'>Seleccione</option>";
                        while($row1 = mysqli_fetch_array($listaHabitaciones)) 
                          {
                            echo "<option value=" .$row1['ID_Habitacion'] . ">" . $row1['NombreHabitacion'] . "</option>";
                          }
                      ?>
                    </select>
                  </div>

                </div>

                <div class="row" style="margin-bottom: 4%;">

                  <div class="col-6">
                    <p style="text-align: left;">Fecha de Entrada</p>
                    <input type="date" class="form-control" style="text-align: center;">
                  </div>

                  <div class="col-6">
                    <p style="text-align: left;">Fecha de Salida</p>
                    <input type="date" class="form-control" style="text-align: center;">
                  </div>

                </div>

                <div class="row">

                  <div class="col-12">
                    <input class="btn btn-success form-control" type="submit" id="btnValidar" name="btnValidar" value="Reservar"></input>
                  </div>

        </div>

      </div>
	  </div>
    </section>

   
  </div>
  
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
