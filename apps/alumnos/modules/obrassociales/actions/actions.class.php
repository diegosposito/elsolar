<?php

/**
 * obrassociales actions.
 *
 * @package    sig
 * @subpackage obrassociales
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class obrassocialesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->obras_socialess = Doctrine_Core::getTable('ObrasSociales')
      ->createQuery('a')
      ->execute();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->obras_sociales = Doctrine_Core::getTable('ObrasSociales')->find(array($request->getParameter('idobrasocial')));
    $this->forward404Unless($this->obras_sociales);
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new ObrasSocialesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new ObrasSocialesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($obras_sociales = Doctrine_Core::getTable('ObrasSociales')->find(array($request->getParameter('idobrasocial'))), sprintf('Object obras_sociales does not exist (%s).', $request->getParameter('idobrasocial')));
    $this->form = new ObrasSocialesForm($obras_sociales);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($obras_sociales = Doctrine_Core::getTable('ObrasSociales')->find(array($request->getParameter('idobrasocial'))), sprintf('Object obras_sociales does not exist (%s).', $request->getParameter('idobrasocial')));
    $this->form = new ObrasSocialesForm($obras_sociales);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($obras_sociales = Doctrine_Core::getTable('ObrasSociales')->find(array($request->getParameter('idobrasocial'))), sprintf('Object obras_sociales does not exist (%s).', $request->getParameter('idobrasocial')));
    $obras_sociales->delete();

    $this->redirect('obrassociales/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $obras_sociales = $form->save();

      $this->redirect('obrassociales/edit?idobrasocial='.$obras_sociales->getIdobrasocial());
    }
  }
}
