<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<script>
$(document).ready(function(){
	if($('#materias_planes_generica option:selected').val()==0) {  
		$('#materias_planes_puntajerequerido').attr('disabled',true);		
	} else {
		cargarMateriasComponentes();
	}
	
    $('#materias_planes_generica').change(function() {  
        if($('#materias_planes_generica option:selected').val()==0) {  
            $('#materiasOptativas').hide();
            $('#materias_planes_puntajerequerido').attr('disabled',true);
        } else {  
        	cargarMateriasComponentes();
        }  
    });    

    $('#materias_planes_idtipomateria').change(function() {  
        if($('#materias_planes_idtipomateria option:selected').val()==3) {  
            $('#materias_planes_saleanalitico').attr('checked', true);
        } else {  
        	$('#materias_planes_saleanalitico').attr('checked', false);
        }  
    });     
});

//Cargar materias optativas
function cargarMateriasComponentes() {
    if ($('#materias_planes_idmateriaplan').val()) {
    	$('#materias_planes_puntajerequerido').attr('disabled',false);
    	$.post("<?php echo url_for('materiasplanes/obtenermateriasoptativas'); ?>",
    	    { idmateriaplan: $('#materias_planes_idmateriaplan').val() },
    		function(data){
    			$('#materiasOptativas').html(data);
    		}
    	);   
    } else {
    	$('#materiasOptativas').html("<p align='center'>Debe guardar la asignatura antes de poder agregar asignaturas optativas.</p>");
    	$('#materias_planes_puntajerequerido').attr('disabled',true);
    }	
    $('#materiasOptativas').show();	
} 

