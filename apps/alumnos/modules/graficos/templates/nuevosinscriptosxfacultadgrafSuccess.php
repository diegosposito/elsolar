<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Evolucion Nuevos Inscriptos</title>
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
        $.post("<?php echo url_for("graficos/nuevosinscriptosgraf")?>", 
            $(this).serialize(),
            function(data) {
                $('#result').html(data);

            }
        );
        
        return false;
    }); 
})  
</script>
</head>

<body>
<form method="post" action="nuevosinscriptosgraf" id="form1" name="form1" >
<br>
<table width="98%" border="0" cellspacing="0" cellpadding="3" align="center">
  <tr>
   <td valign="top" class="text" align="center"> 
       <div id="chartdiv" align="center">  Evolucion Nuevos Inscriptos por Facultad. </div>
      <script type="text/javascript">
		   var chart = new FusionCharts("../../fusioncharts/Charts/MSColumn3D.swf", "ChartId", "600", "350", "0", "0");
		   chart.setDataURL("../../nifacultadperiodos.xml");		   
		   chart.render("chartdiv");
		</script> </td>
  </tr>
  <?php 
  if ($_POST) { ?>
  <tr>
    <td valign="top" class="text" align="center">&nbsp;</td>
  </tr>
  <tr> 
    <td valign="top" class="text" align="center"><a href="../../nifacultadperiodos.xml" target="_blank"><img src="../../fusioncharts/Gallery/Contents/Images/BtnViewXML.gif" alt="Obtener XML del grafico" width="75" height="25" border="0" /></a></td>
  </tr>
   <?php } ?>
</table>
</body>
<div id="result"></div>
</html>