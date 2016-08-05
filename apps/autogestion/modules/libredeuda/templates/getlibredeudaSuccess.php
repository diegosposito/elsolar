<script type="text/javascript">
$.dpText = {
		TEXT_PREV_YEAR		:	'Año Previo',
		TEXT_PREV_MONTH		:	'Mes Previo',
		TEXT_NEXT_YEAR		:	'Año Siguiente',
		TEXT_NEXT_MONTH		:	'Mes Siguiente',
		TEXT_CLOSE			:	'Cerrar',
		TEXT_CHOOSE_DATE	:	'Elegir fecha'
	}

$(function() {
	$(".submitAprobar").click(function () {
		idalumno= $(this).parent().parent().attr("name"); 
		celda = $(this).parent().parent().find("#celda");
		celda.find("#estadoinscripcion").val("2");
		celda.find("#target").submit();

		return false;
	});
	 
	$(".submitRechazar").click(function () {	
		idalumno= $(this).parent().parent().attr("name"); 
		celda = $(this).parent().parent().find("#celda");

		
		if(celda.find("#estadoinscripcion").val()=="1"){
			celda.find("#observacionesform").show();
			celda.find("#estadoinscripcion").val("3")
			return false;
		}else{
			celda.find("#target").submit();
		}
		return false;		
	});

	$(".submitMasInfo").click(function () {
		idalumno= $(this).parent().parent().parent().attr("name"); 
		fila = $(this).parent().parent();
		
		$("#masfila"+idalumno).show();
		fila.find("#menos").show();
		fila.find("#mas").hide();
		$("#masinfo"+idalumno).load('<?php echo url_for('libredeuda/getdetallesinscripciones') ?>?idalumno='+idalumno);

		return false;
	});

	$(".submitMenosInfo").click(function () {
		idalumno= $(this).parent().parent().parent().attr("name"); 
		fila = $(this).parent().parent();
		
		$("#masfila"+idalumno).hide();	
		fila.find("#menos").hide();
		fila.find("#mas").show();
  		
		return false;
	});	
		  
	$(".date-pick").datePicker().val(new Date().asString()).trigger('change');
});
</script>
<br />
<h1>Libre deuda</h1>
<br />

<a name="mas" href="<?php echo url_for('libredeuda/gethistorial') ?>">Visualizar historial</a>
<br>
		<div class="demo-container">
		  <div class="demo-box"></div>
		</div>
  <table width="50%" class="stats" id="dataTable" cellspacing="0">
  <thead>
    <tr>
      <td class="hed"></td>
      <td class="hed">Id</td>
      <td class="hed">Nombre</td>
      <td class="hed">Nro. documento</td>

      <td class="hed">Fecha libre deuda</td>
      <td class="hed">Aprobar</td>
      <td class="hed">Comentario</td>
      <td class="hed">Rechazar</td>
    </tr>
  </thead>
  <tbody>
  <?php if (count($solicitudess)==0) {?>
      <tr>
      <td colspan="6">No existen solicitudes de libre deuda pendientes.</td>
      </tr> 
  <?php } else { ?>
   	<?php 
   	foreach($solicitudess as $solicitud){
   	?>
   	  <tr name="<?php echo $inscripcion['idalumno'] ?>">
      <td><div id="mas" ><a class="submitMasInfo" name="<?php echo $inscripcion['idalumno'] ?>" href="">+</a></div><div id="menos" style="display:none" ><a class="submitMenosInfo" name="<?php echo $inscripcion['idalumno'] ?>" href="">-</a></div></td>
      <td><?php echo $solicitud['idalumno'] ?></td>
      <td><?php echo $solicitud['alumno'] ?></td>
      <td><?php echo $solicitud['dni'] ?></td>

      <td id="celda">
   	    <form id="target" method="post" action="<?php echo url_for('libredeuda/responderlibredeuda') ?>">
      		<input type="hidden" id="estadoinscripcion" name="estadoinscripcion" value="1">
      		<input type="text" size="8" class="date-pick" id="fechalibredeuda" name="fechalibredeuda" value="26/02/2011"> 
			<input type="hidden" id="idalumno" name="idalumno" value="<?php echo $inscripcion['idalumno'] ?>">
      		<div id="observacionesform" style="display:none">Observaciones:<br><textarea name="observaciones"></textarea></div>
      	</form>


      </td>

      <td>
                <form name="form_<?php echo $plan['idCarrera']; ?>" method="post" action="<?php echo url_for('libredeuda/aceptarlibredeuda' ) ?>">  
                     <input type="hidden" name="idc" value="<?php echo $plan['idCarrera']; ?>">
                     <input type="hidden" name="ida" value="<?php echo $solicitud['idalumno']; ?>">
                     <input type="submit" value="Aceptar" title="Solicitud Libredeuda" id="Visualizar" class="form_consulta_enviar" name="Aceptar">
                </form>
    </td>
<form name="form_<?php echo $plan['idCarrera']; ?>" method="post" action="<?php echo url_for('libredeuda/rechazarlibredeuda' ) ?>">  
      <td>

<input type="text" name="comentario" >
    </td>
      <td>

                
                     <input type="hidden" name="idc" value="<?php echo $plan['idCarrera']; ?>">
                     <input type="hidden" name="ida" value="<?php echo $solicitud['idalumno']; ?>">
                     <input type="submit" value="Rechazar" title="Solicitud Libredeuda" id="Visualizar" class="form_consulta_enviar" name="Rechazar">
               

</td>
 </form>
      </tr> 
      <div >
      <tr id="masfila<?php echo $solicitud['idalumno'] ?>" style="display:none">
        <td colspan="7"><div id="masinfo<?php echo $inscripcion['idalumno'] ?>" ></div></td>
     </tr>
     </div>
  	<?php } ?>
  <?php } ?>
  </tbody>
  </table>
