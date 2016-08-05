<br>
<table width="100%" class="tabla_buscador">
	<tr align='center'>
	<td >
	<h1>Analítico Parcial</h1>
	</td>
	</tr>
</table>
<br>
		<?php
		$date = new DateTime( $persona['fechanac']);
		$fnac=$date->format('d-m-Y');
		?>
<p><strong>Alumno:</strong> <?php echo $persona['apellido'].", ".$persona['nombre'] ?><br /></p>
<p><strong>Fecha Ingreso:</strong> <?php echo $fnac ?><br /></p>
<p><strong>Nacionalidad:</strong> <?php echo $persona['idnacionalidad']==1?"Argentino":"Uruguayo" ?></p>
<br />

<table width="100%" class="stats" cellspacing="0">
<thead>
    <tr>
      <td class="hed">Carrera</td>
      <td class="hed">Plan</td>
      <td class="hed">Titulo</td>
      <td class="hed">Acción</td>
    </tr>
</thead>
<?php foreach($planes as $plan){ ?>
   	<tr >
      <td><?php echo $plan['nombre'] ?></td>
      <td><?php echo $plan['plan'] ?></td>
      <td><?php echo $plan['titulo'] ?></td>
      <td>
		<form name="form_<?php echo $plan['idcarrera']; ?>" method="post" action="<?php echo url_for('analitico/getanalitico' ) ?>">  
			<input type="hidden" name="idc" value="<?php echo $plan['idcarrera']; ?>">
			<input type="hidden" name="ida" value="<?php echo $plan['idalumno']; ?>">
			<input type="submit" value="Visualizar" title="Visualizar Mesas de Exámenes" id="Visualizar" class="form_consulta_enviar" name="Visualizar">
		</form>
	  </td>
    </tr> 
  <?php } ?>
</table>
<br />
  
<?php if ($analitico){ ?> 
  <table class="alumat" width="100%">
  <thead>
    <tr>
      <td class="hed" width="50%">Nombre</td>
      <td class="hed">Nota</td>
      <td class="hed">Libro</td>
      <td class="hed">Folio</td>
      <td class="hed">Fecha</td>
      <td class="hed">Condicion</td>

    </tr>
  </thead>
  <?php 
		

	

     $arrYears = array (1 => "Primer año", 2 => "Segundo año", 3 => "Tercer año", 4 => "Cuarto año",  5 => "Quinto año", 6 => "Sexto año");
     $anioactual = 0; $promedio = 0; $cantidad = 0; $canti = 0;
     foreach($analitico as $analit){ 
       /*  if ($anioactual != $analit['curso']){ 
           $anioactual = $analit['curso']; ?>
           <tr bgcolor="#666666"><td colspan="7" align="center"><b><?php echo $arrYears[$anioactual] ?></b></td></tr>
    <?php }*/

	$date = new DateTime($analit['fecha']);
	$fecha=$date->format('d-m-Y');
?>    	 
   	  <tr class="fila_3">
      <td><?php echo $analit['nombre'] ?></td>
      <td><?php echo ($analit['nota']==null or $analit['nota']=="")?$analit['calificacion']:$analit['nota'] ?></td>
      <td><?php echo $analit['libro'] ?></td>
      <td><?php echo $analit['folio'] ?></td>
      <td><?php echo $fecha ?></td>
      <td><?php echo $analit['condicion'] ?></td>

      </tr>
  <?php 
         if ($analit['calif']!="" || $analit['calif']!=0){
             $promedio+=$analit['calif']; 
             $canti++;
         }    
         $cantidad++;
     } ?>
 <tr><td  colspan="7"><strong>Promedio:</strong> <?php echo number_format($promedio/$canti, 2) ?></td></tr>
 <tr><td  colspan="7"><strong>Cant. Materias:</strong> <?php echo $cantidad ?></td></tr>
<tr class="fila_importante"><td  colspan="7"><strong>Los datos mostrados en esta pantalla pueden estar expresados en forma parcial sujetas a resoluciones que pueden ivalidarlas o habilitarlas en caso de que el sector administrativo lo especifique. La validéz de los certificados analíticos estará dado desde las secretarías con firma y sello de la Facultad que lo emite. Lo expresado en este módulo es una referencia para el alumno con el mero fin de saber su situación presente.</strong> </td></tr>
 </table>
<br />
 <?php } ?> 
