<h1>Expedientes</h1>
<script>
$(document).ready(function(){    
	$('#btnFilter').click(function() {
	    var filtro = $('#filtro').val();

	    $('tr').show();
	    $('tr td.item').each(function() {
	        $(this).parent().hide();
	    });	

	    switch(filtro) {
	    case "sc":
		    $('tr td.sc').each(function() {
		        $(this).parent().show();
		    });		  
			break;
	    case "crg":
		    $('tr td.crg').each(function() {
		        $(this).parent().show();
		    });		
	        break;
	    case "eav":
		    $('tr td.eav').each(function() {
		        $(this).parent().show();
		    });		
	        break;	  
	    case "crr":
		    $('tr td.crr').each(function() {
		        $(this).parent().show();
		    });		
	        break;	  
	    case "crsf":
		    $('tr td.crsf').each(function() {
		        $(this).parent().show();
		    });		
	        break;
	    case "crrp":
		    $('tr td.crrp').each(function() {
		        $(this).parent().show();
		    });		
	        break;
	    case "eag":
		    $('tr td.eag').each(function() {
		        $(this).parent().show();
		    });		
	        break;	    
	    case "eavt":
		    $('tr td.eavt').each(function() {
		        $(this).parent().show();
		    });		
	        break;	
	    case "easj":
		    $('tr td.easj').each(function() {
		        $(this).parent().show();
		    });		
	        break;	
	    case "each":
		    $('tr td.each').each(function() {
		        $(this).parent().show();
		    });		
	        break;		        	        
	    case "todos":
		    $('tr td.item').each(function() {
		        $(this).parent().show();
		    });		
	        break;		                    
	} 	    	 	  
	});
});
</script>

<div class='container'>
<table cellspacing="0" class="stats" width="100%">
  <thead>
  <tr>
    <td colspan="7"> Filtrar por: 
    <select id="filtro">
    	<option value="todos">Todos</option>
  		<option value="sc">Sede Central</option>
  		<option value="crg">Centro Regional Gualeguaychu</option>
  		<option value="crr">Centro Regional Rosario</option>
  		<option value="crsf">Centro Regional Santa Fé</option>
		<option value="crrp">Centro Regional Paraná</option>
		<option value="eav">Extensión Áulica Villaguay</option>
		<option value="eag">Extensión Áulica Gualeguay</option>
		<option value="eavt">Extensión Áulica Venado Tuerto</option>
		<option value="easj">Extensión Áulica San José</option>
		<option value="each">Extensión Áulica Chajarí</option>
	</select> 
	<button id='btnFilter'>Filtrar</button></td>
  </tr>   
    <tr>
		<td class="hed" align="center">Id</td>
		<td class="hed" align="center">Alumno</td>
		<td class="hed" align="center">Nro. de Documento</td>
		<td class="hed" align="center">Fecha Solicitud</td>
		<td class="hed" align="center">Sede</td>
		<td class="hed" align="center">Plan de Estudios</td>
		<td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($expedientess) > 0) { ?>    
    <?php foreach ($expedientess as $expediente) { ?>
    <tr>
      <td align="center"><?php echo $expediente->getIdexpediente() ?></td>
      <td><?php echo $expediente->getAlumnos()->getPersonas() ?></td>
      <td align="center" class="item"><?php echo $expediente->getAlumnos()->getPersonas()->getTiposDocumentos()." ".$expediente->getAlumnos()->getPersonas()->getNrodoc() ?></td>
      <td align="center" class="<?php echo strtolower($expediente->getSedes()->getAbreviacion()); ?>">
		<?php 
		$arr = explode('-', $expediente->getFechaSolicitud());
		$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
		echo $fecha; 
		?>	
      </td>
      <td align="center"><?php echo $expediente->getSedes()->getAbreviacion() ?></td>
      <td align="center"><?php echo $expediente->getAlumnos()->getPlanesEstudios() ?></td>
      <td align="center">
      	<input type="button" value="Ver" onclick="location.href='<?php echo url_for('expedientes/ver?idexpediente='.$expediente->getIdexpediente().'&credencial=titulos') ?>'">
		<input type="button" value="Editar" onclick="location.href='<?php echo url_for('expedientes/registrartitulo?idexpediente='.$expediente->getIdexpediente()) ?>'">
   		<input type="button" value="Derivar" onclick="location.href='<?php echo url_for('derivaciones/derivar?idexpediente='.$expediente->getIdexpediente().'&credencial=titulos') ?>'">
	  </td>      
    </tr>
    <?php } ?>
	<?php } else { ?>
		<tr>
	      <td colspan="7" align="center">No existen expedientes.</td>
		</tr>	
	<?php } ?>      
  </tbody>
</table>
</div>
<br>