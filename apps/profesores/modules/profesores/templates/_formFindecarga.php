<script>

$(document).ready(function(){
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

  

  $('#botonver').click(function() {
    // guardar la informacion de documentacion adicional del alumnos ingresada
        $.post("<?php echo url_for('profesores/consultar'); ?>",
          { idestadodesignacion: '1,3',idfacultad: $('#idfacultad').val(), fechadesde: $('#fechadesde').val(), fechahasta: $('#fechahasta').val()},
        function(data){
        $('#idresultados').html(data);
        }
        );
  });

  $('#botonfincarga').click(function() {
    // guardar la informacion de documentacion adicional del alumnos ingresada
        $.post("<?php echo url_for('profesores/confirmarfindecarga'); ?>",
          { idestadodesignacion: '1',idfacultad: $('#idfacultad').val(), fechadesde: $('#fechadesde').val(), fechahasta: $('#fechahasta').val()},
        function(data){
        $('#idresultados').html(data);
        }
        );
  }); 

    
  $('#botonVolver').click(function() {
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
	$('#idfacultad').attr('disabled',estado);
 	$('#fechadesde').attr('disabled',estado);
  $('#fechahasta').attr('disabled',estado);
}
</script>
<div align="center">
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div align="left"><p style="color:red"><b> <?php echo $msgError ?> </b></p></div>

  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
        <p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('personas/buscar') ?>'"></p>
        </td>
        <td colspan="2" align="center">
          <?php echo $form->renderHiddenFields(false) ?>    
          <input type="button" value="Aplicar filtros" name="botonver" id="botonver" />
       
          <?php echo $form->renderHiddenFields(false) ?>    
          <input type="submit" value="Fin de Carga" name="botonfincarga" id="botonfincarga" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <td width="17%"><?php echo $form['idfacultad']->renderLabel() ?></td>
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
    </tbody>      
  </table>
</div><br>
<br>

<div id="idresultados" name="resultados" align="center"></div>
<br>