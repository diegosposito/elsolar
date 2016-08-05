<h1>Comparativa de Ingresantes</h1>
<script>
	$(function() {
		$( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#datepickerii" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#datepickeriii" ).datepicker({ dateFormat: 'dd-mm-yy' });
		$( "#datepickeriv" ).datepicker({ dateFormat: 'dd-mm-yy' });
	});

	$(function() {
		$( "input:submit, a, button", ".demo" ).button();  
	});
</script>
<p><b>Seleccionar 2 per&iacute;odos a comparar</b></p>

<form method="post" action="<?php echo url_for('estadisticas/aspirantes' ) ?>" enctype="multipart/form-data">
<div class="demo">
  <table cellspacing="0" class="stats" width="100%">
    <tfoot>
      <tr>
        <td colspan="2" align="center">
			<input value="Generar resultados" type="submit">
        </td>
      </tr>
    </tfoot>
    <tbody>
      <tr>
        <td>Desde: <input id="datepicker" name="datepicker" type="text"></td>
        <td>Hasta: <input id="datepickerii" name="datepickerii" type="text"></td>
      </tr>    	
      <tr>
        <td>Desde: <input id="datepickeriii" name="datepickeriii" type="text"></td>
        <td>Hasta: <input id="datepickeriv" name="datepickeriv" type="text"></td>
      </tr>  
      <tr>
        <td colspan="2">
			<select name="idtipocarrera[]" id="idtipocarrera" MULTIPLE> 
			    <?php
			    if (count($tiposcarreras) > 0){
			      //el bucle para cargar las opciones
			      echo "<option value='0' selected='selected' >----SELECCIONAR----</option>";
			      foreach ($tiposcarreras as $carrera){
			        echo "<option value=".$carrera['idtipocarrera'].">".$carrera['nombre']."</option>";
			      }
			    }
			?> 
			</select>          
        </td>
      </tr>        
    </tbody>
  </table> 
</div>  
</form>
<br>
<?php
if(isset($resultado)){ ?>
<table cellspacing="0" class="stats" width="100%">
    <tr>
      <td colspan=3 class="hed" align="center" width="15%"></th>
      <td colspan=3 class="hed" align="center" width="9%">Aspirantes <?php echo $periodoi ?></th>
      <td colspan=3 class="hed" align="center" width="9%">Aspirantes <?php echo $periodof ?></th>  
    </tr>
    <tr>
      <td class="hed" align="center" width="15%">Facultad</th>
      <td class="hed" align="center" width="15%">Sede</th>
      <td class="hed" align="center" width="15%">Carrera</th>
      <td class="hed" align="center" width="9%">T</th>
      <td class="hed" align="center" width="8%">M</th>
      <td class="hed" align="center" width="8%">F</th>
      <td class="hed" align="center" width="9%">T</th>
      <td class="hed" align="center" width="8%">M</th>
      <td class="hed" align="center" width="8%">F</th>
    </tr>
    <?php foreach ($resultado as $data): ?>
    <tr>
      <td align="center"><?php echo $data['facultad']; ?></td>
      <td align="center"><?php echo $data['sede']; ?></td>
      <td align="center"><?php echo $data['carrera']; ?></td>
      <td align="center" class="resaltar_gris"><?php echo $data['totalprimerperiodo']; ?></td>
      <td align="center"><?php echo $data['varonesprimerperiodo']; ?></td>
      <td align="center"><?php echo $data['mujeresprimerperiodo']; ?></td>
      <td align="center" class="resaltar_amarillosolido"><?php echo $data['totalsegundoperiodo']; ?></td>
      <td align="center" class="resaltar_amarilloclaro"><?php echo $data['varonessegundoperiodo']; ?></td>
      <td align="center" class="resaltar_amarilloclaro"><?php echo $data['mujeressegundoperiodo']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php
} // end if isset ?>
</br>

<br>
<?php if(isset($rSedefacultad)){ ?>
<table cellspacing="0" class="stats" width="100%">
     <tr>
      <td colspan=2 class="hed" align="center" width="15%"></th>
      <td colspan=3 class="hed" align="center" width="9%">Aspirantes <?php echo $periodoi ?></th>
      <td colspan=3 class="hed" align="center" width="9%">Aspirantes <?php echo $periodof ?></th>  
    </tr>
    <tr>
      <td class="hed" align="center" width="15%">Facultad</th>
      <td class="hed" align="center" width="15%">Sede</th>
      <td class="hed" align="center" width="9%">T</th>
      <td class="hed" align="center" width="8%">M</th>
      <td class="hed" align="center" width="8%">F</th>
      <td class="hed" align="center" width="9%">T</th>
      <td class="hed" align="center" width="8%">M</th>
      <td class="hed" align="center" width="8%">F</th>
    </tr>
    <?php foreach ($rSedefacultad as $data): ?>
    <tr>
      <td align="center"><?php echo $data['facultad']; ?></td>
      <td align="center"><?php echo $data['sede']; ?></td>
      <td align="center" class="resaltar_gris"><?php echo $data['totalprimerperiodo']; ?></td>
      <td align="center"><?php echo $data['varonesprimerperiodo']; ?></td>
      <td align="center"><?php echo $data['mujeresprimerperiodo']; ?></td>
      <td align="center" class="resaltar_amarillosolido"><?php echo $data['totalsegundoperiodo']; ?></td>
      <td align="center" class="resaltar_amarilloclaro"><?php echo $data['varonessegundoperiodo']; ?></td>
      <td align="center" class="resaltar_amarilloclaro"><?php echo $data['mujeressegundoperiodo']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php
} // end if isset ?>

<br>
<?php if(isset($rFacultades )){ ?>
<table cellspacing="0" class="stats" width="100%">
    <tr>
      <td class="hed" align="center" width="15%"></th>
      <td colspan=3 class="hed" align="center" width="9%">Aspirantes <?php echo $periodoi ?></th>
      <td colspan=3 class="hed" align="center" width="9%">Aspirantes <?php echo $periodof ?></th>  
    </tr>
    <tr>
      <td class="hed" align="center" width="40%">Facultad</th>
      <td class="hed" align="center" width="10%">T</th>
      <td class="hed" align="center" width="10%">M</th>
      <td class="hed" align="center" width="10%">F</th>
      <td class="hed" align="center" width="10%">T</th>
      <td class="hed" align="center" width="10%">M</th>
      <td class="hed" align="center" width="10%">F</th>
    </tr>
    <?php foreach ($rFacultades as $facultad): ?>
    <tr>
      <td align="center"><?php echo $facultad['facultad']; ?></td>
      <td align="center" class="resaltar_gris"><?php echo $facultad['totalprimerperiodo']; ?></td>
      <td align="center"><?php echo $facultad['varonesprimerperiodo']; ?></td>
      <td align="center"><?php echo $facultad['mujeresprimerperiodo']; ?></td>
      <td align="center" class="resaltar_amarillosolido"><?php echo $facultad['totalsegundoperiodo']; ?></td>
      <td align="center" class="resaltar_amarilloclaro"><?php echo $facultad['varonessegundoperiodo']; ?></td>
      <td align="center" class="resaltar_amarilloclaro"><?php echo $facultad['mujeressegundoperiodo']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</br>
<?php } ?>

<?php if(isset($rSedes )){ ?>
<br>
<table cellspacing="0" class="stats" width="100%">
    <tr>
      <td class="hed" align="center" width="15%"></th>
      <td colspan=3 class="hed" align="center" width="9%">Aspirantes <?php echo $periodoi ?></th>
      <td colspan=3 class="hed" align="center" width="9%">Aspirantes <?php echo $periodof ?></th>  
    </tr>
    <tr>
      <td class="hed" align="center" width="40%">Facultad</th>
      <td class="hed" align="center" width="10%">T</th>
      <td class="hed" align="center" width="10%">M</th>
      <td class="hed" align="center" width="10%">F</th>
      <td class="hed" align="center" width="10%">T</th>
      <td class="hed" align="center" width="10%">M</th>
      <td class="hed" align="center" width="10%">F</th>
    </tr>
    <?php foreach ($rSedes as $sede): ?>
    <tr>
      <td align="center"><?php echo $sede['sede']; ?></td>
      <td align="center" class="resaltar_gris"><?php echo $sede['totalprimerperiodo']; ?></td>
      <td align="center"><?php echo $sede['varonesprimerperiodo']; ?></td>
      <td align="center"><?php echo $sede['mujeresprimerperiodo']; ?></td>
      <td align="center" class="resaltar_amarillosolido"><?php echo $sede['totalsegundoperiodo']; ?></td>
      <td align="center" class="resaltar_amarilloclaro"><?php echo $sede['varonessegundoperiodo']; ?></td>
      <td align="center" class="resaltar_amarilloclaro"><?php echo $sede['mujeressegundoperiodo']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</br>
<?php } ?>
<?php if(isset($rTotales )){ ?>
<br>
<table cellspacing="0" class="stats" width="100%">
    <tr>
      <td class="hed" align="center" width="15%">Totales</th>
      <td colspan=3 class="hed" align="center" width="9%">Aspirantes <?php echo $periodoi ?></th>
      <td colspan=3 class="hed" align="center" width="9%">Aspirantes <?php echo $periodof ?></th>  
    </tr>
    <tr>
      <td class="hed" align="center" width="40%">Totales</th>
      <td class="hed" align="center" width="10%">T</th>
      <td class="hed" align="center" width="10%">M</th>
      <td class="hed" align="center" width="10%">F</th>
      <td class="hed" align="center" width="10%">T</th>
      <td class="hed" align="center" width="10%">M</th>
      <td class="hed" align="center" width="10%">F</th>
    </tr>
    <?php foreach ($rTotales as $total): ?>
    <tr>
      <td align="center"><?php echo $total['total']; ?></td>
      <td align="center" class="resaltar_gris"><?php echo $total['totalprimerperiodo']; ?></td>
      <td align="center"><?php echo $total['varonesprimerperiodo']; ?></td>
      <td align="center"><?php echo $total['mujeresprimerperiodo']; ?></td>
      <td align="center" class="resaltar_amarillosolido"><?php echo $total['totalsegundoperiodo']; ?></td>
      <td align="center" class="resaltar_amarilloclaro"><?php echo $total['varonessegundoperiodo']; ?></td>
      <td align="center" class="resaltar_amarilloclaro"><?php echo $total['mujeressegundoperiodo']; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
</br>
<?php } ?>