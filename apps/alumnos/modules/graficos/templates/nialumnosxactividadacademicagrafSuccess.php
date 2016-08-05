<script type="text/javascript">
function mostrarocultar (obj)
{
  if(document.getElementById(obj).style.display=='none')
  {
                document.getElementById(obj).style.display='';
       }else{
    document.getElementById(obj).style.display='none';
  }

}
</script>

   <tr> 
    <td valign="top" class="text" align="center"> 
       <div id="chartdiv" align="center">  Graficos. </div>
      <script type="text/javascript">
       var chart = new FusionCharts("../../fusioncharts/Charts/MSLine.swf", "ChartId", "700", "500", "0", "0");
       chart.setDataURL("../../msline2.xml");       
       chart.render("chartdiv");
    </script> </td>
</div>
  </tr>

  <tr>
    <td valign="top" class="text" align="center">&nbsp;</td>
  </tr>
 
<tr><td>
<table cellspacing="0" class="stats" width="100%">
    <tr>
      <td class="hed" align="center" width="40%">Sede</th>
      <td class="hed" align="center" width="20%">Cantidad de C. del Uruguay</th>
      <td class="hed" align="center" width="20%">Otras Ciudades</th>
      <td class="hed" align="center" width="20%">Sin Información</th>
      <td class="hed" align="center" width="20%">Total</th>
    </tr>
    <?php foreach ($resultadosc as $data): ?>
    <tr>
      <td align="center"><?php echo $data['Sede']; ?></td>
      <td align="center"><?php echo $data['soloconcepcion']; ?></td>
      <td align="center"><?php echo $data['distintoconcepcion']; ?></td>
      <td align="center"><?php echo $data['sininformacion']; ?></td>
      <td align="center"><?php echo $data['hastadiciembre']; ?></td>
    </tr>
    <?php endforeach;  ?>
</table>
</td></tr>

<tr>
    <td valign="top" class="text" align="center">&nbsp;</td>
  </tr> 
<div><p><a href="javascript:mostrarocultar('idfilter2');">Agrupado por Facultad +</a></p></div>  
<div id="idfilter2" style="display:none;">   
<tr><td>
<table cellspacing="0" class="stats" width="100%">
    <tr>
      <td class="hed" align="center" width="40%">Sede</th>
      <td class="hed" align="center" width="30%">Facultad</th>
      <td colspan="3"  class="hed" align="center" width="30%">Total</th>
    </tr>
    <tr>
      <td class="hed" align="center" width="40%"></th>
      <td class="hed" align="center" width="30%"></th>
      <td class="hed" align="center" width="10%">T</th>
      <td class="hed" align="center" width="10%">M</th>
      <td class="hed" align="center" width="10%">F</th>
    </tr>
    <?php foreach ($resultadostotaf as $data): ?>
    <tr>
      <td align="center"><?php echo $data['Sede']; ?></td>
      <td align="center"><?php echo $data['facultad']; ?></td>
      <td align="center"><?php echo $data['cantidad']; ?></td>
      <td align="center"><?php echo $data['totalm']; ?></td>
      <td align="center"><?php echo $data['totalf']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</td></tr>
</div>

 <tr>
    <td valign="top" class="text" align="center">&nbsp;</td>
  </tr> 
<div><p><a href="javascript:mostrarocultar('idfilter3');">Agrupado por Carrera +</a></p></div>  
<div id="idfilter3" style="display:none;"> 
<tr><td> 
<table cellspacing="0" class="stats" width="100%">
    <tr>
      <td class="hed" align="center" width="40%">Sede</th>
      <td class="hed" align="center" width="20%">Carrera</th>
      <td colspan="3"  class="hed" align="center" width="20%">Total</th>
    </tr>
    <tr>
      <td class="hed" align="center" width="40%"></th>
      <td class="hed" align="center" width="30%"></th>
      <td class="hed" align="center" width="10%">T</th>
      <td class="hed" align="center" width="10%">M</th>
      <td class="hed" align="center" width="10%">F</th>
    </tr>
    <?php foreach ($resultadostot as $data): ?>
    <tr>
      <td align="center"><?php echo $data['Sede']; ?></td>
      <td align="center"><?php echo $data['carrera']; ?></td>
      <td align="center"><?php echo $data['cantidad']; ?></td>
      <td align="center"><?php echo $data['totalm']; ?></td>
      <td align="center"><?php echo $data['totalf']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</td></tr>
</div>
  <tr>
    <td valign="top" class="text" align="center">&nbsp;</td>
  </tr>

