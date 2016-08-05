<form method="post" action="/alumnos.php/estadisticas/nixcarrera" enctype="multipart/form-data">
<script>

	$(function() {
		$( "input:submit, a, button", ".demo" ).button();
	});
	</script>


<br>
<div class="demo">
<p><b>Seleccionar año</b></p>
<br>
 <?php
		//el bucle para cargar las opciones
		echo "<select id='seleccionar' name='seleccionar' >";
		foreach ($aAnios as $anios){
			echo "<option value=".$anios.">".$anios."</option>";
		}
		echo "</select>";
 ?>
 <br /><br />
<input value="Generar .xls" type="submit">
</div>


</form>