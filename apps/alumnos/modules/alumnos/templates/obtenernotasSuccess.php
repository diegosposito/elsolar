<script>
$(document).ready(function(){
    // add multiple select / deselect functionality
    $("#selectall").click(function() {
          $('.case').attr('checked', this.checked);
    });
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function() {
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
    });    
});
</script>
<div align="center">
<table class="stats" width="100%" border="1px">
    <tr>
      <td align="center" class="hed"><input type="checkbox" id="selectall" checked /></td>
      <td align="center" class="hed">Idme</td>
      <td align="center" class="hed">Nombre</td>
      <td align="center" class="hed">Nota</td>
      <td align="center" class="hed">Libro</td>
      <td align="center" class="hed">Folio</td>
      <td align="center" class="hed">Fecha</td>
      <td align="center" class="hed">Condicion</td>
      <td align="center" class="hed">Tipo Ex.</td>
      <td align="center" class="hed">Tipo Mat.</td>
      <td align="center" class="hed">Sale</td>
    </tr>
<?php 
$arrYears = array (1 => "Primer año", 2 => "Segundo año", 3 => "Tercer año", 4 => "Cuarto año",  5 => "Quinto año", 6 => "Sexto año");
$anioactual = 0; $promedio = 0; $cantidad = 0; $canti = 0;
     
	if (count($materias) > 0) {
		foreach($materias as $analit) { 
			if ($anioactual != $analit['anodecursada']) { 
				$anioactual = $analit['anodecursada']; 
?>
	<tr bgcolor="#666666">
		<td align="center"></td>
		<td colspan="10"><b><?php echo $arrYears[$anioactual] ?></b></td>
	</tr>
<?php 
			} 
?>    	 
	<tr>
		<td align="center"><input type="checkbox" class="case" name="case[]" value="<?php echo $analit['idme'] ?>" <?php echo ($analit['saleanalitico'])?"checked":""; ?> /></td>
		<td align="center"><?php echo $analit['idme'] ?></td>
		<td><?php echo $analit['nombre']."(".$analit['idmp'].")" ?></td>
		<td align="center"><?php echo ($analit['nota']==null or $analit['nota']=="")?$analit['calificacion']:$analit['nota'] ?></td>
		<td align="center"><?php echo ($analit['libro']==null or $analit['libro']=="")?$analit['libroacta']:$analit['libro'] ?></td>
		<td align="center"><?php echo $analit['folio'] ?></td>
		<td align="center">
		<?php 
			$arr = explode('-', $analit['fecha']);
			$fecha = $arr[2]."-".$arr[1]."-".$arr[0];	 
			echo $fecha;
		?>
		</td>
		<td align="center"><?php echo $analit['condicion'] ?></td>
		<td align="center"><?php echo $analit['tipoexamen'] ?></td>
		<td align="center"><?php echo $analit['tipomateria'] ?></td>
		<td align="center"><?php echo ($analit['enanalitico']==1)?"Si":"No" ?></td>
	</tr>
<?php 
			if ($analit['calif']!="" || $analit['calif']!=0) {
				$valor=str_replace(",",".",$analit['calif']);
				$promedio+=$valor; 
				$canti++;
			}    
			$cantidad++;
		} 
	} 
?>
    <?php if (count($extracurriculares) > 0) { ?>
    <tr>
      <td align="center" colspan="12" class="hed">Texto Extracurriculares</td>
    </tr>     
    <tr>
		<td align="center" colspan="12">
			<TEXTAREA cols="107" rows="2" name="textoextracurriculares">Asimismo se deja constancia de que se han cumplido las exigencias extracurriculares previstas en el Plan de Estudios de la siguiente manera.</TEXTAREA>
		</td>
    </tr>     
    <tr>
      <td align="center" class="hed"></td>
      <td align="center" class="hed">Id</td>
      <td align="center" class="hed">Nombre</td>
      <td align="center" class="hed">Nota</td>
      <td align="center" class="hed">Libro</td>
      <td align="center" class="hed">Folio</td>
      <td align="center" class="hed">Fecha</td>
      <td align="center" class="hed">Condicion</td>
      <td align="center" class="hed">Tipo Ex.</td>
      <td align="center" class="hed">Tipo Mat.</td>
      <td align="center" class="hed">Sale</td>
      <td align="center" class="hed">Obs.</td>
    </tr>
<?php     
	foreach($extracurriculares as $extra) { 
?>    	 
	<tr>
		<td align="center"><input type="checkbox" class="case" name="case[]" value="<?php echo $extra['idmp'] ?>" <?php echo ($extra['saleanalitico'])?"checked":""; ?> /></td>
		<td align="center"><?php echo $extra['idmp'].'-'.$extra['idme'] ?></td>
		<td><?php echo $extra['nombre'] ?></td>
		<td align="center">
			<?php if ($extra['nota']==null or $extra['nota']=="") {
				if ($extra['idcondicion']==5 ) {
					$nota = "";
				} else {
					$nota = number_format($extra['calificacion'],2, ",", ".");	
				}
			} else {
				if(is_numeric($extra['nota'])) {
					$nota = number_format(str_replace(",",".",$extra['nota']),2, ",", "");
				} else {			
					$nota = $extra['nota'];
				}
			}
			echo $nota; ?>
		</td>
		<td align="center"><?php echo ($extra['libro']==null or $extra['libro']=="")?$extra['libroacta']:$extra['libro'] ?></td>
		<td align="center"><?php echo $extra['folio'] ?></td>
		<td align="center">
			<?php $arr = explode('-', $extra['fecha']);
			echo $arr[2]."-".$arr[1]."-".$arr[0] ?>
		</td>
		<td align="center"><?php echo $extra['condicion'] ?></td>
		<td align="center"><?php echo $extra['tipoexamen'] ?></td>
		<td align="center"><?php echo $extra['tipomateria'] ?></td>
		<td align="center"><?php echo ($extra['enanalitico']==1)?"Si":"No" ?></td>
		<td align="center"><input type="text" size="2" name="obs[<?php echo $extra['idmp'] ?>]" /></td>
	</tr>
	<?php } ?>    
    <?php } ?>
    <tr>
		<td colspan="11">
    		<table width="100%" class="stats" cellspacing="0">
    			<tr>
    				<td width="25%" class="hed">Cant. Materias por Hoja:</td>
    				<td width="15%" ><INPUT type="text" name="cantmaterias" size="2" value="42"></td>
    				<td width="15%" class="hed">Promedio:</td>
    				<td width="15%" ><?php echo ($canti!=0)?number_format($promedio/$canti, 2):"0" ?></td>
    				<td width="15%" class="hed">Cant. Materias:</td>
    				<td width="15%" ><?php echo $cantidad ?></td>
    			</tr>
    		</table>		
		</td>    
    </tr>
</table>
</div>