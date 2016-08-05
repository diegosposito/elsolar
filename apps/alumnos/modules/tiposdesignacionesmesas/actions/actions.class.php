<?php

/**
 * tiposdesignacionesmesas actions.
 *
 * @package    sig
 * @subpackage tiposdesignacionesmesas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class tiposdesignacionesmesasActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->tipos_designaciones_mesass = Doctrine_Core::getTable('TiposDesignacionesMesas')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new TiposDesignacionesMesasForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new TiposDesignacionesMesasForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($tipos_designaciones_mesas = Doctrine_Core::getTable('TiposDesignacionesMesas')->find(array($request->getParameter('idtipodesignacionmesa'))), sprintf('Object tipos_designaciones_mesas does not exist (%s).', $request->getParameter('idtipodesignacionmesa')));
    $this->form = new TiposDesignacionesMesasForm($tipos_designaciones_mesas);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($tipos_designaciones_mesas = Doctrine_Core::getTable('TiposDesignacionesMesas')->find(array($request->getParameter('idtipodesignacionmesa'))), sprintf('Object tipos_designaciones_mesas does not exist (%s).', $request->getParameter('idtipodesignacionmesa')));
    $this->form = new TiposDesignacionesMesasForm($tipos_designaciones_mesas);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($tipos_designaciones_mesas = Doctrine_Core::getTable('TiposDesignacionesMesas')->find(array($request->getParameter('idtipodesignacionmesa'))), sprintf('Object tipos_designaciones_mesas does not exist (%s).', $request->getParameter('idtipodesignacionmesa')));
    $tipos_designaciones_mesas->delete();

    $this->redirect('tiposdesignacionesmesas/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $tipos_designaciones_mesas = $form->save();

      $this->redirect('tiposdesignacionesmesas/edit?idtipodesignacionmesa='.$tipos_designaciones_mesas->getIdtipodesignacionmesa());
    }
  }
}