//Valida el formulario
/*function validarFormMateria(){

	if($("#materias_planes_orden").val()=="") {
		alert("Debe ingresar el numero de orden.");
		return 0;
	} 
 
	if($("#materias_planes_anodecursada").val()=="") {
		alert("Debe ingresar el año de cursada.");
		return 0;
	} else if(($("#materias_planes_anodecursada").val() < 1) || ($("#materias_planes_anodecursada").val() > 6)) {
		alert("El valor del año de cursada debe ser entre 1 y 6.");
		return 0;
	} 

	if($("#materias_planes_periododecursada").val()=="") {		
		alert("Debe ingresar el periodo de cursada.");
		return 0;
	} else if(($("#materias_planes_periododecursada").val() < 1) || ($("#materias_planes_periododecursada").val() > 9)) {
		alert("El valor del periodo de cursada debe ser entre 1 y 9.");
		return 0;
	} 

	if($("#materias_planes_credito").val()=="") {
		alert("Debe ingresar el credito otorgado.");
		return 0;
	} 
	
	if($("#materias_planes_cantidadaplazos").val()=="") {
		alert("Debe ingresar la cantidad de aplazos permitidos.");
		return 0;
	} 
				
	document.formMateria.submit(); 
} */
</script>
<table cellspacing="0" class="stats" width="100%" align="center">
  <tr>
    <td>
		<form action="<?php echo url_for('materiasplanes/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?idmateriaplan='.$form->getObject()->getIdmateriaplan() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
		<?php if (!$form->getObject()->isNew()): ?>
		<input type="hidden" name="sf_method" value="put" />
		<?php endif; ?>
		  <table cellspacing="0" width="100%">
		    <tfoot>
		      <tr>
		        <td colspan="6" align="center">
		          <?php echo $form->renderHiddenFields(false) ?>
		          <?php if (!$form->getObject()->isNew()): ?>
		            &nbsp;<?php echo link_to('Eliminar', 'materiasplanes/delete?idmateriaplan='.$form->getObject()->getIdmateriaplan(), array('method' => 'delete', 'confirm' => 'Esta seguro?')) ?>
		          <?php endif; ?>
		          <input type="submit" value="Guardar" />
		        </td>
		      </tr>
		    </tfoot>
		    <tbody>
		      <?php echo $form->renderGlobalErrors() ?>
		      <tr>
		        <td><?php echo $form['idmateria']->renderLabel() ?></td>
		        <td colspan="5">
		          <?php echo $form['idmateria']->renderError() ?>
		          <?php echo $form['idmateria'] ?>
		        </td>
		      </tr>   
		      <tr>
		        <td><?php echo $form['idtipomateria']->renderLabel() ?></td>
		        <td colspan="3">
		          <?php echo $form['idtipomateria']->renderError() ?>
		          <?php echo $form['idtipomateria'] ?>
		        </td>
		        <td><?php echo $form['orden']->renderLabel() ?></td>
		        <td>
		          <?php echo $form['orden']->renderError() ?>
		          <?php echo $form['orden'] ?>
		        </td>        
		       </tr>
		       <tr>
		        <td><?php echo $form['idtipocursada']->renderLabel() ?></td>
		        <td>
		          <?php echo $form['idtipocursada']->renderError() ?>
		          <?php echo $form['idtipocursada'] ?>
		        </td>
		        <td><?php echo $form['anodecursada']->renderLabel() ?></td>
		        <td>
		          <?php echo $form['anodecursada']->renderError() ?>
		          <?php echo $form['anodecursada'] ?>
		        </td>        
		        <td><?php echo $form['periododecursada']->renderLabel() ?></td>
		        <td>
		          <?php echo $form['periododecursada']->renderError() ?>
		          <?php echo $form['periododecursada'] ?>
		        </td>        
		      </tr>
		      <tr>
		        <td><?php echo $form['saleanalitico']->renderLabel() ?></td>
		        <td>
		          <?php echo $form['saleanalitico']->renderError() ?>
		          <?php echo $form['saleanalitico'] ?>
		        </td>    
		        <td><?php echo $form['codmat']->renderLabel() ?></td>
		        <td>
		          <?php echo $form['codmat']->renderError() ?>
		          <?php echo $form['codmat'] ?>
		        </td>    
		        <td><?php echo $form['credito']->renderLabel() ?></td>
		        <td>
		          <?php echo $form['credito']->renderError() ?>
		          <?php echo $form['credito'] ?>
		        </td>                  
		      </tr>
		      <tr>
		        <td><?php echo $form['cargahorariasemanal']->renderLabel() ?></td>
		        <td>
		          <?php echo $form['cargahorariasemanal']->renderError() ?>
		          <?php echo $form['cargahorariasemanal'] ?>
		        </td>
		        <td><?php echo $form['cargahorariatotal']->renderLabel() ?></td>
		        <td>
		          <?php echo $form['cargahorariatotal']->renderError() ?>
		          <?php echo $form['cargahorariatotal'] ?>
		        </td>
		        <td><?php echo $form['cantidadaplazos']->renderLabel() ?></td>
		        <td>
		          <?php echo $form['cantidadaplazos']->renderError() ?>
		          <?php echo $form['cantidadaplazos'] ?>
		        </td>
		      </tr>
		      <tr>
		        <td><?php echo $form['contenidominimo']->renderLabel() ?></td>
		        <td colspan="5">
		          <?php echo $form['contenidominimo']->renderError() ?>
		          <?php echo $form['contenidominimo'] ?>
		        </td>
		      </tr>      
		      <tr>
		        <td><?php echo $form['generica']->renderLabel() ?></td>
		        <td>
		          <?php echo $form['generica']->renderError() ?>
		          <?php echo $form['generica'] ?>
		        </td>
		        <td><?php echo $form['puntajerequerido']->renderLabel() ?></td>
		        <td colspan="3">
		          <?php echo $form['puntajerequerido']->renderError() ?>
		          <?php echo $form['puntajerequerido'] ?>
		        </td>
		      </tr>      
		    </tbody>
		  </table>
		</form>
		</td>
  </tr>
  <tr>
    <td><div id="materiasOptativas"></div></td>
  </tr>
</table>
<p align="center"><input type="button" value="Volver" onclick="location.href='<?php echo url_for('materiasplanes/index?idplanestudio='.$idplanestudio) ?>'"></p>
<br>
