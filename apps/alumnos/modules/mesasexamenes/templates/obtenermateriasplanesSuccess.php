<script>
$(document).ready(function(){	
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
        if ($(this).attr('checked')==true) {
			//$('.case').attr('checked', this.checked);
			$(".case").each(function(){
				if ($(this).attr('disabled')==true) {
					$(this).removeAttr("checked");
				} else {
					$(this).attr("checked", "cehcked");
				}
			});  
        }else{
        	$('.case').attr('checked', this.checked);
		}	                 
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
});

function validarFormulario(){
	var resultado = true;

	if(!$('input:checkbox:checked').val()) {
		resultado = "Debe seleccionar al menos un plan de estudios.";
	} 
 
	return resultado;
} 
</script>
<table cellspacing="0" class="stats" width="100%">
  <thead>
    <tr>
	  <td align="center" class="hed" width="3%"><input type="checkbox" id="selectall" /></td>
	  <td class="hed" align="center" width="5%">Id</td>
      <td class="hed" align="center">Materia</td>
      <td class="hed" align="center" width="15%">Curso</td>
    </tr>
  </thead>
  <tbody>
	<?php if (count($materiasplanes)>0) {?>
		<?php foreach ($materiasplanes as $materia): ?>
			<tr>
				<td align="center">
					<input type="checkbox" class="case" name="case[]" value="<?php echo $materia->idmateriaplan; ?>" >
				</td>
				<td align="center"><?php echo $materia->idmateriaplan; ?></td>			
				<td><?php echo $materia->nombre ?></td>
				<td align="center"><?php echo $materia->curso ?></td>
			</tr>
		<?php endforeach; ?>
	<?php } else {?>
		<tr>
			<td colspan="4" align="center">No existen materias.</td>
		</tr>		    
	<?php } ?>	    
  </tbody>
</table>