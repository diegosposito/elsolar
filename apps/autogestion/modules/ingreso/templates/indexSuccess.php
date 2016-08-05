<?php 
?>
<div id="column2"><br>
	<p align="center"><font size="5">Bienvenido a la <b>Universidad de Concepción del Uruguay</b>!</font></p>
	<?php if ($sf_user->isAuthenticated()){ ?>
		<blockquote>
			<p>Este sistema te permitirá verificar la información académica de la carrera que estás cursando, ver y/o modificar tu inscripción a Cursar / Rendir materias,  realizar consultas, ver Calendario Académico, Planes de Estudios y Correlatividades. Para Consultas sobre SAO Autogestión enviar el IDALUMNO Y DNI abajo mostrado, al correo electrónico sao_autogestion@ucu.edu.ar con tu consulta.</p> 
		</blockquote>	
	<?php foreach ($carreras as $carrera): 
		$this->administracion = new Administracion();
		$fechalibredeuda = $this->administracion->obtenerlibredeudaalumno($carrera['idalumno'],$nrodoc); 
		$oAlumno = Doctrine_Core::getTable('Alumnos')->findByIdalumno($carrera['idalumno']); 
		echo "<blockquote><p style='font-size:12px'>Alumno: ".$persona->getApellido().', '.$persona->getNombre().'<br>';
		echo "Id alumno: ".$carrera['idalumno'].'<br>';
		echo "Nro. documento: ".$persona->getNrodoc().'<br></p></blockquote>';
		
		sfContext::getInstance()->getUser()->setAttribute('idalumno',$carrera['idalumno']);
		sfContext::getInstance()->getUser()->setAttribute('nrodoc',$persona->getNrodoc());

		foreach($oAlumno as $alumno):
			if(($fechalibredeuda >= date('Y-m-d')) && !(is_array($fechalibredeuda))) {
				$mensajelibredeuda = "<br>";
				$class_color='';
			} else {
				$mensajelibredeuda = "<img src='/images/libredeuda.png' align='center' size='16' /><br>"; 
				$class_color='mensaje_libredeuda_2';
			}
	?>
			<table  class='<?php echo $class_color; ?>' >		
				<tr>
					<td>
						<?php echo $mensajelibredeuda; ?>
					</td>
				</tr>
			</table>
		
  	<?php if (count($noticias) > 0) {?>
			<table class="rotulonoticias">
				<tr>
					<td>
						<p align="center"><font size="4" color="#000"><b>NOTICIAS</b></font></p>
					</td>
				</tr>
			</table><br>
	<?php foreach ($noticias as $noticia): ?>
			<table class="noticias">
				<tr>
					<td bgcolor="#F4F2F3">
					    <?php if ($noticia['leer_mas']) { ?>
					    <h1>
						<a href="<?php echo url_for('noticias/ver?idnoticia='.$noticia['id']) ?>">
							<?php echo $noticia['titulo'] ?>
						</a>
						</h1><br>
					    <?php }else{?>
					    <h1><?php echo $noticia['titulo'] ?></h1><br>
					    <?php } ?>	        		
					</td>
				</tr>
				<tr>
					<td bgcolor="#F7E99F">
					    <?php echo htmlspecialchars_decode($noticia['intro']); ?>
					    <?php if ($noticia['leer_mas']) { ?>
					    <a href="<?php echo url_for('noticias/ver?idnoticia='.$noticia['id']) ?>">Leer más...</a>
					    <?php } ?>	        		
					</td>
				</tr>
			</table><br>

	        <?php endforeach; // fin de foreach noticias?> 
			 <?php };   // fin de si hay noticias?> 
	        <?php endforeach; // fin de foreach alumnos?> 
	        <?php endforeach; // fin de foreach carreras?>   

        <br />
        <?php }else{?>	
			<blockquote>
        		<p>Para poder entrar al Sistema, hacé click <a href="<?php echo url_for('@sf_guard_signin') ?>">aquí</a>.</p>
        	</blockquote>	        
		<?php } ?>
     </div>
<?php 
?>
