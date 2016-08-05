<?php if (count($resultado) > 0){ ?>              
  <table cellspacing="0" class="stats">
      <tr>
        <td colspan="4" width="100%"><b>Se han encontrado <?php echo count($resultado); ?> nuevas designaciones.</b></td>
      </tr>
      <tr>
        <td width="10%" align="center" class="hed">Sede</td>
        <td width="15%" align="center" class="hed">Carrera-Plan</td>
        <td width="15%" align="center" class="hed">Profesor</td>
        <td width="15%" align="center" class="hed">Materia</td>
        <td width="9%" align="center" class="hed">Tipo</td>
        <td width="8%" align="center" class="hed">Categoría</td>
        <td width="9%" align="center" class="hed">Inicio</td>
        <td width="9%" align="center" class="hed">Fin</td>
        <td width="5%" align="center" class="hed">Dedicaci&oacuten</td>
    </tr>
    </thead>
    <tbody>
      <?php foreach($resultado as $item){ ?>
      <tr>
        <td width="10%"><?php echo $item['sedeabreviada'] ?></td>
        <td width="15%"><?php echo $item['carreraplan'] ?></td>
        <td width="13%"><?php echo $item['persona'] ?></td>
        <td width="13%"><?php echo $item['materia'] ?></td>
        <td width="9%"><?php echo $item['tipodesignacion'] ?></td>
        <td width="8%"><?php echo $item['categoria'] ?></td>
        <td width="9%"><?php echo $item['inicioformat'] ?></td>
        <td width="9%"><?php echo $item['finformat'] ?></td>
        <td width="5%"><?php echo $item['dedicacion'] ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
<?php } ?>  