<h1>Inscripción de Aspirante a Carrera</h1>

<script>
$(document).ready(function(){
	$('#tabs').tabs();
	$('#tabs').tabs("option", "disabled", [1]);
	$('#provincianacimiento').attr('disabled',true);
	$('#ciudadnacimiento').attr('disabled',true);
	$('#provinciaresidencia').attr('disabled',true);
	$('#ciudadresidencia').attr('disabled',true);
	$('#fechanacimiento').datepicker({
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

});
</script>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('inscripciones/inscribiraspirante') ?>" method="post">
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Información Personal</a></li>
		<li><a href="#tabs-2">Documentación</a></li>
	</ul>
	<div id="tabs-1">
	  <table>
	    <tfoot>
	      <tr>
	        <td colspan="4" align="center">
	          <input type="submit" value="Aceptar" />
	        </td>
	      </tr>
	    </tfoot>
	    <tbody>
	      <tr>
	        <td>
	        	<?php echo $form['nombre']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['nombre']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['apellido']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['apellido']->render() ?>
	        </td>
	      </tr>
	      <tr>
	        <td>
	        	<?php echo $form['idsexo']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['idsexo']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['estadocivil']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['estadocivil']->render() ?>
	        </td>
	      </tr>	     
	      <tr>
	        <td colspan="4">Lugar de Nacimiento:</td>
	      </tr>	 
		  <tr>
	        <td>
	        </td>
	        <td>
	        	<?php echo $form['paisnacimiento']->renderLabel() ?>
	        </td>
	        <td colspan="2">
	        	<?php echo $form['paisnacimiento']->render() ?>
	        </td>
	      </tr>	 
		  <tr>
	        <td>
	        </td>
	        <td>
	        	<?php echo $form['provincianacimiento']->renderLabel() ?>
	        </td>
	        <td colspan="2">
	        	<?php echo $form['provincianacimiento']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td>
	        </td>
	        <td>
	        	<?php echo $form['ciudadnacimiento']->renderLabel() ?>
	        </td>
	        <td colspan="2">
	        	<?php echo $form['ciudadnacimiento']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td colspan="4">Lugar de Residencia:</td>
	      </tr>	 
		  <tr>
	        <td>
	        </td>
	        <td>
	        	<?php echo $form['paisresidencia']->renderLabel() ?>
	        </td>
	        <td colspan="2">
	        	<?php echo $form['paisresidencia']->render() ?>
	        </td>
	      </tr>	 
		  <tr>
	        <td>
	        </td>
	        <td>
	        	<?php echo $form['provinciaresidencia']->renderLabel() ?>
	        </td>
	        <td colspan="2">
	        	<?php echo $form['provinciaresidencia']->render() ?>
	        </td>
	      </tr>	
	      <tr>
	        <td>
	        </td>
	        <td>
	        	<?php echo $form['ciudadresidencia']->renderLabel() ?>
	        </td>
	        <td colspan="2">
	        	<?php echo $form['ciudadresidencia']->render() ?>
	        </td>
	      </tr>		      
	      <tr>
	        <td>
	        	<?php echo $form['tipodocumento']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['tipodocumento']->render() ?>
	        </td>
	        <td>
	        	<?php echo $form['nrodocumento']->renderLabel() ?>
	        </td>
	        <td>
	        	<?php echo $form['nrodocumento']->render() ?>
	        </td>
	      </tr>	  	      
	    </tbody>
	  </table>	
	</div>
	<div id="tabs-2">
		<p>Hola</p>
	</div>
</div>
</form>