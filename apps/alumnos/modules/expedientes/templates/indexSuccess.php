<h1>Historial de expedientes</h1>
<script>
$(document).ready(function(){    
	$('#btnFilter').click(function() {
	    var filtroS = $('#filtroSede').val();
	    var filtroF = $('#filtroFac').val();

	    $('tr td.item').each(function() {
	        $(this).parent().hide();
	    });	
	    
	    if ((filtroS=="todos") && (filtroF=="todos")) {
		    $('tr').show();
	    } else if ((filtroS!="todos") && (filtroF=="todos")){
	    	$('tr td.'+filtroS).each(function() {
	        	$(this).parent().show();
	    	});		
	    } else if ((filtroS=="todos") && (filtroF!="todos")){
	    	$('tr td.'+filtroF).each(function() {
	        	$(this).parent().show();
	    	});		    
	    } else {
	    	var arrayS = [];
	    	var arrayF = [];
	    	
	    	$('tr td.'+filtroS).each(function() {
	    		arrayS.push($(this).attr("id"));
	    	});	
	    		
	    	$('tr td.'+filtroF).each(function() {
	    		arrayF.push($(this).attr("id"));
	        	//$(this).parent().show();
	    	});
	    	
			var arrayIn = $.map(arrayS,function(a){return $.inArray(a, arrayF) < 0 ? null : a;});
			
			$('tr td.item').each(function() {
				var Id = $(this).attr("id");

			    if(jQuery.inArray(Id, arrayIn) > -1) {
			    	$(this).parent().show();
				}
			});	
	    }	
	});		
});
</script>
<table cellspacing="0" class="stats" width="100%">
  <thead>
  <tr>
    <td colspan="7"> Filtrar por: 
    <select id="filtroSede">
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
    <select id="filtroFac">
    	<option value="todos">Todos</option>
		<option value="fce">Fac. de Cs. Económicas</option>
		<option value="fau">Fac. de Arquitectura y Urbanismo</option>
		<option value="fca">Fac. de Cs. Agrarias</option>
		<option value="fcjs">Fac. de Cs. Jurídicas y Sociales</option>
		<option value="fccye">Fac. de Cs. de la Comunicación y de la Educación</option>
		<option value="fcm">Fac. de Cs. Médicas</option>						
	</select> 	
	<button id='btnFilter'>Filtrar</button></td>
  </tr>     
    <tr>
      <td class="hed" align="center">Id</td>
      <td class="hed" align="center">Alumno</td>
      <td class="hed" align="center">Nro. de Documento</td>
      <td class="hed" align="center">Fecha Solicitud</td>
      <td class="hed" align="center">Sede</td>
      <td class="hed" align="center">Título</td>
      <td class="hed" align="center">Acciones</td>
    </tr>
  </thead>
  <tbody>
  	<?php if (count($expedientess) > 0) { ?>    
    <?php foreach ($expedientess as $expediente) { ?>
    <tr > 
      <td align="center"><?php echo $expediente->getIdexpediente() ?></td>
      <td><?php echo $expediente->getAlumnos()->getPersonas().' ('.$expediente->getIdalumno().')' ?></td>
      <td align="center" class="item" id="<?php echo $expediente->getIdexpediente() ?>"><?php echo $expediente->getAlumnos()->getPersonas()->getTiposDocumentos()." ".$expediente->getAlumnos()->getPersonas()->getNrodoc() ?></td>
      <td align="center" >
      	<?php 
		$arr = explode('-', $expediente->getFechaSolicitud());
		$fecha = $arr[2]."-".$arr[1]."-".$arr[0];
		echo $fecha; 
		?>
	  </td>
      <td align="center" class="<?php echo strtolower($expediente->getSedes()->getAbreviacion()); ?>" id="<?php echo $expediente->getIdexpediente() ?>"><?php echo $expediente->getSedes()->getAbreviacion() ?></td>
      <td align="center" class="<?php echo strtolower(str_replace('.','',$expediente->getAlumnos()->getPlanesEstudios()->getCarreras()->getFacultades()->getNombreabrev())) ?>" id="<?php echo $expediente->getIdexpediente() ?>"><?php echo $expediente->getTitulos()->getNombre() ?></td>
      <td align="center">
      	<input type="button" value="Ver" onclick="location.href='<?php echo url_for('expedientes/ver?idexpediente='.$expediente->getIdexpediente().'&credencial=general') ?>'">
	  </td>      
    </tr>
    <?php } ?>
	<?php } else { ?>
		<tr>
	      <td colspan="6" align="center">No existen expedientes.</td>
		</tr>	
	<?php } ?>      
  </tbody>
</table>