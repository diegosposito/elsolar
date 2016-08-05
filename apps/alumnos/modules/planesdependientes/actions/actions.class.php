<?php

/**
 * planesdependientes actions.
 *
 * @package    sig
 * @subpackage planesdependientes
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class planesdependientesActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->planes_dependientess = Doctrine_Core::getTable('PlanesDependientes')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new PlanesDependientesForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new PlanesDependientesForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($planes_dependientes = Doctrine_Core::getTable('PlanesDependientes')->find(array($request->getParameter('idgrupo'))), sprintf('Object planes_dependientes does not exist (%s).', $request->getParameter('idgrupo')));
    $this->form = new PlanesDependientesForm($planes_dependientes);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($planes_dependientes = Doctrine_Core::getTable('PlanesDependientes')->find(array($request->getParameter('idgrupo'))), sprintf('Object planes_dependientes does not exist (%s).', $request->getParameter('idgrupo')));
    $this->form = new PlanesDependientesForm($planes_dependientes);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($planes_dependientes = Doctrine_Core::getTable('PlanesDependientes')->find(array($request->getParameter('idgrupo'))), sprintf('Object planes_dependientes does not exist (%s).', $request->getParameter('idgrupo')));
    $planes_dependientes->delete();

    $this->redirect('planesdependientes/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $planes_dependientes = $form->save();

      $this->redirect('planesdependientes/edit?idgrupo='.$planes_dependientes->getIdgrupo());
    }
  }
}
