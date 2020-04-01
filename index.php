
<?php
	
	include 'db_connection.php';
	$conn = OpenCon(); //SE ABRE CONEXIÓN PHP HACIA LA BASE DE DATOS
			
	if(isset($_POST["btnValidar"])){ //HAGO REFERENCIA AL BOTÓN VALIDAR

		$user = $_POST['usuario']; 
		$clave = $_POST['clave'];
		
		//$user = 1000;
		//$clave = 1;

		//$sql = "SELECT Nombre_Completo FROM usuarios WHERE ID_Usuario = " . $user ; //QUERY APRA CONEXION A LA BASE DE DATOS
		$sql = "SELECT Nombre_Completo, Rol FROM usuarios WHERE ID_Usuario = " . $user . " AND Clave = '" . $clave . "'"; //QUERY PARA CONEXION A LA BASE DE DATOS, VALIDO QUE EL ID Y AL CONTRASEÑA SEAN IGUALES A LOS REGISTRADOS EN LA BASE DE DATOS

		$estudiante = $conn->query($sql);

		if(! mysqli_num_rows($estudiante)){
			echo "Se presentó un error al validar su información";
		}else{
			while($row = mysqli_fetch_array($estudiante)) {
				session_start(); //SE INICIAN LAS SESIONES PARA INICIAR A GAURDAR A NIVEL DE PHP

				$_SESSION["NombreSesion"] = $row['Nombre_Completo'];
				$_SESSION["Rol"] = $row['Rol'];
			}
			//printf($_SESSION); //me permite ver las n conexiones

			header('Location: //localhost:80/ProyectoAWCS/Principal.php');

			//echo $_SESSION["NombreSesion"] . " -- " . $_SESSION["Rol"];

		}
		//session_destroy(); //caundo utilizamos un boton de salir

	}
	CloseCon($conn); //CIERRA CONEXIÓN A BASE DE DATOS
?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>U. Fid&eacute;litas 2020</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.css">

  <script>

  </script>
</head>
<body>
	<form action="" method="post">
		<div>
		  <div>
		  	<br/>
		  	<h1 align="center">HOTEL BOUTIQUE ALMA MATER</h1>

		    <section class="content">
			    <div class="container-fluid">
			        <br/>
					
					<div class="card card-info card-outline" id="seccion2">
			            <div class="card-header">
			            	<h1 class="card-title">Inicio de Sesión | Personal Hotel Boutique Alma Mater</h1>	
			            </div>
						
						<div class="card-body">								
							<div class="row">
								  
								<div class="col-3">
									
								</div>
									  
								<div class="col-2">
									Usuario
									<input type="text" name="usuario" class="form-control" id="usuario">
								</div>
									  
								<div class="col-2">
									Clave
									<input type="password" name="clave" class="form-control" id="clave" autocomplete="off">
								</div>
									  
								<div class="col-2">
									 <br>
									 <input class="btn btn-info form-control" type="submit" id="btnValidar" name="btnValidar" value="Login"></input>
								</div>
								
								<div class="col-3">
								</div>
							  					
							</div>
						</div>
					
					</div>
					
						
				</div>
		    </section>
			
		</div>
		 
		</div>

		<script src="plugins/jquery/jquery.min.js"></script>
		<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
		<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
		<script src="dist/js/adminlte.js"></script>
		<script src="dist/js/demo.js"></script>
		<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
		<script src="plugins/chart.js/Chart.min.js"></script>
		<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
		<script src="plugins/toastr/toastr.min.js"></script>
		<script src="plugins/toastr/toastr.min.js"></script>
		<script src="plugins/datatables/jquery.dataTables.js"></script>
		<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

		<script>

		</script>
	</form>
</body>
</html>
