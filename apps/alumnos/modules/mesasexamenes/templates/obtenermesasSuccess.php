<script>
$(document).ready(function(){
	$('.hora').timepicker();
	$('.fecha').datepicker({
		showOn: "button",
		buttonImage: "<?php echo $sf_request->getRelativeUrlRoot();?>/images/calendar.gif",
		buttonImageOnly: true,
		dateFormat: 'dd-mm-yy',
		dayNames: ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
		monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
		nextText: 'Siguiente',
		prevText: 'Anterior'
	});

	$(".botonVer").click(function(){   
      	var caracteristicas = "height=700,width=800,scrollTo,resizable=1,scrollbars=1,location=0";
		var Id = $(this).attr("id");	
      	var destino = "<?php echo url_for('mesasexamenes/ver?idmesaexamen='); ?>"+Id;
      	nueva=window.open(destino, 'Popup', caracteristicas);

		return false;
	}); 
		
	$(".botonCerrarCompleta").click(function(){   
		var elemento = $(this);
		var Id = elemento.attr("id");	
    	// Controla y cierra la mesa de examen 
    	$.post("<?php echo url_for('mesasexamenes/cerrarmesa'); ?>",
    		{ idmesaexamen: Id, tipo: 1, hora: $('#hora'+Id).val(), libro: $('#libro'+Id).val(), folio: $('#folio'+Id).val(), fecha: $('#fecha'+Id).val() },
    	    function(data){
        	   	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('mesasexamenes/obtenermesas?idplanestudio='.$idplanestudio); ?>");	    	 	
        	}
		);		
		return false;
	});   
	
	$(".botonCerrarVacia").click(function(){   
		var elemento = $(this);
		var Id = elemento.attr("id");			
    	// Controla y cierra la mesa de examen
    	$.post("<?php echo url_for('mesasexamenes/cerrarmesa'); ?>",
    		{ idmesaexamen: Id, tipo: 2 },
    	    function(data){
        	   	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('mesasexamenes/obtenermesas?idplanestudio='.$idplanestudio); ?>");
        	}
		);		
		return false;
	}); 
	  
	$(".botonEliminarVacia").click(function(){   
		var elemento = $(this);
		var Id = elemento.attr("id");			
    	// Controla y cierra la mesa de examen
    	$.post("<?php echo url_for('mesasexamenes/eliminarmesa'); ?>",
    		{ idmesaexamen: Id },
    	    function(data){
        	   	alert(data);
				// obtener la lista de estudios previos de la persona
				$(location).attr('href',"<?php echo url_for('mesasexamenes/obtenermesas?idplanestudio='.$idplanestudio); ?>");       	    	
       	    }
		);		
		return false;
	}); 	 	 	
});
</script>
<h1>Cerrar Mesas de Examenes</h1>
<br>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
	<tr>
		<td colspan="2" class="hed">Mesas de Examenes Completas:</td>
	</tr>
	<tr>
		<td colspan="2">
			<table cellspacing="0" class="stats" width="100%">
				<thead>
					<tr>
						<td class="hed" align="center" width="5%">Id</td>
						<td class="hed" align="center">Materia</td>
						<td class="hed" align="center" width="14%">Fecha</td>
						<td class="hed" align="center" width="8%">Hora</td>	      
						<td class="hed" align="center" width="10%">Libro</td>
						<td class="hed" align="center" width="5%">Folio</td>	      	      
						<td class="hed" align="center">Total</td>
						<td class="hed" align="center">Condición</td>
						<td class="hed" align="center" width="15%">Acciones</td>
					</tr>
				</thead>
				<tbody>
				<?php if (count($mesasexamenes)>0) {?>		
                                        <?php $i=0; ?>  
					<?php foreach ($mesasexamenes as $mesa): ?>	
						<tr class="fila_<?php echo $i%2 ; ?>">    	
							<td align="center"><?php echo $mesa->idmesaexamen ?></td>
							<td><?php echo $mesa->getCatedras()->getMateriasPlanes() ?></td>
							<td>
								<?php 
								$arr = explode('-', $mesa->fecha);
								$fecha = $arr[2]."-".$arr[1]."-".$arr[0]; 
								?>
								<input size="9" type="text" class="fecha" id="fecha<?php echo $mesa->idmesaexamen; ?>" value="<?php echo $fecha; ?>" />
							</td>
							<td align="center">
								<input size="6" type="text" class="hora" id="hora<?php echo $mesa->idmesaexamen; ?>" value="<?php echo $mesa->hora; ?>" />		 
							</td>
							<td align="center">
								<select id="libro<?php echo $mesa->idmesaexamen; ?>">
								<?php foreach ($libros as $libro){ ?>
									<?php if ($mesa->getIdcondicion()==5 and $libro->getDescripcion()=="Equivalencia") { ?>
									<option value="<?php echo $libro->getIdlibroacta(); ?>" <?php if ($mesa->idlibroacta==$libro->getIdlibroacta()){ echo "SELECTED";} ?>><?php echo $libro->getDescripcion(); ?></option>
									<?php } ?>
									<?php if ($mesa->getIdcondicion()!=5 and $libro->getDescripcion()!="Equivalencia") { ?>
									<option value="<?php echo $libro->getIdlibroacta(); ?>" <?php if ($mesa->idlibroacta==$libro->getIdlibroacta()){ echo "SELECTED";} ?>><?php echo $libro->getDescripcion(); ?></option>
									<?php } ?>
								<?php } ?>
								</select>
							</td>
							<td align="center"><input type="text" id="folio<?php echo $mesa->idmesaexamen; ?>" maxlength="6" size="6" value="<?php echo $mesa->folio; ?>" /></td>
							<td align="center"><?php echo $mesa->cantidad; ?></td>
							<td align="center"><?php echo $mesa->getCondicionesMesas(); ?></td>
							<td align="center">
								<form id="formCerrarCompleta">	
									<?php echo button_to('Ver', 'mesasexamenes/verinscriptos?idmesaexamen='.$mesa->idmesaexamen, array('popup' => array('popupWindow', 'width=400,height=400,left=320,top=0,scrollbars=yes'))) ?>
									<input class="botonCerrarCompleta" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Cerrar">
									<?php echo button_to('Imprimir', 'impresiones/imprimiractavolante?idmesaexamen='.$mesa->idmesaexamen, array('popup' => array('popupWindow', 'width=400,height=400,left=320,top=0,scrollbars=yes'))) ?>
								</form> 		      		
							</td>
						</tr>
                                        <?php $i++; ?>
					<?php endforeach; ?>
				<?php } else { ?>
					<tr>
						<td colspan="9" align="center">No existen mesas de examenes.</td>
					</tr>		    
				<?php } ?>		    
				</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2" class="hed">Mesas de Examenes Vacias:</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
			<table cellspacing="0" class="stats" width="100%">
				<thead>
					<tr>
						<td class="hed" align="center" width="5%">Id</td>
						<td class="hed" align="center">Materia</td>
						<td class="hed" align="center" width="17%">Fecha</td>
						<td class="hed" align="center" width="5%">Condición</td>
						<td class="hed" align="center" width="18%">Acciones</td>
					</tr>
				</thead>
				<tbody>
				<?php if (count($mesasexamenesvacias)>0) { ?>
					<?php foreach ($mesasexamenesvacias as $mesa): ?>
						<tr>
							<td align="center"><?php echo $mesa->idmesaexamen; ?></td>
							<td><?php echo $mesa->getCatedras()->getMateriasPlanes(); ?></td>
							<td align="center">
							<?php 
							$arr = explode('-', $mesa->fecha);
							$fecha = $arr[2]."-".$arr[1]."-".$arr[0]; 
							?>							
							<?php echo $fecha." - ".$mesa->hora; ?></td>
							<td align="center"><?php echo $mesa->getCondicionesMesas(); ?></td>
							<td align="center">
								<form action="" id="formCerrarVacia" >
									<input class="botonCerrarVacia" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Cerrar">
									<input class="botonEliminarVacia" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Eliminar">
								</form>	
							</td>
						</tr>    
					<?php endforeach; ?>
				<?php } else { ?>
					<tr>
						<td colspan="5" align="center">No existen mesas de examenes vacias.</td>
					</tr>		    
				<?php } ?>		    
				</tbody>
			</table>
		</td>
	</tr>  
</table>
</div>	
	<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('mesasexamenes/cerrar') ?>'"></p>
<br>
