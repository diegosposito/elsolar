<script>
$(document).ready(function(){
	$('#fechavencimiento').datepicker('disable'); 
	$('#idestadomateria').attr('disabled',true);	
    // Cargar las ciudades de la carrera al combo
    $.post("<?php echo url_for('catedras/obtenermesasexamenesautogestion'); ?>",
		{ idcatedra: <?php echo $comision->getIdcatedra(); ?>,idllamado: $('#idllamado').val() },
		function(data){
			if (data!=""){
				$('#idmesaexamen').html(data);
				$('#idmesaexamen').attr('disabled',false);
				$('#botonCerrar').attr('disabled',false);
			}else{
				$('#idmesaexamen').attr('disabled',true);
				$('#idmesaexamen').html("<option value='0' selected='selected' >----NINGUNA----</option>");
			}
		}
	);
    $('#idmesaexamen').change(function(){  
    	$.post("<?php echo url_for('mesasexamenes/obtenercupoautogestion'); ?>",
    	    { idmesaexamen:$('#idmesaexamen').val() },
    	    function(data){
        	    $('#mesaexamen').html(data);
        	}
        );
    });   

    $('#idmesaexamen').focus(function(){  
    	$.post("<?php echo url_for('mesasexamenes/obtenercupoautogestion'); ?>",
    	    { idmesaexamen:$('#idmesaexamen').val() },
    	    function(data){
        	    $('#mesaexamen').html(data);
        	}
        );
    }); 

	$("#botonCerrar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("idinscripcion");
		// asigno los alumnos a las mesas	
	    	$.post("<?php echo url_for('autogestion/asignarmesa'); ?>",
	   			$("#formCerrar").serialize(),
				function(data) {
	     			alert(data);
	     			$("#formBuscar").submit();   		
		   		}       			 	
			);

	});

    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
    }); 

	$(".botonEliminar").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("idinscripcion");			
    	// Solicita libre deuda de un alumno
    	$.post("<?php echo url_for('autogestion/eliminarinscripcion'); ?>",
    			{  idinscripcion: Id },
    	    function(data){
        	   	alert(data);   
			$("#formBuscar").submit();   	     	    	
        	}
		);
		return false;
	});




    });  
