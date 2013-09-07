<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Usuario</title>
</head>
<body background = "fondo.jpg">
<script>
var nombre = "";
	  nombre = prompt('Introduce Nombre','[nombre del usuario]');
	  function onEnviar(){
	       document.getElementById("variable2").value=nombre;
	    }
</script>
<div style="width:100px; margin:0 auto; padding: 100px;">
<form action="juego.php" id="formulario" method="post" name="formulario" onsubmit="onEnviar()">
    <input id="variable2" name="variable2" type="hidden" />
    <input id="enviar" type="submit" value="Jugar" style = 'font-size:20px; font-family:Comic Sans MS;width:200px; height:50px'/>
</form>
</div>
<div style="border: 15px solid #FFFF00; border-style:dashed;">
	  <marquee>
	  <img src="nave2.jpg"></img>
	  <b>
	  <FONT face="Comic Sans MS" size="36" color="#FFFF00"> Preciona Jugar Para Empezar *****
	  </FONT>
	  </b>
	  <img src="nave2.jpg"></img>
	  </marquee>
	  </div>
</body>
</html>
