<br>
<h1>Listado de Profesores</h1>
<br><br>
  <a href="<?php echo url_for('profesores/new') ?>">(+) Agregar nuevos profesores</a>
  <br><br>
  <a href="<?php echo url_for('profesores/buscar') ?>">(+) Vincular Personas a profesores</a>
  <br><br>

<table cellspacing="0" class="stats" width="100%">
    <tr>
      <td class="hed" align="center" width="5%">Id</th>
      <td class="hed" align="center" width="40%">Apellido</th>
      <td class="hed" align="center" width="30%">Nombre</th>
      <td class="hed" align="center" width="15%">Nro.Doc.</th>
      <td class="hed" align="center" width="5%">Fecha Ingreso</th>
      <td class="hed" align="center" width="5%">Acciones</th>  
    </tr>
    <?php foreach ($pager->getResults() as $persona): ?>
    <tr>
      <td align="center"><?php echo $persona->getIdPersona(); ?></td>
      <td align="left"><?php echo $persona->getApellido(); ?></td>
      <td align="left"><?php echo $persona->getNombre(); ?></td>
      <td align="center"><?php echo $persona->getNrodoc(); ?></td>
      <td align="center"><?php echo $persona->getFechaingreso(); ?></td>
      <td align="center"><?php echo link_to("Editar", 'profesores/show?idpersona='.$persona->getIdPersona(),'class="mhead"'); ?></td>
    </tr>
    <?php endforeach; ?>
</table>


<?php if ($pager->haveToPaginate())  { ?>

<div id="navv">

<?php echo link_to('Primeras ', 'profesores/index?page='.$pager->getFirstPage(),'class="pager"') ?>
<?php echo link_to('Anterior ', 'profesores/index?page='.$pager->getPreviousPage(),'class="pager"' ) ?>
<?php $links = $pager->getLinks(); foreach ($links as $page): ?>
<?php echo ($page == $pager->getPage()) ? $page : link_to($page, 'profesores/index?page='.$page,'class="pager"') ;?>
<?php if ($page != $pager->getCurrentMaxLink()): ?> <?php endif ?>
<?php endforeach ?>
<?php echo link_to(' Siguiente ', 'profesores/index?page='.$pager->getNextPage(),'class="pager"') ?>
<?php echo link_to('Ultimas ', 'profesores/index?page='.$pager->getLastPage(),'class="pager"') ?>
<?php } ?></div>
 
<?php  //echo pager_navigation( $pager, url_for( 'module/action?'.html_entity_decode($queryString) , true ) ); ?>


    <? /*php foreach ($personass as $personas): ?>
    <tr>
      <td><a href="<?php echo url_for('profesores/show?idpersona='.$personas->getIdpersona()) ?>"><?php echo $personas->getIdpersona() ?></a></td>
      <td><?php echo $personas->getNombre() ?></td>
      <td><?php echo $personas->getApellido() ?></td>
      <td><?php echo $personas->getSexo() ?></td>
      <td><?php echo $personas->getIdtipodoc() ?></td>
      <td><?php echo $personas->getNrodoc() ?></td>
      <td><?php echo $personas->getNumerodoc() ?></td>
      <td><?php echo $personas->getFechanac() ?></td>
      <td><?php echo $personas->getFechaingreso() ?></td>
      <td><?php echo $personas->getIdciudadnac() ?></td>
      <td><?php echo $personas->getIdnacionalidad() ?></td>
      <td><?php echo $personas->getEstadocivil() ?></td>
      <td><?php echo $personas->getCreatedAt() ?></td>
      <td><?php echo $personas->getUpdatedAt() ?></td>
      <td><?php echo $personas->getCreatedBy() ?></td>
      <td><?php echo $personas->getUpdatedBy() ?></td>
    </tr>
    <?php endforeach; */?>
  
  <br><br>
  <a href="<?php echo url_for('profesores/new') ?>">(+) Agregar nuevos profesores</a>
  <br><br>
    <a href="<?php echo url_for('profesores/buscar') ?>">(+) Vincular Personas a profesores</a>
  <br><br>