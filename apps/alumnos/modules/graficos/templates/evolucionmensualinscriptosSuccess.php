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
    $('#seleccionar').change(function() {
        $.post("<?php echo url_for("graficos/evolucionmensualinscriptosgraf")?>", 
            $(this).serialize(),
            function(data) {
                $('#result').html(data);

            }
        );
        
        return false;
    }); 
})  
</script>
<h1>Evolución Mensual de Inscriptos</h1> 
<br>
<form method="post" action="evolucionmensualinscriptosgraf" id="form1" name="form1" >
<table cellspacing="0" class="stats" width="100%">
  <tr>
  <td width="10%"><b>Carrera:</b></td>  
  <td>
  <?php
	if (count($carreras) > 0){
		//el bucle para cargar las opciones
		echo "<select id='seleccionar' name='seleccionar' >";
		echo "<option SELECTED value=''>-----SELECCIONAR-----</option>";
	    foreach($carreras as $carrera){
	    	echo "<option value=".$carrera->getIdcarrera().">".$carrera->getNombrereducido()."</option>";
    	}
		echo "</select>";
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
    <td valign="top" class="text" align="center"><a href="../../msline.xml" target="_blank"><img src="../../fusioncharts/Gallery/Contents/Images/BtnViewXML.gif" alt="Obtener XML del grafico" width="75" height="25" border="0" /></a></td>
  </tr>
   <?php } ?>
</table>
<br />
<div id="result"></div>