</script>
<br>
<form action="" id="formCerrar" >
<div align="center">
<table cellspacing="0" class="stats" width="100%">
  <?php if ($mensaje) { ?>
  <tr>
    <td colspan="2"><?php echo $mensaje; ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="2" class="hed">Carrera: <?php echo $carrera; ?></td>
  </tr>
  <tr>
    <td colspan="2"><b>Catedra: <?php echo $idcatedra.' - '.$materiaplan; ?></b></td>
  </tr>
  <tr>
    <td>

    <table width="100%" cellspacing="0" class="stats">

      <tr>
        <td width="20%"><?php echo $form['idmesaexamen']->renderLabel() ?></td>
        <td width="20%">
          <?php echo $form['idmesaexamen']->renderError() ?>
          <?php echo $form['idmesaexamen'] ?>  
        </td>
        <td>
			<div id="mesaexamen"></div>  
        </td>        
      </tr>	            

	  <tr>
	      <td colspan="3" align="center">
	        <input type="hidden" value="<?php echo $tipo; ?>" name="tipo" id="tipo">
	        <input type="hidden" value="<?php echo $materiaplan->getIdmateriaplan(); ?>" name="idmateriaplan" id="idmateriaplan">
	        <input type="hidden" value="<?php echo $comision->getIdcomision(); ?>" name="idcomision" id="idcomision">
	        <input type="hidden" value="<?php echo $llamado; ?>" name="llamado" id="llamado">
	        <input type="submit" id="botonCerrar" value="Asignar Mesa" />
	      </td>
	  </tr>   
   </table>
   </td>
  </tr>
  <tr>
    <td colspan="2" class="hed">Seleccione los alumnos a los cuales va a inscribir a la Mesa:</td>
  </tr>
  <tr>
    <td colspan="2" align="center">
		<table width="100%" cellspacing="0" class="stats">
		  <thead>
		    <tr>
		      <td align="center" class="hed" width="3%"><input type="checkbox" id="selectall" checked /></td>
		      <td class="hed" align="center" width="5%">Id</td>
		      <td class="hed" align="center" width="5%">IdAlu</td>
		  	  <td class="hed" align="center">Alumno</td>    
		      <td class="hed" align="center" width="10%">Llamado</td>
		      <td class="hed" align="center" width="10%">Nro. de Doc</td>
		      <td class="hed" align="center" width="5%">Modo</td>
		      <td class="hed" align="center" width="10%">Conf.</td>
		      <td class="hed" align="center" width="15%">Mesa</td>
		      <td class="hed" align="center" width="10%">Acciones</td>
		    </tr>
		  </thead>
		  <tbody>
		  <?php if(count($alumnos) > 0){ ?>
                  <?php $i=0; ?>
		    <?php foreach ($alumnos as $alumno): 
			$inscripcion_mesa = Doctrine::getTable('InscripcionesMesas')->getInscripcionMesa($alumno->getIdalumno(),$idcatedra,1);
		  	$fechalibredeuda = $administracion->obtenerlibredeudaalumno($alumno->getIdalumno(),$alumno->getPersonas()->getNrodoc()); 
		
			//if(($fechalibredeuda >= date('Y-m-d')) && !(is_array($fechalibredeuda))) {
				$estadolibredeuda = true; 
			//} else {
			//	$estadolibredeuda = false;
			//}
		    ?>
		    <tr class="fila_<?php echo $i%2 ; ?>">
		      <td align="center">
				<?php if(($estadolibredeuda==true) or ($tipo!=3)){ ?>
					<?php //if($inscripcion_mesa->getIdmesaexamen()==''){ ?>
					<input type="checkbox" class="case" name="alumno[<?php echo $alumno->getIdalumno(); ?>]" value="<?php echo $alumno->getIdalumno(); ?>" <?php if ($observaciones[$alumno->getIdalumno()] !="") echo "DISABLED";?>>
				<?php } else { ?>
					<input type="checkbox" class="case" name="alumno[<?php echo $alumno->getIdalumno(); ?>]" value="<?php echo $alumno->getIdalumno(); ?>" DISABLED >
				<?php }  ?>
		      </td>
		      <td align="center"><?php echo $inscripcion_mesa->getIdinscripcion(); ?></td>				
		      <td align="center"><?php echo $alumno->getIdalumno(); ?></td>

		      <td><?php echo $alumno->getPersonas(); ?></td>
 <td align="center"><?php 


	if($inscripcion_mesa->getIdllamado()>2){
		$LlamadosTurno = Doctrine::getTable('LlamadosTurno')->find($inscripcion_mesa->getIdllamado());
		echo $LlamadosTurno->getDescripcion();
	} else {
		echo $inscripcion_mesa->getIdllamado();
	}

?></td>
		      <td align="center"><?php echo $alumno->getPersonas()->getNrodoc(); ?></td>
		      <td align="center"><?php 	
				$condiciones_mesas = Doctrine::getTable('CondicionesMesas')->find($inscripcion_mesa->getIdcondicionmesa());
				echo $condiciones_mesas->getCondicion();	?></td>
		      <td align="center"><?php 	echo $inscripcion_mesa->getConfirmado();	?></td>
		      <td align="center"><?php 	
					$mesas = Doctrine::getTable('MesasExamenes')->find($inscripcion_mesa->getIdmesaexamen());
					echo $mesas;	?></td>
		      <td align="center">
<?php 
if($inscripcion_mesa->getIdmesaexamen()>0){
?>
<input type="submit" class="botonEliminar" value="Eliminar Inscripcion" title="Eliminar Inscripcion" idinscripcion="<?php echo $inscripcion_mesa->getIdinscripcion(); ?>" >
<?php 
};
?>
				<?php if(($estadolibredeuda==false) and ($tipo==3)){ ?>
					<input type="submit" class="botonSolicitar" value="Solicitar Libre Deuda" title="Solicitar Libre Deuda" id="<?php echo $alumno->getIdalumno(); ?>" >
				<?php }  ?>
		      </td>	
		    </tr>
                    <?php $i++; ?>	
		    <?php endforeach; ?>
		    <?php } else { ?>
		    <tr>
		      <td colspan="6" align="center">No existen alumnos inscriptos a la materia.</td>
		    </tr>		    
		    <?php } ?>
		  </tbody>
		</table>
    </td>
  </tr>
</table>
</div>
</form>
