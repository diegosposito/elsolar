<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Evolucion Nuevos Inscriptos por Centro Regional</title>
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
        $.post("<?php echo url_for("noticias/vernoticiaspublicadas")?>", 
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
</head>

<body>
<form method="post" action="vernoticias" id="vernoticias" name="vernoticias" >
<br>
<table width="98%" border="0" cellspacing="0" cellpadding="3" align="center">
  <tr>
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
		echo "<br><br>";
		
		echo "<select id='carrerasxsede' name='carrerasxsede' >";
		echo "<option SELECTED value=''>-----SELECCIONAR-----</option>";
		echo "</select>";
		echo "<br><br>";
	}
	?>
  </td>
  </tr>


</table>
</body>
<div id="result"></div>
</html>
