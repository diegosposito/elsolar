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
       
    $('#seleccionar2').change(function() {
        $.post("<?php echo url_for("graficos/nifranjaetareaxcarreragraf")?>", 
            $(this).serialize(),
            function(data) {
                $('#result').html(data);

            }
        );
        
        return false;
    }); 
})  


</script>
<h1>Evolución Nuevos Inscriptos por Centro Regional</h1> 
<br>
<form method="post" action="nifranjaetareaxcarreragraf" id="nifranjaetareaxcarreragraf" name="nifranjaetareaxcarreragraf" >
<table cellspacing="0" class="stats" width="100%">
  <tr>
  <td width="10%"><b>Seleccionar Año:</b></td>
  <td>
  <?php
    //el bucle para cargar las opciones
    echo "<select id='seleccionar' name='seleccionar' >";
    
    foreach ($anios as $k => $v){
      echo "<option value=".$k.">".$v."</option>";
    }
    echo "</select>";
  ?>
  </td>
  </tr>
  <tr>
  <td width="10%"><b>Estado:</b></td>
  <td>
  <?php
    //el bucle para cargar las opciones
    echo "<select id='seleccionar2' name='seleccionar2' >";
    echo "<option SELECTED value=''>-----SELECCIONAR-----</option>";
    foreach ($estados as $k => $v){
      echo "<option value=".$k.">".$v."</option>";
    }
    echo "</select>";
  ?>
  </td>
  </tr>
  <?php 
  if ($_POST) { ?>
  <tr>
    <td valign="top" class="text" align="center">&nbsp;</td>
  </tr>
  <tr> 
    <td valign="top" class="text" align="center"><a href="../../nifranjaetarea.xml.xml" target="_blank"><img src="../../fusioncharts/Gallery/Contents/Images/BtnViewXML.gif" alt="Obtener XML del grafico" width="75" height="25" border="0" /></a></td>
  </tr>
   <?php } ?>
</table>
<div id="result"></div>