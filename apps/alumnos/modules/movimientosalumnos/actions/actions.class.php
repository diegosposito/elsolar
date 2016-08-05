<?php

/**
 * movimientosalumnos actions.
 *
 * @package    sig
 * @subpackage movimientosalumnos
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class movimientosalumnosActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->movimientos_alumnoss = Doctrine_Core::getTable('MovimientosAlumnos')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MovimientosAlumnosForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MovimientosAlumnosForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($movimientos_alumnos = Doctrine_Core::getTable('MovimientosAlumnos')->find(array($request->getParameter('idmovimiento'))), sprintf('Object movimientos_alumnos does not exist (%s).', $request->getParameter('idmovimiento')));
    $this->form = new MovimientosAlumnosForm($movimientos_alumnos);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($movimientos_alumnos = Doctrine_Core::getTable('MovimientosAlumnos')->find(array($request->getParameter('idmovimiento'))), sprintf('Object movimientos_alumnos does not exist (%s).', $request->getParameter('idmovimiento')));
    $this->form = new MovimientosAlumnosForm($movimientos_alumnos);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($movimientos_alumnos = Doctrine_Core::getTable('MovimientosAlumnos')->find(array($request->getParameter('idmovimiento'))), sprintf('Object movimientos_alumnos does not exist (%s).', $request->getParameter('idmovimiento')));
    $movimientos_alumnos->delete();

    $this->redirect('movimientosalumnos/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $movimientos_alumnos = $form->save();

      $this->redirect('movimientosalumnos/edit?idmovimiento='.$movimientos_alumnos->getIdmovimiento());
    }
  }
}
