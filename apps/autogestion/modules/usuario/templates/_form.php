<script>
$(document).ready(function(){
    $('#botonGuardarPassword').click(function() {
		// guardar la informacion personal del aspirante ingresada
    	$.post("<?php echo url_for('usuario/guardarpassword'); ?>",
			$('#formGuardarPassword').serialize(),
    		function(data){
    			$('#mensaje').html(data);
    		}
		);
		return false;
   	});   			
});
</script>

<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="" id="formGuardarPassword" method="post">
  <table cellspacing="0" class="stats" width="60%">
    <tfoot>
	    <tr>
	       <td>E-mail:</td>
	       <td><?php echo $sf_user->getGuardUser()->getUsername() ?></td>	       
	    </tr>    
      <tr>
        <td colspan="2" align="center">
	      <input type="submit" value="Guardar" id="botonGuardarPassword" />        
        </td>
      </tr>
    </tfoot>
    <tbody>
	    <tr>
	       <td colspan="2">
	       	<b><font color="red"><div id="mensaje"></div></font></b>
	       </td>
	    </tr>	    
	    <tr>
	       <td colspan="2">
	       	<b><font>NOTA: La nueva password debe tener una longitud mínima de 8 caracteres.</font></b>
	       </td>
	    </tr>	    
	    <tr>
	       <td width="25%">
	        	<?php echo $form['password']->renderLabel() ?>
	       </td>
	       <td>
	        	<?php echo $form['password']->render() ?>
	       </td>
        </tr>
	    <tr>
	       <td width="25%">
	        	<?php echo $form['nuevapassword']->renderLabel() ?>
	       </td>
	       <td>
	        	<?php echo $form['nuevapassword']->render() ?>
	       </td>
        </tr>
	    <tr>
	       <td width="25%">
	        	<?php echo $form['renuevapassword']->renderLabel() ?>
	       </td>
	       <td>
	        	<?php echo $form['renuevapassword']->render() ?>
	       </td>
        </tr>                
    </tbody>
  </table>
</form>
