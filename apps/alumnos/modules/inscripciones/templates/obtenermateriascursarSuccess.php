<script>
$(document).ready(function(){ 
    // add multiple select / deselect functionality
    $("#selectall").click(function() {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox and viceversa
    $(".case").click(function() {
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
    });

	$(".botonInscribir").click(function(){
		var elemento = $(this);
		var controlarhorario = <?php echo $controlarhorarios; ?>;
		var Id = elemento.attr("id");
		var Idcomision = $("#idcomision_"+Id).val();
		if (controlarhorario == 1) {
	    	// Controla e inscribe el alumno a la materia
	    	$.post("<?php echo url_for('inscripciones/controlarhorarios'); ?>",
	    	    { idcomision: Idcomision, idalumno: <?php echo $alumno->getIdalumno(); ?> },
	    	    function(data){
					var obj = jQuery.parseJSON(data);
					if(obj.inscripta) {
		       	   		var r = confirm("Existen las siguientes superposiciones horarias entre las comisiones:\n\n"+obj.noinscripta+"\n"+obj.inscripta+"\nDesea continuar de todas formas?");
					    if (r == true) {
				   	     	$.post("<?php echo url_for('inscripciones/inscribirmateria'); ?>",
				   	     	    { idcomision: Idcomision, idalumno: <?php echo $alumno->getIdalumno(); ?> },
				   	     	    function(data){
				   	     	    	alert(data);
				   	         	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriascursar?idalumno='.$alumno->getIdalumno()); ?>");	    	     	    	
				   	         	}
				   	 		);
				    	}
		   	    	} else {
			   	     	$.post("<?php echo url_for('inscripciones/inscribirmateria'); ?>",
			   	     	    { idcomision: Idcomision, idalumno: <?php echo $alumno->getIdalumno(); ?> },
			   	     	    function(data){
			   	     	    	alert(data);
			   	         	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriascursar?idalumno='.$alumno->getIdalumno()); ?>");	    	     	    	
			   	         	}
			   	 		);
		   	   	    }
	    	    });
		} else{
   	     	$.post("<?php echo url_for('inscripciones/inscribirmateria'); ?>",
				{ idcomision: Idcomision, idalumno: <?php echo $alumno->getIdalumno(); ?> },
				function(data){
	   	     	   	alert(data);
	   	           	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriascursar?idalumno='.$alumno->getIdalumno()); ?>");	    	     	    	
				}
	   	 	);
		}

		return false;
	});

	$(".botonEliminar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");
    	// Elimina el profesor a dicha mesa de examen
    	$.post("<?php echo url_for('inscripciones/eliminarinscripcionmateria'); ?>",
    	    { id: Id, idalumno: <?php echo $alumno->getIdalumno(); ?> },
    	    function(data){
    	    	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriascursar?idalumno='.$alumno->getIdalumno()); ?>");
        	}
		);
		return false;
	});	
    	
	$(".botonInscribirMultiple").click(function(){
    	// Controla e inscribe el alumno a la materia
    	$.post("<?php echo url_for('inscripciones/inscribirmateriamultiple'); ?>",
    		$('#formInscribir').serialize(),
    	    function(data){
    			alert(data);
				$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriascursar?idalumno='.$alumno->getIdalumno()); ?>");
        	}
		);
		return false;
	});	

	$(".botonInscribirMultipleSinInformar").click(function(){
    	// Controla e inscribe el alumno a la materia
    	$.post("<?php echo url_for('inscripciones/inscribirmateriamultiplesininformar'); ?>",
    		$('#formInscribir').serialize(),
    	    function(data){
    			alert(data);
				$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriascursar?idalumno='.$alumno->getIdalumno()); ?>");
        	}
		);
		return false;
	});	
		
	$(".botonSolicitar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");	
    	// Solicita libre deuda de un alumno
    	$.post("<?php echo url_for('alumnos/solicitarlibredeuda'); ?>",
    	    { id: Id, idalumno: <?php echo $alumno->getIdalumno(); ?>, tipo: 1 },
    	    function(data){
    	    	//$('#mensaje').html(data);
    	    	alert(data);
        	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriascursar?idalumno='.$alumno->getIdalumno()); ?>");	    	     	    	
        	}
		);
		return false;
	});

	$(".botonSolicitarMultiple").click(function(){
    	// Solicita libre deuda de un alumno
    	$.post("<?php echo url_for('alumnos/solicitarlibredeudamultiple'); ?>",
    		$('#formInscribir').serialize(),
    	    function(data){
    			alert(data);
        	   	$(location).attr('href',"<?php echo url_for('inscripciones/obtenermateriascursar?idalumno='.$alumno->getIdalumno()); ?>");	    	     	    	
        	}
		);
		return false;
	});		
});
</script>
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <tr>
    <td colspan="2" class="hed">Alumno: <?php echo $alumno->getPersonas(); ?> (<?php echo $alumno->getIdalumno(); ?>)</td>
  </tr>
  <tr>
    <td colspan="2" class="hed"><div id="mensaje"></div></td>
  </tr>  
  <?php if (!$estadodocumentacion) { ?>
  <tr>
    <td colspan="2" class="hed">El alumno debe presentar documentación pendiente.</td>
  </tr>  
  <?php } ?>  
  <?php if (!$entregaencuesta) { ?>
  <tr>
    <td colspan="2" class="hed">El alumno debe presentar la encuesta de alumno pendiente.</td>
  </tr>  
  <?php } ?>    
  <tr>
    <td colspan="2" class="hed">Materias a cursar:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
    	<form id="formInscribir" action=""> 
		<table width="100%" cellspacing="0" class="stats">
			<thead>
			<?php if (count($materiashabilitadas) > 0) { ?>
			<tr>
				<td align="center" colspan="6">
					<input type="hidden" name="idalumno" id="idalumno" value="<?php echo $alumno->getIdalumno(); ?>"  >
					<?php if($estadolibredeuda || $alumno->getIdplanestudio()==168 || $alumno->getIdsede()==5){ ?>
						<?php if ($estadodocumentacion and $entregaencuesta) { ?>
						<input type="submit" class="botonInscribirMultiple" value="Inscribir" title="Inscribir" >
						<input type="submit" class="botonInscribirMultipleSinInformar" value="Inscribir (Sin informar)" title="Inscribir (Sin informar)" >
						<?php } ?>
					<?php } else { ?>
						<input type="submit" class="botonSolicitarMultiple" value="Solicitar Libre Deuda" title="Solicitar Libre Deuda" >
					<?php }  ?>
				</td>
			</tr>
			<?php } ?>  		
		    <tr>
      		  <td align="center" class="hed"><input type="checkbox" id="selectall" /></td>		    
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="50%">Materia</td>
		      <td class="hed" align="center" width="15%">Curso</td>
		      <td class="hed" align="center" width="15%">Comisión</td>	     
		      <td class="hed" align="center" width="15%">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		    <?php if (count($materiashabilitadas) > 0) { ?>
            <?php $i=0; $cursoactual=0; $cursoanterior=0; ?>	
		    <?php
		    $comisiones_con_cupo = $sf_data->getRaw('comisiones_con_cupo');
		    foreach ($materiashabilitadas as $materia_plan): 
		    	//$comisiones = $materia_plan->getMateriasPlanes()->obtenerComisionesConCupo($idsede);
				$cursoactual = $materia_plan->getMateriasPlanes()->getAnodecursada();
		    ?>

			<?php 
			if($cursoactual!=$cursoanterior){
			?>
			<tr class="fila1"><td colspan="6">CURSO: <?php echo $cursoactual; ?></td></tr>
			<?php
			}
			?>

		    <tr class="fila_<?php echo $i%2 ; ?>">
		      <td align="center"><input type="checkbox" class="case" name="case[]" value="<?php echo $materia_plan->getIdmateriaplan() ?>" <?php echo ($estadolibredeuda)?"checked":""; ?> /></td>
		      <td align="center"><?php echo $materia_plan->getIdmateriaplan(); ?></td>
		      <td><?php echo $materia_plan->getMateriasPlanes(); ?></td>
		      <td align="center"><?php echo $materia_plan->getMateriasPlanes()->getAnodecursada(); ?></td>
		      <td align="center">
			      <select id="idcomision_<?php echo $materia_plan->getIdmateriaplan(); ?>" name="comisiones[<?php echo $materia_plan->getIdmateriaplan(); ?>]">
			      <?php foreach ($comisiones_con_cupo[$materia_plan->getIdcatedra()] as $k=>$v) { ?>
			      		<option value="<?php echo $k; ?>"><?php echo $v; ?></option>
			      <?php } ?>
			      </select>		 	           
		      </td>		      
			  <td align="center">
					<?php if($estadolibredeuda || $alumno->getIdplanestudio()==168 || $alumno->getIdsede()==5 ){ ?>
						<?php if ($estadodocumentacion and $entregaencuesta) { ?>
						<input type="submit" class="botonInscribir" id="<?php echo $materia_plan['idmateriaplan']; ?>" value="Inscribir" title="Inscribir" >
						<?php } ?>
					<?php } else { ?>
						<input type="submit" class="botonSolicitar" id="<?php echo $materia_plan['idmateriaplan']; ?>" value="Solicitar Libre Deuda" title="Solicitar Libre Deuda" >
					<?php }  ?>
			  </td>
		    </tr>
                    <?php $i++; $cursoanterior=$cursoactual; ?>
		    <?php endforeach; ?>
		    <?php } else { ?>
		     <tr>
		      <td align="center" colspan="6">No existen registros.</td>
		     </tr>
		    <?php } ?>			    
		  </tbody>
		</table>
		</form>
    </td>
  </tr>
  <tr>
    <td colspan="2" class="hed">Materias inscriptas:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="50%">Materia</td>
		      <td class="hed" align="center" width="15%">Curso</td>
		      <td class="hed" align="center" width="15%">Comisión</td>	
		      <td class="hed" align="center" width="15%">Cupo</td>		      
		      <td class="hed" align="center" width="15%">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  	<?php if (count($materiasinscriptas) > 0) { ?>
		    <?php foreach ($materiasinscriptas as $comision): ?>
		    <form id="formEliminar" action="">  
			    <tr>
			      <td align="center"><?php echo $comision->getCatedras()->getIdmateriaplan(); ?></td>
			      <td><?php echo $comision->getCatedras()->getMateriasPlanes(); ?></td>
			      <td align="center"><?php echo $comision->getCatedras()->getMateriasPlanes()->getAnodecursada(); ?></td>
			      <td align="center"><?php echo $comision; ?></td>
			      <td align="center"><?php echo $comision->obtenerCantidadInscriptos(); ?>/<?php echo $comision->getCapacidad(); ?></td>
			      <td align="center">
			      <?php 
					$oAluMat = Doctrine::getTable('AluMat')->getAluMat($alumno->getIdalumno(),$comision->getIdcatedra(),1);
					if ($oAluMat){
						$arr = explode('-', substr($oAluMat->getCreatedAt(),0,10));
						$fechacreacion = $arr[0]."-".$arr[1]."-".$arr[2];
						if(strtotime($fechaactual)==strtotime($fechacreacion)){
				  ?>
					<input type="submit" class="botonEliminar" id="<?php echo $oAluMat->getId(); ?>" value="Eliminar" title="Eliminar" >
				  <?php 
						}
					}
			      ?>
			      </td>
			    </tr>
		    </form>	
		    <?php endforeach; ?>
		    <?php } else { ?>
		     <tr>
		      <td align="center" colspan="6">No existen registros.</td>
		     </tr>
		    <?php } ?>			    
		  </tbody>
		</table>
    </td>
  </tr>  
</table>
</div>
<br>

