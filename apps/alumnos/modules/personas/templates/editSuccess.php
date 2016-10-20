<style>
table {
    border-spacing: 0.5rem;
    border-collapse: separate;
    border-spacing: 8px;
    border-color: gray;
    margin: 0px auto;

}
</style>
<br>
<p style="align:center;color:#000000;font-weight: bold;"><font size="5px">Personal</font><font size="3px"> &nbsp;->&nbsp;&nbsp;&nbsp;&nbsp;Editar información</font></p> 
<br>
<a href="<?php echo url_for('personas/buscar') ?>">Salir sin guardar</a>
<?php include_partial('form', array('form' => $form)) ?>
