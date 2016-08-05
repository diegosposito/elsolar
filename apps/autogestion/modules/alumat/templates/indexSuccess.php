<script>
$(document).ready(function(){
	$(".botonInfo").click(function(){
		var elemento = $(this);
		var Id = elemento.attr("id");			
    	// Solicita info
    	$.post("<?php echo url_for('alumat/info'); ?>",
    			{ idalumat: Id },
    	    function(data){
        	   	alert(data);   	     	    	
        	}
		);
		return false;
	});
}); 
</script>
<br>
<table width="100%" class="tabla_buscador">
	<tr align='center'>
	<td >
	<h1>Historial Académico</h1>
	</td>
	</tr>
</table>
<br>
<table width="100%" class="stats" cellspacing="0">
    <tr>
		<td class="hed" align="center" width="55%">Materia</td>
		<td class="hed" align="center" width="15%">Fecha</td>
		<td class="hed" align="center" width="20%">Fecha de Vencimiento</td>
		<td class="hed" align="center" width="10%">Estado</td>
    </tr>
    <?php 
    $i=0; 
	$cursoactual=0;
	$estadoactual=0;
	$arregloMateriasAprobadas = array();
	foreach ($alu_mats as $alu_mat):
		if ($estadoactual!=$alu_mat->getIdestadomateria()) {
			$estadoactual=$alu_mat->getIdestadomateria();
	?>
	<tr>
		<td align="center" bgcolor='#666' colspan=4 width="70%">ESTADO: <?php echo strtoupper($alu_mat->getEstadosMateria()); ?></td>
	</tr>
	<?php
		}
		
		if ($cursoactual!=$alu_mat->getCatedras()->getMateriasPlanes()->getAnodecursada()) {
			$cursoactual=$alu_mat->getCatedras()->getMateriasPlanes()->getAnodecursada();
	?>
	<tr>
		<td class="hed" align="center" colspan=4>CURSO: <?php echo $cursoactual; ?></td>
	</tr>
	<?php
		}
    ?>
    <tr class="fila_<?php echo $alu_mat->getIdestadomateria() ; ?>">
	<?php
		if($alu_mat->getIdestadomateria()==9) {
			array_push($arregloMateriasAprobadas,$alu_mat->getIdCatedra());
		}
		if(!in_array($alu_mat->getIdCatedra(),$arregloMateriasAprobadas) or ($alu_mat->getIdestadomateria()==9)) {
	?>
	<tr class="fila_<?php echo $i%2 ; ?>">    
		<td width="45%"><?php echo $alu_mat->getCatedras()->getMateriasPlanes()." (".$alu_mat->getCatedras()->getIdmateriaplan().")" ?></td>
	<?php 
			$fechaActual = date('Y-m-d');
			$fechaVence = date("Y-m-d", strtotime($alu_mat->getFechavencimiento()));
			
			if (($fechaActual > $fechaVence) and ($alu_mat->getIdestadomateria()==3)) {
				$color = "red"; 
			} else {
				$color = "black";
			}
			$arr = explode('-', $alu_mat->getFecha());
			$fechaRegistro = $arr[2]."-".$arr[1]."-".$arr[0];
			
			$arr = explode('-', $alu_mat->getFechavencimiento());
			$fechaVencimiento = $arr[2]."-".$arr[1]."-".$arr[0];
	?>
		<td width="15%" align="center" colspan=1><?php echo $fechaRegistro ?></td>
		<td width="15%" align="center" colspan=1><font color="<?php echo $color ?>"><?php if($alu_mat->getIdestadomateria()==3) echo $fechaVencimiento ?></font></td>
		<td width="20%" align="center"><?php echo $alu_mat->getEstadosMateria(); ?></td>
	<?php 
		} // fin de control de aprobada
	?>
    </tr>
    <?php 
		$i++;
    endforeach; 
    ?>
	<tr class="fila_importante">
		<td colspan="4"><strong>Los datos mostrados en esta pantalla pueden estar expresados en forma parcial sujetas a resoluciones que pueden ivalidarlas o habilitar en caso de que el sector administrativo lo especifique. La validéz de los certificados analíticos estará dado desde las secretarías con firma y sello de la Facultad que lo emite. Lo expresado en este módulo es una referencia para el alumno con el mero fin de saber su situación presente.</strong> </td>
	</tr>
</table>