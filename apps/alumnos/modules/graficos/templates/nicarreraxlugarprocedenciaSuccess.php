<link rel="stylesheet" href="../../fusioncharts/Contents/Style1.css" type="text/css" />
<script language="JavaScript" src="../../fusioncharts/JSClass/FusionCharts.js"></script>
<script language="javascript">
$(document).ready(function() {
    $().ajaxStart(function() {
        $('#loading').show();
        $('#result').hide();
    }).ajaxStop(function() {
        $('#loading').hide();
        $('#result').fadeIn('slow');
    });
    $('#carrerasxsede').attr('disabled',true);	

    $('#seleccionar').change(function(){
        // cargar las ciudades de la carrera al combo
        cargarComboCarreras('#carrerasxsede', $(this).val(), 0);
    });	

    $('#carrerasxsede').change(function() {
        $.post("<?php echo url_for("graficos/nicarreraxlugarprocedenciagraf")?>", 
            $(this).serialize(),
            function(data) {
                $('#result').html(data);

            }
        );
        
        return false;
    }); 
})  

//Cargar combo de ciudades
function cargarComboCarreras(combo, id, idseleccionado){
    // cargar las ciudades de la carrera al combo
    $('#carrerasxsede').attr('disabled',false);	
    $.post("<?php echo url_for('areas/obtenercarrerasxsede'); ?>",
		{ idarea: id },
		function(data){
			if (data){
				$(combo).html(data);
				$(combo).attr('disabled',false);
				$(combo).val(idseleccionado);	    	    	
			}else{
				$(combo).attr('disabled',true);
				$(combo).html("<option value='0' selected='selected' >----NINGUNA----</option>");
			}
		}
	);
} 
</script>
<h1>Evolución Nuevos Inscriptos por Centro Regional</h1> 
<br>
<form method="post" action="nicarreraxlugarprocedenciagraf" id="nicarreraxlugarprocedenciagraf" name="nicarreraxlugarprocedenciagraf" >
<table cellspacing="0" class="stats" width="100%">
  <tr>
  <td width="15%"><b>Centro Regional:</b></td>
  <td>
  <?php
	if (count($areas) > 0){
		//el bucle para cargar las opciones
		echo "<select id='seleccionar' name='seleccionar' >";
		echo "<option SELECTED value=''>-----SELECCIONAR-----</option>";
		foreach ($areas as $area){
			echo "<option value=".$area["idarea"].">".$area["descripcion"]."</option>";
		}
		echo "</select>";
	}
	?>
  </td>
  </tr>
  <tr>
  <td><b>Carrera:</b></td>
  <td>
  <?php
	if (count($areas) > 0){	
		echo "<select id='carrerasxsede' name='carrerasxsede' >";
		echo "<option SELECTED value=''>-----SELECCIONAR-----</option>";
		echo "</select>";
		echo "<br><br>";
	}
	?>
  </td>
  </tr>  
  <?php 
  if ($_POST) { ?>
  <tr>
    <td valign="top" class="text" align="center">&nbsp;</td>
  </tr>
  <tr> 
    <td valign="top" class="text" align="center"><a href="../../nixsedesgraf.xml" target="_blank"><img src="../../fusioncharts/Gallery/Contents/Images/BtnViewXML.gif" alt="Obtener XML del grafico" width="75" height="25" border="0" /></a></td>
  </tr>
   <?php } ?>
</table>
<div id="result"></div>