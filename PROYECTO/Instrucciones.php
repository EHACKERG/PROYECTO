<!DOCTYPE html>
<html>
<head>
<title>Instrucciones</title>
</head>
<body background = "fondo.jpg">
<div style="border: 15px solid #FFFF00; border-style:dashed;">
<marquee>
<b>
<FONT face="Comic Sans MS" size="36" color="#FFFF00">
Preciona la tecla D para mover a la derecha!!!!!
</FONT>
</b>
</marquee>
</div>
<div style="border: 15px solid #FFFF00; border-style:dashed;">
<marquee>
<b>
<FONT face="Comic Sans MS" size="36" color="#FFFF00">
Preciona la tecla A para mover a la izquierda!!!!!
</FONT>
</b>
</marquee>
</div>
<div style="border: 15px solid #FFFF00; border-style:dashed;">
<marquee>
<b>
<FONT face="Comic Sans MS" size="36" color="#FFFF00">
Preciona la tecla L para disparar!!!!!
</FONT>
</b>
</marquee>
</div>
<div style="border: 15px solid #FFFF00; border-style:dashed;">
<marquee>
<b>
<FONT face="Comic Sans MS" size="36" color="#FFFF00">
Preciona El boton Empezar para comenzar el juego
</FONT>
</b>
</marquee>
</div>
<?php 
$nombre = $_POST['variable2']?>

<form action="juego.php" id="formulario" method="post" name="formulario" onsubmit="onEnviar()">
      <input Id="variable2" name="variable2" type="hidden" value="<?php echo $nombre?>"/>
      <p align="center"><input id="enviar" type="submit" value="REGRESAR" style = 'font-size:20px; font-family:Comic Sans MS;width:200px; height:50px' /></p>
      </form>
</body>
</html>