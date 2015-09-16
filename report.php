<?php
	// Aquí el email al que queres recibir el correo
	$receptor = "francisco.garcia.brenes@gmail.com";
include('message.php'); {
    $mensaje = preg_replace('/\n/','<br>',htmlspecialchars(urldecode($_POST['mensaje'])));
	$nombre = urldecode($_POST['nombre']);
	$email = urldecode($_POST['email']);
	$asunto = urldecode($_POST['incidencia']);
	$apellidos = urldecode($_POST['apellidos']);
	$direccion = urldecode($_POST['geolocationtest']);
	$telefono = urldecode($_POST['telefono']);
}
	$mensajes_error = array(
		//'email' => 'Introduce un e-mail válido',
		//'mensaje' => 'Tienes que introducir un mensaje',
		//'nombre' => 'Introduce un nombre'
	);

	$mensaje_correcto = "
<body>
	<div data-role='page' id='mainpage'>
    <div data-role='header'>
    </div>
    <div data-role='content'>
    <p>Incidencia: $asunto</p>
    <p>Dirección: $direccion</p>
    <p>r></p>
    </div>
    </div>
</body>
</html>";

	$enviado = $_SERVER['REQUEST_METHOD'] === "POST" || isset($_GET['ajax']);
	if( $enviado ) {
		include('message.php');
	}
?><!DOCTYPE html>
<!--[if lt IE 7]>
<html class="ie6 lt-ie7 lt-ie8 lt-ie9 no-js" lang="es">
<![endif]-->
<!--[if IE 7]>
<html class="ie7 lt-ie8 lt-ie9 no-js" lang="es">
<![endif]-->
<!--[if IE 8]>
<html class="ie8 lt-ie9 no-js" lang="es">
<![endif]-->
<!--[if (gte IE 9) | !(IE)  ]><!-->
<html class="no-js" lang="es">
<!--<![endif]-->
	<head>

	<title>Incidencias</title>
	<meta name="viewport" charset="utf-8" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<style type="text/css">
	#new_direccion {		width:440px;
		margin:20px auto;
		border:2px dashed #999;
		padding:10px 30px 30px 30px;
		overflow:hidden;
		background:00afff;
}
    </style>
<script language="JavaScript" for="window" event="onload">
var docAncho=document.documentElement.scrollWidth; 
var docAlto=document.body.scrollHeight;
window.resizeTo(docAncho,docAlto);
</script>

    <link rel="stylesheet" href="themes/PP.css" />
<link rel="stylesheet" href="themes/jquery.mobile.icons.min.css" />
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile.structure-1.4.5.min.css" />
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
<script type="text/javascript" src="js/modernizr.js"></script>
</head>

		<script type="text/javascript" src="js/modernizr.js"></script>

	</head>
	<body>
		<div class="container" id="container">

			<!--
				Aquí pondremos los errores (de existir alguno) 
			-->
			<div id="error"><?php if( $enviado && $errores !== null ) {
				echo '<ul><li>' . implode('</li><li>', $errores) . '</li></ul>';
			} ?></div>

			<!--
				Definimos el método de envío (POST hace que nuestros datos no se puedan ver desde
				el navegador, que es lo más seguro), y la URL a la que enviarlo (post.php)
			-->
		<div data-role="header" data-position="inline">
			<a href="http://nngg.webcindario.com/">Atr&aacute;s</a><h1><img src="logotipo.png"  width="138" height="49"alt="Smiley face"></h1>
		</div>
	
 <div data-role="content">
<form id="formulario" name="formulario" method="POST" action="" enctype="multipart/form-data">
<div data-role="fieldcontain">
<label for="nombre">Nombre</label><span class="requerido"></span>
<input type="text" name="nombre" id="nombre" size="30" required placeholder="Nombre">
</div>
    <div data-role="fieldcontain">
