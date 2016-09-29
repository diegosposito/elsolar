<?php

/**
 * horarios actions.
 *
 * @package    sig
 * @subpackage horarios
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class horariosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->horarioss = Doctrine_Core::getTable('Horarios')
      ->createQuery('a')
      ->where('a.anulado = false')
      ->execute();
  }

  public function executeIngresar(sfWebRequest $request)
  {
  }

  public function executeRegistro(sfWebRequest $request)
  {
    if ($request->isMethod(sfRequest::POST)){
       
        $persona = Doctrine_Core::getTable('Personas')->obtenerPersonaxnrodoc($request->getParameter('display')); 
        $oPersona = Doctrine_Core::getTable('Personas')->find($persona[0]['idpersona']);

        if (trim($persona[0]['idpersona'])==''){
            $this->msgError = "Registro no válido, intente nuevamente!!";
        } else {
           
            $oHorario = new Horarios();
            $oHorario->setIdpersona($oPersona->getIdpersona());
            $oHorario->setAnulado(false);
            $oHorario->setTiporegistro(Doctrine_Core::getTable('Horarios')->obtenerProximoEstado($oPersona->getIdpersona()));
            $oHorario->setObservaciones('');
            $oHorario->save();

            $this->msgSuccess = "Registro ingresado correctamente!!";
        }  
    } 

    // Obtener ultimos 50 registros
    $this->horarioss = Doctrine_Core::getTable('Horarios')
      ->createQuery('a')
      ->where('a.anulado = false')
      ->orderBy('a.id DESC limit 50 ')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->horarios = Doctrine_Core::getTable('Horarios')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->horarios);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new HorariosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new HorariosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($horarios = Doctrine_Core::getTable('Horarios')->find(array($request->getParameter('id'))), sprintf('Object horarios does not exist (%s).', $request->getParameter('id')));
    $this->form = new HorariosForm($horarios);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($horarios = Doctrine_Core::getTable('Horarios')->find(array($request->getParameter('id'))), sprintf('Object horarios does not exist (%s).', $request->getParameter('id')));
    $this->form = new HorariosForm($horarios);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($horarios = Doctrine_Core::getTable('Horarios')->find(array($request->getParameter('id'))), sprintf('Object horarios does not exist (%s).', $request->getParameter('id')));
    $horarios->delete();

    $this->redirect('horarios/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $horarios = $form->save();

      $this->redirect('horarios/edit?id='.$horarios->getId());
    }
  }
}
