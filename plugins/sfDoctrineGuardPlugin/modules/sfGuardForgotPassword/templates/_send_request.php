<?php use_helper('I18N') ?>
<?php echo __('Hola %first_name%', array('%first_name%' => $user->getFirstName()), 'sf_guard') ?>,<br/><br/>

<?php echo __('Este E-Mail fue enviado desde el Sistema de Autogestión Alumnos de la Universidad de Concepción del Uruguay, para que puedas recuperar tu clave de acceso.', null, 'sf_guard') ?><br/><br/>

<?php echo __('Recuperá tu clave de acceso , picando antes de las 24 de recibido este E-Mail, en el link siguiente:', null, 'sf_guard') ?><br/><br/>

<?php echo link_to(__('Picar aqui para cambiar la clave de acceso', null, 'sf_guard'), '@sf_guard_forgot_password_change?unique_key='.$forgot_password->unique_key, 'absolute=true') ?>
