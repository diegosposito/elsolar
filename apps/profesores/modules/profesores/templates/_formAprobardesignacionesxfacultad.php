<script>

$(document).ready(function(){

    $('#botonaceptar').click(function() {
          
        var selected_cases = new Array();
        $("input:checked").each(function() {
           selected_cases.push($(this).val());
        });

        $.post("<?php echo url_for('profesores/aceptarcancelardesignaciones'); ?>",
          {idcase: selected_cases, observaciones: $('#observaciones').val(), idfacultad: $('#idfacultad').val(), idsede: $('#idsede').val(), idoperacion: 1, fechadesde: $('#fechadesde').val(), fechahasta: $('#fechahasta').val()},
        function(data){
        $('#idresultados').html(data);
        }
        );
        $('#botonaceptar').attr('disabled',true);
        $('#botonrechazar').attr('disabled',true);
    });

    $('#botonrechazar').click(function() {

        var selected_cases = new Array();
        $("input:checked").each(function() {
           selected_cases.push($(this).val());
        });

    // rechaza designaciones
        $.post("<?php echo url_for('profesores/aceptarcancelardesignaciones'); ?>",
          {idcase: selected_cases, observaciones: $('#observaciones').val(), idfacultad: $('#idfacultad').val(),idsede: $('#idsede').val(), idoperacion: 2, fechadesde: $('#fechadesde').val(), fechahasta: $('#fechahasta').val()},
        function(data){
        $('#idresultados').html(data);
        }
        );
        $('#botonaceptar').attr('disabled',true);
        $('#botonrechazar').attr('disabled',true);
    });

    $('#botonver').click(function() {
    // consulta informacion del alumno ingresada
        $.post("<?php echo url_for('profesores/consultarporfacultad'); ?>",
          {idfacultad: $('#idfacultad').val(),idsede: $('#idsede').val(), idestadodesignacion: 2, fechadesde: $('#fechadesde').val(), fechahasta: $('#fechahasta').val()},
        function(data){
        $('#idresultados').html(data);
        }
        );
    });

    $('#idfacultad').change(function(){
        $('#botonaceptar').attr('disabled',false);
        $('#botonrechazar').attr('disabled',false);
    });
   

	$('#botonVolver').attr('disabled',true);
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

  var myDate = new Date();
  var anio = myDate.getFullYear()+1;
  var fromDate = '01-03-' + myDate.getFullYear();
  var toDate = '28-02-' + anio;

  if (((anio % 4 == 0) && (anio % 100 != 0)) || (anio % 400 == 0)){
    toDate = '29-02-' + anio;
  }
  $("#fechadesde").val(fromDate);
  $("#fechahasta").val(toDate);
                   
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
    <tfoot>
      <tr>
        <td colspan="4" align="center">
          <?php echo $form->renderHiddenFields(false) ?>    
          <input type="button" value="Aplicar filtros" name="botonver" id="botonver" />
        </td>
      </tr>
      <tr>
        <td bgcolor="#FF0000" colspan="2" align="center">
        <?php echo $form->renderHiddenFields(false) ?>    
          <input type="button" value="Observar Designaciones" name="botonrechazar" id="botonrechazar" />
        </td>
        <td bgcolor="#00FF00" colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>    
          <input type="button" value="Visar Designaciones" name="botonaceptar" id="botonaceptar" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td><?php echo $form['idsede']->renderLabel() ?></td>
        <td colspan="3">
          <?php echo $form['idsede']->renderError() ?>
          <?php echo $form['idsede'] ?>
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
        <th><?php echo $form['observaciones']->renderLabel() ?></th>
        <td colspan="3">
          <?php echo $form['observaciones']->renderError() ?>
          <?php echo $form['observaciones'] ?>
        </td>
      </tr>
      </tbody>      
  </table>
<br>
<div id="idresultados" name="resultados" align="center"></div>
<br>

</div><br>
