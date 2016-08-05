<script> 
$(document).ready(function(){

	$(".botonModificarFecha").click(function(){   
		var Id = $(this).attr("id");	
    	// Modificar la fecha de una mesa de examen
    	$(location).attr('href',"<?php echo url_for('mesasexamenes/modificarfechaexamen?idmesaexamen='); ?>"+Id);	    	
		return false;
	});
		
	$(".botonPublicar").click(function(){   
		var Id = $(this).attr("id");	
    	// Publica la mesa de examen
    	$.post("<?php echo url_for('mesasexamenes/publicarmesa'); ?>",
    		{ idmesaexamen: Id },
    	    function(data){
        	   	alert(data);
        	   	$('#formBuscar').submit(); 
        	}
		);		
		return false;
	});  

	$(".botonDespublicar").click(function(){   
		var Id = $(this).attr("id");	
    	// Despublica la mesa de examen
    	$.post("<?php echo url_for('mesasexamenes/despublicarmesa'); ?>",
    		{ idmesaexamen: Id },
    	    function(data){
        	   	alert(data);
        	   	$('#formBuscar').submit(); 
        	}
		);		
		return false;
	});  	
		
	$(".botonAnular").click(function(){   
		var Id = $(this).attr("id");	
    	// Controla y anula la mesa de examen
    	$.post("<?php echo url_for('mesasexamenes/anularacta'); ?>",
    		{ idmesaexamen: Id },
    	    function(data){
        	   	alert(data);
        	   	$('#formBuscar').submit(); 
    		}
		);		
		return false;
	});   

	$(".botonEliminar").click(function(){   
		var Id = $(this).attr("id");	
    	// Controla y anula la mesa de examen
    	$.post("<?php echo url_for('mesasexamenes/eliminarmesa'); ?>",
    		{ idmesaexamen: Id },
    	    function(data){
        	   	alert(data);
        	   	$('#formBuscar').submit(); 
    		}
		);		
		return false;
	});   
		  
	$(".botonReabrir").click(function(){   
		var Id = $(this).attr("id");	
    	// Controla y reabre la mesa de examen
    	$.post("<?php echo url_for('mesasexamenes/reabriracta'); ?>",
    		{ idmesaexamen: Id },
    	    function(data){
        	   	alert(data);
        	   	$('#formBuscar').submit(); 
    		}
		);		
		return false;
	});

	$(".botonReabrirMesa").click(function(){   
		var Id = $(this).attr("id");	
    	// Controla y reabre la mesa de examen
    	$.post("<?php echo url_for('mesasexamenes/reabrirmesa'); ?>",
    		{ idmesaexamen: Id },
    	    function(data){
        	   	alert(data);
        	   	$('#formBuscar').submit(); 
    		}
		);		
		return false;
	}); 	 	 	 	

	$(".botonIngresarNotas").click(function(){   
		var Id = $(this).attr("id");	
    	// Controla y edita la mesa de examen
    	$(location).attr('href',"<?php echo url_for('mesasexamenes/ingresarnotas?idmesaexamen='); ?>"+Id);	    	
		return false;
	});
	 	
	$(".botonCerrar").click(function(){   
		var Id = $(this).attr("id");	
    	// Controla y cierra la mesa de examen
    	$.post("<?php echo url_for('mesasexamenes/cerraracta'); ?>",
    		{ idmesaexamen: Id },
    	   	function(data){
    			var obj = jQuery.parseJSON(data);
     			alert(obj.mensaje);     		
            	$('#formBuscar').submit();       	
    		}
		);		
		return false;
	});	
});
</script>
<h1>Gestionar Mesas de Examenes</h1> 
<br>
<table cellspacing="0" class="stats" width="100%">
<tr>
<td><b>Estado:</b> <?php echo $estado->getDescripcion() ?></td>
</tr>
<?php if ($idestado == 4) {?>
<tr>
<td>
<form action="<?php echo url_for('mesasexamenes/index'); ?>" method="post" >
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
          <input type="hidden" value="<?php echo $idplanestudio; ?>" name="idplanestudio" />
          <input type="hidden" value="<?php echo $idestado; ?>" name="idestado" />
          <input type="hidden" value="<?php echo $idsede; ?>" name="idsede" />
          <input type="hidden" value="<?php echo $ordencampo; ?>" name="ordencampo" />
          <input type="hidden" value="<?php echo $ordenmetodo; ?>" name="ordenmetodo" />
          <input type="submit" value="Buscar" id="botonBuscar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td width="10%"><b>Libro:</b></td>
        <td>
	        <select id="idlibroacta" name="idlibroacta">
	        <?php foreach ($librosactas as $libro) { ?>
	        		<option value="<?php echo $libro->getIdlibroacta() ?>" <?php echo (($idlibroacta == $libro->getIdlibroacta()) ? "selected" : ""); ?> ><?php echo $libro->getDescripcion() ?></option>
	        <?php } ?>
	        </select>
        </td>
      </tr>               
      <tr>
        <td><b>Folio:</b></td>
        <td>
          <input type="text" size="3" value="<?php echo $folio; ?>" name="folio" id="folio">
        </td>
      </tr>        
    </tbody>
  </table>
</form>
</td>
</tr>
<?php } ?>
<tr>
<td>
<form action="<?php echo url_for('mesasexamenes/index'); ?>" id="formBuscar" >
<input type="hidden" value="<?php echo $idplanestudio; ?>" name="idplanestudio" />
<input type="hidden" value="<?php echo $idestado; ?>" name="idestado" />
<input type="hidden" value="<?php echo $idsede; ?>" name="idsede" />
<input type="hidden" value="<?php echo $ordencampo; ?>" name="ordencampo" />
<input type="hidden" value="<?php echo $ordenmetodo; ?>" name="ordenmetodo" />
</form>
	<table cellspacing="0" class="stats" width="100%">
	  <thead>
	    <tr>
	      <td class="hed" align="center" width="2%">Id</td>
	      <td class="hed" align="center" width="10%">Llamado</td>
	      <td class="hed" align="center" width="14%">Fecha</td>
	      <td class="hed" align="center">Materia</td>
		  <td class="hed" align="center" width="2%">Libro</td>
	      <td class="hed" align="center" width="2%">Folio</td>
	      <td class="hed" align="center" width="2%">Condición</td>
	      <td class="hed" align="center" width="<?php echo ((($idestado == 1) or ($idestado == 2) or ($idestado == 3) or ($idestado == 4)) ? '28%': '20%') ?>">Acciones</td>
	    </tr>
	  </thead>
	  <tbody>
	  	<?php if (count($pager->getResults()) > 0) { ?>
            <?php $i=0; ?>
	    <?php foreach ($pager->getResults() as $mesa): ?>	  
			<tr class="fila_<?php echo $i%2 ; ?>">
				<td align="center"><?php echo link_to($mesa->idmesaexamen, 'mesasexamenes/verinscriptos?idmesaexamen='.$mesa->idmesaexamen, array('popup' => array('popupWindow', 'width=400,height=400,left=320,top=0,scrollbars=yes'))) ?></td>
				<td align="center"><?php if($mesa->getIdllamado()) echo $mesa->getLlamadosTurno()->getDescripcion() ?></td>
				<td align="center">
					<?php 
					$arr = explode('-', $mesa->fecha);
					$fecha = $arr[2]."-".$arr[1]."-".$arr[0]; 
					?>			
	    			<?php echo $fecha." - ".$mesa->hora; ?>
	    		</td>
				<td><?php echo $mesa->getCatedras()->getMateriasPlanes()->getMaterias()->getNombre(); ?></td>
				<td align="center"><?php echo $mesa->getLibrosActas() ?></td>
				<td align="center"><?php echo $mesa->folio ?></td>
				<td align="center"><?php echo $mesa->getCondicionesMesas() ?></td>
				<td align="center">
			      	<form action="" id="formGestionar" >
			      	<?php switch ($mesa->idestadomesaexamen) {
						case 1: ?>
							<?php if (($mesa->folio == "") or ($mesa->idlibroacta == "")) { ?>
							<input class="botonPublicar" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Publicar">
							<input class="botonModificarFecha" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Modificar fecha">
							<?php } ?>
							<?php break;
						case 2: ?> 
				      		<input class="botonDespublicar" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Despublicar">
							<?php if (($mesa->folio == "") or ($mesa->idlibroacta == "")) { ?>
							<input class="botonModificarFecha" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Modificar fecha">
							<?php } ?>						      		
        					<?php break;		
						case 3:	?> 
				      		<input class="botonAnular" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Anular">
				      		<input class="botonEliminar" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Eliminar">
				      		<input class="botonReabrirMesa" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Reabrir"><br>
				      		<input class="botonIngresarNotas" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Ingresar">					
        					<?php break;						
						case 4: ?> 
        					<input class="botonAnular" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Anular">
			      			<input class="botonEliminar" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Eliminar"><br>
			      			<input class="botonIngresarNotas" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Ingresar">
			      			
			      			<input class="botonReabrir" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Reabrir">
							<?php echo button_to('Imprimir', 'impresiones/imprimiractavolante?idmesaexamen='.$mesa->idmesaexamen, array('popup' => array('popupWindow', 'width=400,height=400,left=320,top=0,scrollbars=yes'))) ?>
        					<?php break;	
						case 5: ?> 
							<input class="botonEliminar" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Eliminar">
							<?php if ($sf_user->getGuardUser()->getIsSuperAdmin()) { ?>
			      			<input class="botonReabrir" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Reabrir">
							<?php } ?>
        					<?php break;	
						case 6: ?> 
							<?php if ($sf_user->getGuardUser()->getIsSuperAdmin()) { ?>
			      			<input class="botonReabrir" id="<?php echo $mesa->idmesaexamen; ?>" type="submit" value="Reabrir">
							<?php } ?>
        					<?php break;	
			      	} ?>
					</form>					
				</td>
			</tr>
                        <?php $i++; ?>
			<?php endforeach; ?>
		<?php } else {?>
			<tr>
				<td colspan="8" align="center">No existen mesas de examenes.</td>
			</tr>
		<?php } ?>	    
	  </tbody>
	  <tfoot>
	  	<tr>
	  		<td colspan="8" class="hed">
				<?php if ($pager->haveToPaginate())  { ?>
					<?php if ($acta) { ?>
						<div id="navv" align="center">
						<?php echo link_to('<<', 'mesasexamenes/index?page='.$pager->getFirstPage().'&idplanestudio='.$idplanestudio.'&idestado='.$idestado.'&idsede='.$idsede.'&ordencampo='.$ordencampo.'&ordenmetodo='.$ordenmetodo.'&idlibroacta='.$idlibroacta.'&folio='.$folio,'class="pager"') ?>
						<?php echo link_to('<', 'mesasexamenes/index?page='.$pager->getPreviousPage().'&idplanestudio='.$idplanestudio.'&idestado='.$idestado.'&idsede='.$idsede.'&ordencampo='.$ordencampo.'&ordenmetodo='.$ordenmetodo.'&idlibroacta='.$idlibroacta.'&folio='.$folio,'class="pager"' ) ?>
						<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
						<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'mesasexamenes/index?page='.$page.'&idplanestudio='.$idplanestudio.'&idestado='.$idestado.'&idsede='.$idsede.'&ordencampo='.$ordencampo.'&ordenmetodo='.$ordenmetodo.'&idlibroacta='.$idlibroacta.'&folio='.$folio,'class="pager"') ;?>
						<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
						<?php endforeach ?>
						<?php echo link_to('>', 'mesasexamenes/index?page='.$pager->getNextPage().'&idplanestudio='.$idplanestudio.'&idestado='.$idestado.'&idsede='.$idsede.'&ordencampo='.$ordencampo.'&ordenmetodo='.$ordenmetodo.'&idlibroacta='.$idlibroacta.'&folio='.$folio,'class="pager"') ?>
						<?php echo link_to('>>', 'mesasexamenes/index?page='.$pager->getLastPage().'&idplanestudio='.$idplanestudio.'&idestado='.$idestado.'&idsede='.$idsede.'&ordencampo='.$ordencampo.'&ordenmetodo='.$ordenmetodo.'&idlibroacta='.$idlibroacta.'&folio='.$folio,'class="pager"') ?>
						</div>
					<?php } else { ?>
						<div id="navv" align="center">
						<?php echo link_to('<<', 'mesasexamenes/index?page='.$pager->getFirstPage().'&idplanestudio='.$idplanestudio.'&idestado='.$idestado.'&idsede='.$idsede.'&ordencampo='.$ordencampo.'&ordenmetodo='.$ordenmetodo,'class="pager"') ?>
						<?php echo link_to('<', 'mesasexamenes/index?page='.$pager->getPreviousPage().'&idplanestudio='.$idplanestudio.'&idestado='.$idestado.'&idsede='.$idsede.'&ordencampo='.$ordencampo.'&ordenmetodo='.$ordenmetodo,'class="pager"' ) ?>
						<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
						<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'mesasexamenes/index?page='.$page.'&idplanestudio='.$idplanestudio.'&idestado='.$idestado.'&idsede='.$idsede.'&ordencampo='.$ordencampo.'&ordenmetodo='.$ordenmetodo,'class="pager"') ;?>
						<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
						<?php endforeach ?>
						<?php echo link_to('>', 'mesasexamenes/index?page='.$pager->getNextPage().'&idplanestudio='.$idplanestudio.'&idestado='.$idestado.'&idsede='.$idsede.'&ordencampo='.$ordencampo.'&ordenmetodo='.$ordenmetodo,'class="pager"') ?>
						<?php echo link_to('>>', 'mesasexamenes/index?page='.$pager->getLastPage().'&idplanestudio='.$idplanestudio.'&idestado='.$idestado.'&idsede='.$idsede.'&ordencampo='.$ordencampo.'&ordenmetodo='.$ordenmetodo,'class="pager"') ?>
						</div>					
					<?php } ?>
				<?php } ?>  		
	  		</td>
	  	</tr>
	  </tfoot>	  
	</table>
</td>
</tr>
</table>
	<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('mesasexamenes/buscar') ?>'"></p>
<br>
