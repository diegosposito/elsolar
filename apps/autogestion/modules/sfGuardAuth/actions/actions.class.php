<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

//require_once(dirname(__FILE__).'/../lib/BasesfGuardAuthActions.class.php');
require_once(sfConfig::get('sf_plugins_dir').'/sfDoctrineGuardPlugin/modules/sfGuardAuth/lib/BasesfGuardAuthActions.class.php');

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 23319 2009-10-25 12:22:23Z Kris.Wallsmith $
 */
class sfGuardAuthActions extends BasesfGuardAuthActions
{

        public function executeSignin($request) {
                // redirecciona al metodo signin del plugin
                $user = $this->getUser();
                                
            if ($user->isAuthenticated()) {
                return $this->redirect('ingreso/index');
            }
                                        
            $class = sfConfig::get('app_sf_guard_plugin_signin_form', 'sfGuardFormSignin');
            $this->form = new $class();
            
            if ($request->isMethod('post')) {
                        $this->form->bind($request->getParameter('signin'));

                        if ($this->form->isValid()) {
                        $values = $this->form->getValues();
                                $lastlogin = $values['user']->getLastLogin();
                        $user->signin($values['user'], array_key_exists('remember', $values) ? $values['remember'] : false);

                                // Verificar informacion del alumno en sistema de alumnos
                                if($user->hasCredential('alumno')) {
                                $signinUrl = sfConfig::get('app_sf_guard_plugin_success_signin_url', $user->getReferer($request->getReferer()));

 
                                } // end if($user->hasCredential('alumno')) {
                        

                        } // end if($this->form->isValid())
            } else {
                        if ($request->isXmlHttpRequest()) {
                        $this->getResponse()->setHeaderOnly(true);
                        $this->getResponse()->setStatusCode(401);
                
                                return sfView::NONE;
                } // end if($request->isXmlHttpRequest())
                        
                        // if we have been forwarded, then the referer is the current URL
                        // if not, this is the referer of the current request
 
                        $user->setReferer($this->getContext()->getActionStack()->getSize() > 1 ? $request->getUri() : $request->getReferer());
                        $module = sfConfig::get('sf_login_module');
                        if ($this->getModuleName() != $module) {
                                return $this->redirect($module.'/'.sfConfig::get('sf_login_action'));
                        } // end if($this->getModuleName() != $module)
                        $this->getResponse()->setStatusCode(401);
                } // end if($request->isMethod('post'))

                if ($request->isMethod('post')) {
                        if (!$user->isAuthenticated()) {
                                $this->redirect('ingreso/error?msgerror='."El usuario no pudo ser autenticado para ingresar al sistema.");
                        } else {
                                if(!$lastlogin){
                                        $this->redirect('personas/modificardatospersonales');
                                } else {
                                        $this->redirect('ingreso/index');
                                }
                        } // end if(!$user->isAuthenticated())
                } // end if($request->isMethod('post'))
        }

	
  public function executeSignout($request)
  {
    $this->getUser()->signOut();

    $this->redirect('@homepage');
  }		
}
