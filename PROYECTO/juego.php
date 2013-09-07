<!DOCTYPE html>
<html>

<head>
<meta charset="ISO-8859-1">
<title>Star wARS</title>
</head>
<body background = "fondo.jpg">

<div style="border: 15px solid #FFFF00; border-style:dashed;">
<marquee>
<b>
<FONT face="Comic Sans MS" size="36" color="#FFFF00">
StarwARS============Edwin Orellana===============Henry Lopez!!!!!
</FONT>
</b>
</marquee>
</div>
<p align="center"><a href="INDEX.PHP" target="_self">
<input type="button" name="boton" value="Cambiar de Usuario" style = 'font-size:20px; font-family:Comic Sans MS;width:200px; height:50px'/>
</a></p>
 
<p align="center"><input type="button" onclick="ejecutar()" value = "EMPEZAR!!" style = 'font-size:20px; font-family:Comic Sans MS;width:200px; height:50px'></p>
 
<div style="width:800px; margin:0 auto; padding: 100px;">
<canvas id='juego' width=800 height=400 style="border: 15px solid #C0C0C0; border-style:groove; background-color: #FFFFFF;"></canvas>
</div>

<script>
var score = 0;
var nivel = 1;
var nenemigos = 3;
var fre = 2;
function onEnviar(){
	document.getElementById("variable").value=score;
}
function ejecutar(){
	var canvas = document.getElementById('juego');
	var ctx = canvas.getContext('2d');
	var fondo;
	var nave = {
		x:100,
		y:canvas.height-100,
		width:50,
		height:50,
		contador:0
	}
	var juego = {
		estado: 'iniciando'
	}

	var texto = {
		contador: -1,
		titulo: '',
		subtitulo: ''
	}
	//array para enemigos
	var enemigos = [];
	var teclado = {}
	//array para disparos
	var disparos = [];
	var disparosenemigos = [];

	//definicion de funcion loadMedia

	function cargador_de_imagenes(){
		fondo = new Image();
		fondo.src = 'tierra.jpg';
		fondo.onload = function(){
			var intervalo = window.setInterval(frameLoop,1000/55);
		}
	}
	function dibujarEnemigos(){
		for(var i in enemigos){
			var enemigo = enemigos[i];
			ctx.save();
			if(enemigo.estado == 'vivo') ctx.fillStyle = 'red';
			if(enemigo.estado == 'muerto') ctx.fillStyle = 'black';
			ctx.fillRect(enemigo.x,enemigo.y,enemigo.width,enemigo.height);
		}
	}
	function dibujarfondo(){
		ctx.drawImage(fondo,0,0);
	}
	function dibujarnave(){
		ctx.save();
		ctx.fillStyle = 'white';
		ctx.fillRect(nave.x,nave.y,nave.width,nave.height);
		ctx.restore();
	}
	function agregarEventosTeclado(){
		// telca presionanada
		agregarEvento(document,"keydown",function(e){
			teclado[e.keyCode] = true;
		});
		//tecla no presionada
		agregarEvento(document,"keyup",function(e){
			teclado[e.keyCode] = false;
		});
		function agregarEvento(elemento,nombreEvento,funcion){
			if(elemento.addEventListener){
				//navegadores diferente a internet explorer
				elemento.addEventListener(nombreEvento,funcion,false);
			}
			else if(elemento.attachEvent){
				//internet explorer
				elemento.attachEvent(nombreEvento,funcion);
			}
		}
	}
	function moverNave(){
		if(teclado[68]){
			//movimiento a la derecha
			var limite = canvas.width - nave.width;
			nave.x += 6;
			if(nave.x > limite) nave.x = limite;
			 
		}
		if(teclado[65]){
			//movimiento a la izquierda
			nave.x -= 6;
			if(nave.x<0) nave.x = 0;
		}
		if(teclado[76]){
			//disparos
			if(!teclado.fire){
				fire();
				teclado.fire = true;
			}
		}
		else teclado.fire = false;
		if(nave.estado == 'golpeado'){
			nave.contador++;
			if(nave.contador >= 20){
				nave.contador = 0;
				nave.estado = 'muerto';
				juego.estado='perdi';
				texto.titulo = 'GAME OVER XP';
				texto.subtitulo = 'presiona R para reiniciar';
				texto.contador = 0;
				nenemigos = 3;
				fre = 2;
				nivel = 1;
			}
		}
	}
	function dibujardisparosenemigos(){
		for(var i in disparosenemigos){
			var disparo = disparosenemigos[i];
			ctx.save();
			ctx.fillStyle = 'yellow';
			ctx.fillRect(disparo.x,disparo.y,disparo.width,disparo.height);
			ctx.restore();
			 
		}
	}
	function moverdisparosenemigos(){
		for(var i in disparosenemigos){
			var disparo = disparosenemigos[i];
			disparo.y += 3;
			 
		}
		disparosenemigos = disparosenemigos.filter(function(disparo){
			return disparo.y < canvas.height;
		});
	}
	function actualizaEnemigos(){
		function agregardisparosenemigos(enemigo){
			return{
				x: enemigo.x,
				y: enemigo.y,
				width: 10,
				height: 33,
				contador: 0
			}
		}
		if(juego.estado == 'iniciando'){
			for(var i = 0; i<nenemigos; i++){
				enemigos.push({
					x: 10 + (i*50),
					y: 10,
					height: 40,
					width: 40,
					estado: 'vivo',
					contador: 0
				});
			}
			juego.estado = 'jugando';
		}
		for (var i in enemigos){
			var enemigo = enemigos[i];
			if(!enemigo) continue;
			if(enemigo && enemigo.estado == 'vivo'){
				enemigo.contador++;
				enemigo.x += Math.sin(enemigo.contador * Math.PI /90 )*5;
				if(aleatorio(0,enemigos.length * 10)== fre){
					disparosenemigos.push(agregardisparosenemigos(enemigo));
				}
			}
			if(enemigo && enemigo.estado == 'golpeado'){
				enemigo.contador++;
				if(enemigo.contador >= 20){
					enemigo.estado = 'muerto';
					enemigo.contador = 0;
					score = score+40;
					score2 = score;
				}
			}
		}
		enemigos = enemigos.filter(function(enemigo){
			if(enemigo && enemigo.estado != 'muerto')return true;
			return false;
		});
	}

	function moverdisparos(){
		for(var i in disparos){
			var disparo = disparos[i];
			disparo.y -=2;
		}
		disparos = disparos.filter(function(disparo){
			return disparo.y > 0;
		});
	}
	function fire(){
		disparos.push({
			x: nave.x + 20,
			y: nave.y - 10,
			width: 10,
			height:30
		});
	}
	function dibujardisparos(){
		ctx.save();
		ctx.fillStyle = 'white';
		for(var i in disparos){
			var disparo = disparos[i];
			ctx.fillRect(disparo.x,disparo.y,disparo.width,disparo.height);
		}
		ctx.restore();
	}
	function dibujatexto(){
		if(texto.contador == -1)return;
		var alpha = texto.contador/50.0;
		if(alpha>1){
			for(var i in enemigos){
				delete enemigos[i];
			}
		}
		ctx.save();
		ctx.globalAlpha = alpha;
		if(juego.estado == 'perdi'){
			ctx.fillStyle = 'yellow';
			ctx.font = 'Bold 40pt Arial';
			ctx.fillText(texto.titulo,140,200);
			ctx.font = '14pt Arial';
			ctx.fillText(texto.subtitulo,190,250);
			ctx.fillText("score "+score.toString(),300,300);
			ctx.fillText("No olvides subir tu punteo",300,350);
		}
		if(juego.estado == 'gane'){
			ctx.fillStyle = 'yellow';
			ctx.font = 'Bold 20pt Arial';
			ctx.fillText(texto.titulo,250,200);
			ctx.font = '14pt Arial';
			ctx.fillText(texto.subtitulo+nivel.toString(),300,250);
			ctx.fillText("score "+score.toString(),300,300);
			ctx.fillText("No olvides subir tu punteo",300,350);
		}
	}
	function actualizarestadojuego(){
		if(juego.estado == 'jugando' && enemigos.length == 0){
			juego.estado = 'gane';
			texto.titulo = 'DERROTASTE A LOS ENEMIGOS';
			texto.subtitulo = 'presione R para entrar al nivel ';
			texto.contador = 0;
			nivel++;
			if(nenemigos<10){
			nenemigos++;}
			free += 2;
		}
		if(texto.contador >= 0){
			texto.contador++;
		}
		if((juego.estado == 'perdi')&&teclado[82]){
			juego.estado = 'iniciando';
			nave.estado = 'vivo';
			texto.contador = -1;
			score=0;
		}
		if((juego.estado == 'gane')&&teclado[82]){
			juego.estado = 'iniciando';
			nave.estado = 'vivo';
			texto.contador = -1;
		}

	}
	function colision(a,b){
		var colision = false;
		if(b.x + b.width >= a.x && b.x < a.x + a.width){
			if(b.y + b.height >= a.y && b.y  < a.y + a.height){
				colision = true;
	  	 
			}
		}
		if(b.x <= a.x && b.x + b.width >= a.x + a.width){
			if(b.y <= a.y && b.y + b.height >= a.y + a.height){
				colision = 'true';

			}
			 
		}
		if(a.x <= b.x && a.x + a.width >= b.x + b.width){
			if(a.y <= b.y && a.y + a.height >= b.y + b.height){
				colision = 'true';

			}
			 
		}
		return colision;
	}
	function contanto(){
		for(var i in disparos){
			var disparo = disparos[i];
			for(j in enemigos){
				var enemigo = enemigos[j];
				if(colision(disparo,enemigo)){
					enemigo.estado = 'golpeado';
					enemigo.contador = 0;

						
				}
			}
		}
		if(nave.estado == 'golpeado' || nave.estado == 'muerto')return;
		for( var i in disparosenemigos){
			var disparo = disparosenemigos[i];
			if(colision(disparo,nave)){
				nave.estado = 'golpeado';
				console.log('contacto');
			}
		}
	}
	function aleatorio(inferior,superior){
		var posibilidad = superior - inferior;
		var a = Math.random()*posibilidad;
		a = Math.floor(a);
		return parseInt(inferior) + a;
	}
	function frameLoop(){
		actualizarestadojuego();
		moverNave();
		actualizaEnemigos();
		moverdisparos();
		moverdisparosenemigos();
		dibujarfondo();
		contanto();
		dibujarEnemigos();
		dibujardisparosenemigos();
		dibujardisparos();
		dibujatexto();
		dibujarnave();
	}

	//ejecutar loadMedia
	cargador_de_imagenes();
	agregarEventosTeclado();}
	</script>


	<?php
	error_reporting(0);
	$host = "localhost";
	$user = "webuser";
	$pw	= "webuser";
	$db	= "juego";
	$nombre = $_POST['variable2'];
	$con = mysql_connect($host,$user,$pw) or die("problemas al conectar");
	mysql_select_db($db,$con)or die("problemas al conectar la base de datos");
	mysql_query("INSERT INTO Usuario (Nombre,Punteo) VALUES ('$_POST[variable2]','$_POST[variable]')",$con);
	$query = mysql_query("SELECT * FROM usuario WHERE Nombre = '$_POST[variable2]'",$con);
	while ($reg=mysql_fetch_array($query)) {
		$score = $reg['Punteo'];
	}
	$dato = $_POST['variable'];
	if ($score<$dato) {
		mysql_query("UPDATE  usuario SET  Punteo ='$_POST[variable]' WHERE Nombre = '$_POST[variable2]'");;
	}
	?>
	
	  <form action="Instrucciones.php" id="formulario" method="post" name="formulario" onsubmit="onEnviar()">
      <input Id="variable2" name="variable2" type="hidden" value="<?php echo $nombre?>"/>
      <p align="center"><input id="enviar" type="submit" value="Instrucciones" style = 'font-size:20px; font-family:Comic Sans MS;width:200px; height:50px' /></p>
      </form>
 
 	  <form action="juego.php" id="formulario" method="post" name="formulario" onsubmit="onEnviar()">
      <input id="variable" name="variable" type="hidden" />
      <input Id="variable2" name="variable2" type="hidden" value="<?php echo $nombre?>"/>
      <p align="center"><input id="enviar" type="submit" value="SUBIR PUNTEO" style = 'font-size:20px; font-family:Comic Sans MS;width:200px; height:50px' /></p>
      </form>

      <form action="score.php" id="formulario" method="post" name="formulario" onsubmit="onEnviar()">
      <input Id="variable2" name="variable2" type="hidden" value="<?php echo $nombre?>"/>
      <p align="center"><input id="enviar" type="submit" value="VER PUNTEOS" style = 'font-size:20px; font-family:Comic Sans MS;width:200px; height:50px' /></p>
      </form>


</body>
<footer>
<div style="border: 15px solid #FFFF00; border-style:dashed;">
	  <marquee>
	  <img src="nave2.jpg"></img>
	  <b>
	  <FONT face="Comic Sans MS" size="36" color="#FFFF00">--------PAGINAS WEB---------
	  </FONT>
	  </b>
	  </marquee>
	  </div>
</footer>
</html>	
//Compring:
//Agradecimientos a CodigoFacilito Uriel Hernandez por el Script del Juego de Naves
