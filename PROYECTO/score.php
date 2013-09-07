<!DOCTYPE HTML>
<html lang = "es">
  <head>
    <title>Score</title>
    <meta charset = "UTF-8" />
    <style type = "text/css">
    table, td, th {
      border: 1px solid black;
      font-family:Comic Sans MS;
      border: 15px solid #C0C0C0; border-style:groove; background-color: #FFFFFF;
    }
    </style>
  </head>
  
  <body background = "fondo.jpg">
  <div style="border: 15px solid #FFFF00; border-style:dashed;">
	  <marquee>
	  <img src="nave2.jpg"></img>
	  <b>
	  <FONT face="Comic Sans MS" size="36" color="#FFFF00"> LISTADO DE JUGADORES *****
	  </FONT>
	  </b>
	  <img src="nave2.jpg"></img>
	  </marquee>
	  </div>
    <div style="width:100px; margin:0 auto; padding: 100px;">
	<?php
	error_reporting(0);
	$nombre = $_POST['variable2'];
	$mysqli = new mysqli("localhost", "webuser", "webuser", "juego");
	if ($mysqli === false) {
		die ("ERROR: No se estableció la conexión. " . mysqli_connect_error());
	}

	$sql = "SELECT Nombre,Punteo FROM usuario ORDER BY usuario.Punteo DESC";
	if ($result = $mysqli ->query($sql)) {
		echo "<table>\n";
		echo "\t<tr>\n";
		echo "\t\t<th> "."Jugador"." </th>\n";
		echo "\t\t<th> "."Score"." </th>\n";
		echo "\t</tr>\n";
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_array()) {
				echo "\t<tr>\n";
				echo "\t\t<td> ".$row['Nombre']." </td>\n"; 
				echo "\t\t<td> ".$row['Punteo']." </td>\n";
				echo "\t</tr>\n";
			}
			$result->close();
		} else {
			echo '<font color="yellow">TABLA VACIA<font>';
		}
		
		echo "</table>\n";
		
		} else {
			echo "ERROR: No fue posible ejecutar $sql. " . $mysqli->error;
	}
	
	$mysqli->close();
	?>
</div>
<script>
	function onEnviar(){
		document.getElementById["variable2"]="<?php $_POST['variable2']?>";
		}
</script>
      
      <form action="buscar.php" id="formulario" method="post" name="formulario" onsubmit="onEnviar()">
      <input Id="variable2" name="variable2" type="hidden" value="<?php echo $nombre?>"/>
      <p align="center"><input id="enviar" type="submit" value="BUSCAR" style = 'font-size:20px; font-family:Comic Sans MS;width:200px; height:50px' /></p>
      </form>


     <form action="juego.php" id="formulario" method="post" name="formulario" onsubmit="onEnviar()">
      <input Id="variable2" name="variable2" type="hidden" value="<?php echo $nombre?>"/>
      <p align="center"><input id="enviar" type="submit" value="REGRESAR" style = 'font-size:20px; font-family:Comic Sans MS;width:200px; height:50px' /></p>
      </form>
      
 </body>
 <footer>
 <div style="border: 15px solid #FFFF00; border-style:dashed;">
	  <marquee>
	  <img src="nave2.jpg"></img>
	  <b>
	  <FONT face="Comic Sans MS" size="36" color="#FFFF00"> LISTADO DE JUGADORES *****
	  </FONT>
	  </b>
	  <img src="nave2.jpg"></img>
	  </marquee>
	  </div>
	 
</footer>
</html>