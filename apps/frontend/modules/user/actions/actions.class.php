<?php

/**
 * user actions.
 *
 * @package    lufy
 * @subpackage user
 * @author     Guillaume Marsay <guillaume@futurolan.net>
 * @author     HumanG33k
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class userActions extends FrontendActions
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function postExecute()
  {
    $this->setLayout('user');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('user/profile');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeBulletin(sfWebRequest $request)
  {
    $this->forward404Unless($this->user = Doctrine::getTable('sfGuardUser')->findOneById($this->getUser()->getGuardUser()->getId()));

    foreach ($this->user->getTeam() as $team)
    {
      $this->tournaments = Doctrine_Query::create()
              ->select('*')
              ->from('tournamentSlot t1, tournament t2')
              ->where('t1.tournament_id = t2.id_tournament')
              ->andWhere('t1.team_id = ' . $team->getIdTeam())
              ->execute();
    }

    $this->setLayout('print');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeView(sfWebRequest $request)
  {
    $this->user = Doctrine::getTable('sfGuardUser')->findOneByUsername($request->getParameter('username', ''));
    $this->forward404Unless($this->user);

    $t = Doctrine::getTable('invite')->isInvitedInTeam($this->user->getId());
    $t2 = Doctrine::getTable('team')->isInTeam($this->user->getId());

    $d = Doctrine::getTable('sfGuardUser')->isCaptain();
    $this->inviteteam = '0';

    if ($t == false && $t2 == false)
    {
      if ($d == true || $d2 == true)
      {
        $this->inviteteam = '1';
      }
    }

    $f = Doctrine::getTable('invite')->isInvitedFriend($this->user->getId());
    $f2 = Doctrine::getTable('friend')->isFriend($this->user->getId());

    $this->invitefriend = '0';
    if ($f == false && $f2 == false)
    {
      $this->invitefriend = '1';
    }

    if ($this->user->getId() == $this->getUser()->getGuardUser()->getId() || $this->getUser()->isAuthenticated() == false)
    {
      $this->invitefriend = '0';
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeProfile(sfWebRequest $request)
  {
    $this->user = Doctrine::getTable('sfGuardUser')->findOneById($this->getUser()->getGuardUser()->getId());
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeEditProfile(sfWebRequest $request)
  {
    $this->forward404Unless($user = Doctrine::getTable('sfGuardUser')->find(array($this->getUser()->getGuardUser()->getId())), sprintf('Object user does not exist (%s).', $request->getParameter('id')));

    $this->form = new profilForm($user);

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      if ($this->processForm($request, $this->form))
      {
        $this->redirect('user/profile');
      }
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeAddress(sfWebRequest $request)
  {
    $this->addresses = Doctrine::getTable('SfGuardUserAddress')->findByUserId($this->getUser()->getGuardUser()->getId());
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeNewAddress(sfWebRequest $request)
  {
    $object = new SfGuardUserAddress();
    $object->setUserId($this->getUser()->getGuardUser()->getId());
    $first = $this->getUser()->getGuardUser()->getSfGuardUserAddress()->count();

    if ($first == 0)
    {
      $object->setIsDefault(1);
      $object->setIsBilling(1);
      $object->setIsDelivery(1);
    }

    $this->form = new SfGuardUserAddressForm($object);

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      if ($this->processForm($request, $this->form))
      {
        $this->redirect('user/address');
      }
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeEditAddress(sfWebRequest $request)
  {
    $this->forward404Unless($address = Doctrine::getTable('SfGuardUserAddress')->findOneByIdAndUserId($request->getParameter('id'), $this->getUser()->getGuardUser()->getId()));

    $this->form = new SfGuardUserAddressForm($address);

    if ($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      if ($this->processForm($request, $this->form))
      {
        $this->redirect('user/address');
      }
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeSetDefaultAddress(sfWebRequest $request)
  {
    $address = Doctrine::getTable('SfGuardUserAddress')->findOneByIdAndUserId($request->getParameter('id'), $this->getUser()->getGuardUser()->getId());
    $this->forward404Unless($address);

    $addresses = Doctrine::getTable('SfGuardUserAddress')->findByUserId($this->getUser()->getGuardUser()->getId());
    foreach ($addresses as $other_address)
    {
      $other_address->setIsDefault(0);
      $other_address->save();
    }

    $address->setIsDefault(1);
    $address->save();

    $this->redirect('user/address');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeSetBillingAddress(sfWebRequest $request)
  {
    $address = Doctrine::getTable('SfGuardUserAddress')->findOneByIdAndUserId($request->getParameter('id'), $this->getUser()->getGuardUser()->getId());
    $this->forward404Unless($address);

    $addresses = Doctrine::getTable('SfGuardUserAddress')->findByUserId($this->getUser()->getGuardUser()->getId());
    foreach ($addresses as $other_address)
    {
      $other_address->setIsBilling(0);
      $other_address->save();
    }

    $address->setIsBilling(1);
    $address->save();

    $this->redirect('user/address');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeSetDeliveryAddress(sfWebRequest $request)
  {
    $address = Doctrine::getTable('SfGuardUserAddress')->findOneByIdAndUserId($request->getParameter('id'), $this->getUser()->getGuardUser()->getId());
    $this->forward404Unless($address);

    $addresses = Doctrine::getTable('SfGuardUserAddress')->findByUserId($this->getUser()->getGuardUser()->getId());
    foreach ($addresses as $other_address)
    {
      $other_address->setIsDelivery(0);
      $other_address->save();
    }

    $address->setIsDelivery(1);
    $address->save();

    $this->redirect('user/address');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeDeleteAddress(sfWebRequest $request)
  {
    $address = Doctrine::getTable('SfGuardUserAddress')->findOneByIdAndUserId($request->getParameter('id'), $this->getUser()->getGuardUser()->getId());
    $this->forward404Unless($address);

    if ($address->getIsDefault())
    {
      $this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('Impossible de supprimer une adresse par defaut.'));
      $this->redirect('user/address');
    }

    if ($address->getIsBilling())
    {
      $default_address = $this->getUser()->getGuardUser()->getDefaultAddress();
      $default_address->setIsBilling(1);
      $default_address->save();
    }

    if ($address->getIsDelivery())
    {
      $default_address = $this->getUser()->getGuardUser()->getDefaultAddress();
      $default_address->setIsDelivery(1);
      $default_address->save();
    }

    $address->delete();

    $this->getUser()->setFlash('success', $this->getContext()->getI18n()->__('L\adresse selectionnee a ete supprimee.'));

    $this->redirect('user/address');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeLicenceMasters(sfWebRequest $request)
  {
    $this->forward404Unless($user = Doctrine::getTable('SfGuardUser')->findOneById($this->getUser()->getGuardUser()->getId()));
    $this->licence = $user->getSfGuardUserLicenceMasters();

    if (!$this->licence)
    {
      $this->licence = new SfGuardUserLicenceMasters();
      $this->licence->setUserId($user->getId());
    }

    $this->form = new SfGuardUserLicenceMastersForm($this->licence);

    if ($request->isMethod(sfRequest::POST))
    {
      $this->processFormLicenceMasters($request, $this->form, $this->licence);

      $this->redirect('user/licenceMasters');
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeDeleteLicenceMasters(sfWebRequest $request)
  {
    $this->redirectUnless($licence = Doctrine::getTable('SfGuardUserLicenceMasters')->findOneByUserId($this->getUser()->getGuardUser()->getId()), 'user/licenceMasters');
    $licence->delete();

    $this->redirect('user/licenceMasters');
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  protected function processFormLicenceMasters(sfWebRequest $request, sfForm $form, SfGuardUserLicenceMasters $licence)
  {
    $mfjv = new mfjv();
    $mfjv->setCriteria('last_name', $this->getUser()->getGuardUser()->getLastName());
    $serial = $request->getPostParameter('sf_guard_user_licence_masters[serial]');
    $result = $mfjv->check($serial);
    if ($result)
    {
      $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

      $licence->setType($result->type);
      $licence->setSerial($result->serial);
      $licence->setUsername($result->username);
      $licence->setSeason($result->season);
      $licence->setUsed($result->used);
      $licence->save();

      $this->getUser()->setFlash('success', $this->getContext()->getI18n()->__('Votre Licence Masters a ete verifiee.'));

      $this->redirect('user/licenceMasters');
    }
    else
    {
      $this->getUser()->setFlash('error', $this->getContext()->getI18n()->__('La licence est inexistante et/ou le nom saisi sur votre profil ne correspond pas.'));

      $this->redirect('user/licenceMasters');
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeTshirt(sfWebRequest $request)
  {
    $this->forward404Unless($user = Doctrine::getTable('sfGuardUser')->find(array($this->getUser()->getGuardUser()->getId())), sprintf('Object user does not exist (%s).', $request->getParameter('id')));
    $tshirt = $user->getSfGuardUserTshirt();

    if (!$tshirt)
    {
      $tshirt = new SfGuardUserTshirt();
      $tshirt->setUserId($user->getId());
    }

    $this->form = new SfGuardUserTshirtForm($tshirt);

    if ($request->isMethod(sfRequest::POST))
    {
      $this->processForm($request, $this->form);

      $this->redirect('user/tshirt');
    }
  }

}

