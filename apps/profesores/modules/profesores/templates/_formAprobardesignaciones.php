<script>

$(document).ready(function(){

  // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
    });

    $("#idaprobar").hide();
    
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
    }); 

    $('#idsede, #idfacultad, #idplanestudio, #idresolucion, #activo').click(function() {
    // guardar la informacion de documentacion adicional del alumnos ingresada
        $.post("<?php echo url_for('profesores/obtenerdesignaciones'); ?>",
          {idsede: $('#idsede').val(), idfacultad: $('#idfacultad').val(), idplanestudio: $('#idplanestudio').val(), fechadesde: $('#fechadesde').val(), fechahasta: $('#fechahasta').val(),activo: $('#activo').val(), idresolucion: $('#idresolucion').val()},
        function(data){
        $('#idresultados').html(data);
        }
        );
    }); 

    $('#fechadesde, #fechahasta').change(function() {
    // guardar la informacion de documentacion adicional del alumnos ingresada
        $.post("<?php echo url_for('profesores/obtenerdesignaciones'); ?>",
          {idsede: $('#idsede').val(), idfacultad: $('#idfacultad').val(), idplanestudio: $('#idplanestudio').val(), fechadesde: $('#fechadesde').val(), fechahasta: $('#fechahasta').val(),activo: $('#activo').val(), idresolucion: $('#idresolucion').val()},
        function(data){
        $('#idresultados').html(data);
        }
        );
    }); 

     $('#botonaprobar').click(function() {
        $.post("<?php echo url_for('profesores/actualizarestadodesignaciones'); ?>",
          {idcase: $('#idcase').serialize() },
        function(data){
        $('#idresultados').html(data);
        //$('#botonGenerar').attr("disabled",false);
        }
        );
    });  
   

	$('#botonVolver').attr('disabled',true);
	cantidad = parseInt($('#idsede').length);
	if(cantidad==1) {
   	 	$('#idsede').append("<option value='0' selected='selected'>----Seleccione----</option>");				
	}	
  cantidad = parseInt($('#idfacultad').length);
  if(cantidad==1) {
      $('#idfacultad').append("<option value='0' selected='selected'>----Seleccione----</option>");        
  } 
  cantidad = parseInt($('#idplanestudio').length);
  if(cantidad==1) {
      $('#idplanestudio').append("<option value='0' selected='selected'>----Seleccione----</option>");        
  } 
  cantidad = parseInt($('#idresolucion').length);
  if(cantidad==1) {
      $('#idresolucion').append("<option value='0' selected='selected'>----Seleccione----</option>");        
  } 
	habilitarForm(false);	

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

  $('#idfacultad').change(function(){
        habilitarForm(false);
        $('#botonVolver').attr('disabled',false);
        
        if($('#idfacultad').val()!=0){
          // cargar las materias de la carrera al combo
          $.post("<?php echo url_for('planesestudios/obtenerplanesxfacultad'); ?>",
            { idfacultad: $('#idfacultad').val() },
            function(data){
                $('#idplanestudio').html(data);
              }
          );

          // cargar resoluciones de la facultad/sede seleccionada
          $.post("<?php echo url_for('profesores/obtenerresolucionesxfacultad'); ?>",
            { idsede: $('#idsede').val(), idfacultad: $('#idfacultad').val() },
            function(data){
                $('#idresolucion').html(data);
              }
          );
      }
  });

                 
});

//Valida el formulario
function validarFormFecha(){
	var regexpmesa = /^((?:0?[1-9])|(?:[12]\d)|(?:3[01]))\-((?:0?[1-9])|(?:1[0-2]))\-((?:19|20)\d\d)$/;
	var resultado = true;
	
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
	$('#idcategoriadesignacion').attr('disabled',estado);
  $('#idtipodesignacion').attr('disabled',estado);
	$('#idplanestudio').attr('disabled',estado);
	$('#fechadesde').attr('disabled',estado);
  $('#fechahasta').attr('disabled',estado);
}
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div align="left"><p style="color:red"><b> <?php echo $msgError ?> </b></p></div>
<div align="left"><p style="color:green"><b> <?php echo $msgSuccess ?> </b></p></div>
<?php if ($success==1) { ?>
    <div align="left"><p style="color:green"><b> <?php echo $msg ?> </b></p></div>
<?php } else { ?>
     <div align="left"><p style="color:red"><b> <?php echo $msg ?> </b></p></div>
<?php } ?>

  <table cellspacing="0" class="stats" width="100%">
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="17%"><?php echo $form['idsede']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idsede']->renderError() ?>
          <?php echo $form['idsede'] ?>  (*)
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idfacultad']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idfacultad']->renderError() ?>
          <?php echo $form['idfacultad'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idplanestudio']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idplanestudio']->renderError() ?>
          <?php echo $form['idplanestudio'] ?>
        </td>
      </tr>
      <tr>
        <td><?php echo $form['idresolucion']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idresolucion']->renderError() ?>
          <?php echo $form['idresolucion'] ?>
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
        <td><?php echo $form['activo']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['activo']->renderError() ?>
          <?php echo $form['activo'] ?>
        </td>
      </tr>
    </tbody>      
  </table>
<br>
<div id="idresultados" name="resultados" align="center"></div>
<br>

</div><br>
