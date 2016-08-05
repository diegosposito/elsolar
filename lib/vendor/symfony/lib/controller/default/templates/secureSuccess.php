<?php decorate_with(dirname(__FILE__).'/defaultLayout.php') ?>

<div class="sfTMessageContainer sfTLock"> 
  <?php echo image_tag('/sfDoctrinePlugin/images/error.png', array('alt' => 'credentials required', 'class' => 'sfTMessageIcon', 'size' => '25x25')) ?>
  <div class="sfTMessageWrap">
    <h1>Se requiere credencial</h1>
    <h5>Esta pagina esta restringida.</h5>
  </div>
</div>
<dl class="sfTMessageInfo">
  <dt>Ud. no posee suficientes permisos para acceder.</dt>
  <dd>Consulte a su administrador en caso de posible error. </dd>

  <dt>Consultar</dt>
  <dd>
    <ul class="sfTIconList">
      <li class="sfTLinkMessage"><a href="javascript:history.go(-1)">Regresar a pagina anterior</a></li>
    </ul>
  </dd>
</dl>