<label for="nombre">Apellidos</label><span class="requerido"></span>
<input type="text" name="apellidos" id="apellidos" size="30" required placeholder="Apellidos">
</div>
<div data-role="fieldcontain">
<label for="nombre">Email</label><span class="requerido"></span>
<input type="text" name="email" id="email" size="30" required placeholder="Email">
</div>
    <div data-role="fieldcontain">
<label for="nombre">Teléfono</label><span class="requerido"></span>
<input type="text" name="telefono" id="telefono" size="30" required placeholder="Teléfono">
</div>
    <div data-role="fieldcontain">
  <legend for="incidencia">Tipo de Incidencia:</legend>
  <select name="incidencia" id="incidencia">
    <option value="Incidencia 1">Incidencia 1</option>
    <option value="Incidencia 2">Incidencia 2</option>
    <option value="Incidencia 3">Incidencia 3</option>    
  </select>
</div>
    <div data-role="fieldcontain">
   <label for="mensaje">Descripción</label>
   <textarea id="mensaje" name="mensaje" placeholder="Descripción" required></textarea>
    </div>
           <div data-role="fieldcontain">
    <label for="geolocationtest">Dirección:</label>
    <textarea name="geolocationtest" value="geolocationtest" id="geolocationtest" readonly ></textarea>
    </div>
           <div data-role="fieldcontain">
   <label for="asunto">Agregar un archivo</label><span class="requerido"></span>
   <input type="file" name="adjunto" id="adjunto" required placeholder="Imagen"></input>
    </div>
   
<div data-role="fieldcontain">
<input type="submit" name="submit" value="Enviar" />
</div>
</form>
</div>

<?php if( $enviado && $errores === null ) {
				echo $mensaje_correcto;
			} ?>
		
		
<script>

(function(){
	var content = document.getElementById("geolocationtest");

	if (navigator.geolocation)
	{
		navigator.geolocation.getCurrentPosition(function(objPosition)
		{
			var lon = objPosition.coords.longitude;
			var lat = objPosition.coords.latitude;

			var dir = "";
			var latlng = new google.maps.LatLng(lat, lon);
			geocoder = new google.maps.Geocoder();
			geocoder.geocode({"latLng": latlng}, function(results, status)
			{
				if (status == google.maps.GeocoderStatus.OK)
				{
					if (results[0])
					{
						dir = "<p><strong>Dirección: </strong>" + results[0].formatted_address + "</p>";
					}
					else
					{
						dir = "<p>No se ha podido obtener ninguna dirección en esas coordenadas.</p>";
					}
				}
				else
				{
					dir = "<p>El Servicio de Codificación Geográfica ha fallado con el siguiente error: " + status + ".</p>";
				}

				content.innerHTML = "" + results[0].formatted_address + "";
			}); 
		}, function(objPositionError)
		{
			switch (objPositionError.code)
			{
				case objPositionError.PERMISSION_DENIED:
					content.innerHTML = "No se ha permitido el acceso a la posición del usuario.";
				break;
				case objPositionError.POSITION_UNAVAILABLE:
					content.innerHTML = "No se ha podido acceder a la información de su posición.";
				break;
				case objPositionError.TIMEOUT:
					content.innerHTML = "El servicio ha tardado demasiado tiempo en responder.";
				break;
				default:
					content.innerHTML = "Error desconocido.";
			}
		}, {
			maximumAge: 75000,
			timeout: 15000
		});
	}
	else
	{
		content.innerHTML = "Su navegador no soporta la API de geolocalización.";
	}
})();
</script>
		<div id="correcto"><?php if( $enviado && $errores === null ) {
				echo $mensaje_correcto;
			} ?></div>
		</div>
		<script>
			window.ec_form_messages = {
				correcto: "<?php echo $mensaje_correcto ?>",
				error: <?php echo json_encode($mensajes_error) ?>
			}
		</script>
		<script type="text/javascript" src="js/script.js"></script>
<div style=" margin-bottom:0;" data-role="footer">
		<h4>Page F</h4>
	</div><!-- /footer -->
			
	</body>
</html>