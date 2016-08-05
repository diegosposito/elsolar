<script>

$(document).ready(function(){
  $('#botonCrear').attr('disabled',true);
  $('#hora').timepicker();
	cantidad = parseInt($('#idplanestudio').length);
	if(cantidad==1) {
   	 	$('#idplanestudio').append("<option value='0' selected='selected'>----Seleccione----</option>");				
	}	
  cantidad = parseInt($('#idcategoriadesignacion').length);
  if(cantidad==1) {
      $('#idcategoriadesignacion').append("<option value='0' selected='selected'>----Seleccione----</option>");        
  } 
	habilitarForm(false);	

	<?php if ($idplanestudio) { ?>

  $.post("<?php echo url_for('planesestudios/obtenercatedras'); ?>",
		{ idplanestudio: <?php echo $idplanestudio ?>, idsede: <?php echo $idsede ?> },
  	function(data){
			$('#idcatedra').html(data);
		}
	);
	<?php } ?>

  <?php if ($idcategoriadesignacion) { ?>
  $.post("<?php echo url_for('designaciones/obtenertiposdesignaciones'); ?>",
    { idcategoriadesignacion: <?php echo $idcategoriadesignacion ?> },
    function(data){
      $('#idtipodesignacion').html(data);
    }
  );
  <?php } ?>

	$('#fechadesde').datepicker({
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

  $('#fechahasta').datepicker({
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

  var myDate = new Date();
  var anio = myDate.getFullYear()+1;
  var fromDate = '01-03-' + myDate.getFullYear();
  var toDate = '28-02-' + anio;

  if (((anio % 4 == 0) && (anio % 100 != 0)) || (anio % 400 == 0)){
    toDate = '29-02-' + anio;
  }
  $("#fechadesde").val(fromDate);
  $("#fechahasta").val(toDate);

  $('#idplanestudio').change(function(){
        habilitarForm(false);
        $('#botonCrear').attr('disabled',false);
    	if($('#idplanestudio').val()!=0){
	        
          // cargar las materias de la carrera al combo
    	    $.post("<?php echo url_for('planesestudios/obtenercatedras'); ?>",
    	    	{ idplanestudio: $('#idplanestudio').val(), idsede: $('#idsede').val() },
    	    	function(data){
        	    	$('#idcatedra').html(data);
        	    }
        	);

    	}
    });

    $('#idcategoriadesignacion').change(function(){
        habilitarForm(false);
        $('#botonCrear').attr('disabled',false);
      if($('#idcategoriadesignacion').val()!=0){
          // cargar las materias de la carrera al combo
          $.post("<?php echo url_for('designaciones/obtenertiposdesignaciones'); ?>",
            { idcategoriadesignacion: $('#idcategoriadesignacion').val() },
            function(data){
                $('#idtipodesignacion').html(data);
              }
          );
      }
    });

    $('#botonCrear').click(function() {
    	var validado = validarFormFecha();
		//validado = true;
    	if(validado == true) {
            alert(validado);  
		} else {
			alert(validado);
		}		
		return false;
   	});                
});

//Valida el formulario
function validarFormFecha(){
	var regexpmesa = /^((?:0?[1-9])|(?:[12]\d)|(?:3[01]))\-((?:0?[1-9])|(?:1[0-2]))\-((?:19|20)\d\d)$/;
	var resultado = true;

  if($('#hora_minute').val()=="") {
    resultado = "Debe seleccionar una hora.";
  }
  if($('#hora_hour').val()=="") {
    resultado = "Debe seleccionar una hora.";
  } 
	
	if (!regexpmesa.test($('#fechadesde').val())) {
		resultado = "Debe ingresar una fecha válida.";
	} 
	return resultado;
} 

function GetDate(str){
    var arr = str.split("-");

    return new Date(parseInt(arr[2]), parseInt(arr[1]-1), parseInt(arr[0]));
}

function habilitarForm(estado)
{
	$('#idcatedra').attr('disabled',estado);
  $('#idcategoriadesignacion').attr('disabled',estado);
  $('#idtipodesignacion').attr('disabled',estado);
	$('#idplanestudio').attr('disabled',estado);
	$('#fechadesde').attr('disabled',estado);
  $('#fechahasta').attr('disabled',estado);
  $('#adhonorem').attr('disabled',estado);
  $('#hora_minute').attr('disabled',estado);
  $('#hora_hour').attr('disabled',estado);
}
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div align="left"><p style="color:red"><b> <?php echo $msgError ?> </b></p></div>

<form action="<?php echo url_for('designaciones/guardar') ?>" method="post" id="formDesignar">
<input type="hidden" id="idprofesor" name="idprofesor" value="<?php echo $idprofesor; ?>">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="4" align="center">
          <?php echo $form->renderHiddenFields(false) ?>    
          <input type="submit" value="Crear Designación" id="botonDesignar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="17%"><?php echo $form['idplanestudio']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idplanestudio']->renderError() ?>
          <?php echo $form['idplanestudio'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idcatedra']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idcatedra']->renderError() ?>
          <?php echo $form['idcatedra'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idcategoriadesignacion']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idcategoriadesignacion']->renderError() ?>
          <?php echo $form['idcategoriadesignacion'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idtipodesignacion']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idtipodesignacion']->renderError() ?>
          <?php echo $form['idtipodesignacion'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['iddedicacion']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['iddedicacion']->renderError() ?>
          <?php echo $form['iddedicacion'] ?>
        </td>
      </tr>
      <tr>        
        <td><?php echo $form['fechadesde']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['fechadesde']->renderError() ?>
          <?php echo $form['fechadesde'] ?>
        </td>
      </tr>
      <tr>        
        <td><?php echo $form['fechahasta']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['fechahasta']->renderError() ?>
          <?php echo $form['fechahasta'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['hora']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['hora']->renderError() ?>
          <?php echo $form['hora'] ?>
        </td>
      </tr>
      <tr>        
        <td><b><?php echo $form['licencia']->renderLabel() ?></b></td>
        <td colspan="3">
          <?php echo $form['licencia']->renderError() ?>
          <?php echo $form['licencia'] ?>
        </td>
      </tr>  
      <tr>        
        <td><b><?php echo $form['adhonorem']->renderLabel() ?></b></td>
        <td colspan="3">
          <?php echo $form['adhonorem']->renderError() ?>
          <?php echo $form['adhonorem'] ?>
        </td>
      </tr>
      <tr>        
        <td><b><?php echo $form['motivonuevadesignacion']->renderLabel() ?></b></td>
        <td colspan="3">
          <?php echo $form['motivonuevadesignacion']->renderError() ?>
          <?php echo $form['motivonuevadesignacion'] ?>
        </td>
      </tr>
      <tr>        
        <td><b><?php echo $form['observaciones']->renderLabel() ?></b></td>
        <td colspan="3">
          <?php echo $form['observaciones']->renderError() ?>
          <?php echo $form['observaciones'] ?>
        </td>
      </tr>
    </tbody>      
  </table>
</form>
</div><br>
<div id="idmcatedra" align="center"></div>
<br>