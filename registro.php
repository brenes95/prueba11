<? 
	
//Recibimos los parametros enviados mediante POST por el Formular
//Configuracion de la conexion a base de datos
  $bd_host = "mysql.webcindario.com"; 
  $bd_usuario = "nngg"; 
  $bd_password = "caballo12"; 
  $bd_base = "nngg"; 
 
$con = mysql_connect($bd_host, $bd_usuario, $bd_password); 
mysql_select_db($bd_base, $con); 
 
//variables POST
  $nom=$_POST['nom'];
  $apellidos=$_POST['apellidos'];
  $tlf=$_POST['tlf'];
  $email=$_POST['email'];
  $descripcion=$_POST['descripcion'];
  $incidencia=$_POST['incidencia'];
  $dir=$_POST['geolocationtest'];
  //$Imagen = "http://jtaurinajerez.com/App/img/" . $source_name;
  
 //- 
  
	
 
//registra los datos del empleados
  $sql="INSERT INTO incidencias (nom, apellidos, tlf, email, descripcion, incidencia, dir) VALUES ('$nom', '$apellidos', '$tlf', '$email', '$descripcion', '$incidencia', '$dir')";
mysql_query($sql,$con) or die('Error. '.mysql_error());

	
	
	upload();{
}
function upload(){
$ftp_server = "ftp.webcindario.com";
$ftp_user_name = "nngg";
$ftp_user_pass = "caballo12";
$destination_file = "./img/";
$source_file = $_FILES['userfile']['tmp_name'];
$source_name = $_FILES['userfile']['name'];


$conn_id = ftp_connect($ftp_server);
ftp_pasv($conn_id, true);

$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

if ((!$conn_id) || (!$login_result)) { 
echo "";
echo ""; 
exit; 
} else {
echo "";
}

$upload = ftp_put($conn_id, $destination_file . $_FILES['userfile']['name'], $source_file, FTP_BINARY);

if (!$upload) { 
echo "";
} else {
echo "";
} }
			
?>

<!DOCTYPE html> 
<html>
<head>
	<title>Page Title</title>
	<meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="http://code.jquery.com/mobile/git/jquery.mobile-git.min.js"></script>
</head>

<body>
	<div data-role="page" id="mainpage">
    <div data-role="header">
    </h1> Incidencia reportada:</h1>
    </div>
    <div data-role="content">
    <p>Incidencia: <? echo $incidencia;?></p>
    <p>Dirección: <? echo $dir;?></p>
    <p>r></p>
    </div>
    </div>
</body>
</html>