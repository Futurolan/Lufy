<?php
/**
 * Base actions for the sfGuardForgotPasswordPlugin sfGuardForgotPassword module.
 *
 * @package sfGuardForgotPasswordPlugin
 * @subpackage sfGuardForgotPassword
 * @author Your name here
 * @version SVN: $Id: BaseActions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */

abstract class BasesfGuardForgotPasswordActions extends sfActions {
  public function preExecute()
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->redirect('@homepage');
    }
  }
  public function executeIndex($request)
  {
    $this->form = new sfGuardRequestForgotPasswordForm();
    
    ProjectConfiguration::getActive()->loadHelpers('I18N');
    
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->user = $this->form->user;
        $this->_deleteOldUserForgotPasswordRecords();
        $forgotPassword = new sfGuardForgotPassword();
        $forgotPassword->user_id = $this->form->user->id;
        $forgotPassword->unique_key = md5(rand() + time());
        $forgotPassword->expires_at = new Doctrine_Expression('NOW()');
        $forgotPassword->save();
        $message = Swift_Message::newInstance()
          ->setFrom(sfConfig::get('app_sfGuardPlugin_defaultFromEmail', 'noreply@futurolan.net'))
          ->setTo($this->form->user->email_address)
          ->setSubject(__('Forgot Password Request for %username%', array('%username%' => $this->form->user->username), 'sf_guard'))
          ->setBody($this->getPartial('sfGuardForgotPassword/send_request', array('user' => $this->form->user, 'forgot_password' => $forgotPassword)))
          ->setContentType('text/html')
        ;
        $this->getMailer()->send($message);
        $this->getUser()->setFlash('notice', __('Check your e-mail! You should receive something shortly!'));
        $this->redirect('@sf_guard_signin');
      } else {
        $this->getUser()->setFlash('error', __('Invalid e-mail address!'));
      }
    }
  }
  public function executeChange($request)
  {
    $this->forgotPassword = $this->getRoute()->getObject();
    $this->user = $this->forgotPassword->User;
    $this->form = new sfGuardChangeUserPasswordForm($this->user);
    
    ProjectConfiguration::getActive()->loadHelpers('I18N');
    
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->form->save();
        $this->_deleteOldUserForgotPasswordRecords();
        $message = Swift_Message::newInstance()
          ->setFrom(sfConfig::get('app_sfGuardPlugin_defaultFromEmail', 'noreply@futurolan.net'))
          ->setTo($this->user->email_address)
          ->setSubject(__('New Password for %username%', array('%username%' => $this->user->username), 'sf_guard'))
          ->setBody($this->getPartial('sfGuardForgotPassword/new_password', array('user' => $this->user, 'password' => $request['sf_guard_user']['password'])))
        ;
        $this->getMailer()->send($message);
        $this->getUser()->setFlash('notice', __('Password updated successfully!'));
        $this->redirect('@sf_guard_signin');
      }
    }
  }
  private function _deleteOldUserForgotPasswordRecords()
  {
    Doctrine_Core::getTable('sfGuardForgotPassword')
      ->createQuery('p')
      ->delete()
      ->where('p.user_id = ?', $this->user->id)
      ->execute();
  }
}
