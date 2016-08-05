<form action="<?php echo url_for('egresados/agregarcarrera') ?>" method="post">
<input type="hidden" name="idpersona" value="<?php echo $personas->getIdPersona(); ?>">
<div align="center">
<br><h2> AGREGAR CARRERA ASOCIADA A LA SIGUIENTE PERSONA</h2></br>
<?php echo "<b>Persona:</b> ".$personas->getApellido().", ".$personas->getNombre(); ?>	

<br><br>

<table cellspacing="0" class="stats" width="100%">
    <tr><td>
      <SELECT name="planestudioid" id="planestudioid"> 
		<?php
		if (count($carreras) > 0){
			//el bucle para cargar las opciones
			echo "<option value='0' selected='selected' >----SELECCIONAR----</option>";
			foreach ($carreras as $carrera){
				echo "<option value=".$carrera['idplanestudio'].">".$carrera['nombrecarrera']." - ".$carrera['nombreplan']."</option>";
			}
		}
?> 
</SELECT>	
</td></tr>
<tr><td><br></td></tr>
<tr><td><input type="submit" value="Agregar Carrera" title="Agregar Carrera" id="agregarcarrera"></td></tr>
</table>


<br>
</div>
</form>