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
   * @brief Activate the user layout
   */
  public function postExecute()
  {
    if ($this->getActionName() != 'view')
    {
      $this->setLayout('user');
    }
  }

  /**
   * @brief Redirect to current user profile
   * @param $request A sfWebRequest object
   * @return Redirect
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('user/profile');
  }

  /**
   * @brief Create a printable bulletin
   * @param $request A sfWebRequest object
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
              ->andWhere('t1.team_id = ?', $team->getIdTeam())
              ->execute();
    }

    $this->setLayout('print');
  }

  /**
   * @brief
   * @param $request A sfWebRequest object
   * @return
   */
  public function executeView(sfWebRequest $request)
  {
    $this->user = Doctrine::getTable('sfGuardUser')->findOneByUsername($request->getParameter('username'));
    $this->forward404Unless($this->user);
  }

  /**
   * @brief Find the current user profile
   * @param $request A sfWebRequest object
   */
  public function executeProfile(sfWebRequest $request)
  {
    $this->user = Doctrine::getTable('sfGuardUser')->findOneById($this->getUser()->getGuardUser()->getId());
  }

  /**
   * @brief Edit the current user profile or create a new object profilForm
   * @param $request A sfWebRequest object
   * @return Redirect
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
   * @param $request A sfWebRequest object
   * @return
   */
  public function executeAddress(sfWebRequest $request)
  {
    $this->addresses = Doctrine::getTable('SfGuardUserAddress')->findByUserId($this->getUser()->getGuardUser()->getId());
  }

  /**
   * @brief Create a new address and if it's first set it is default billing and delivery
   * @param $request A sfWebRequest object
   * @return Redirect
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
   * @brief Permit to edit an address
   * @param $request A sfWebRequest object
   * @return Redirect
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
   * @brief Define an address as default
   * @param $request A sfWebRequest object
   * @return Redirect
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
   * @brief Define an address as Billing
   * @param $request A sfWebRequest object
   * @return Redirect
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
   * @brief Define an address as Delivery
   * @param $request A sfWebRequest object
   * @return Redirect
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
   * @brief Delete an address
   * @param $request A sfWebRequest object
   * @return Redirect and Flash address
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
   * @param
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
   * @param
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
   * @param
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
   * @param
   * @return
   */
  public function executeWeezevent(sfWebRequest $request)
  {
    $idteam = $this->getUser()->getGuardUser()->TeamPlayer[0]->getTeam()->getIdTeam();

    if (!$idteam)
    {
      $this->getUser()->setFlash('error', 'Vous ne pouvez pas valider votre billet si vous navez pas d\'équipe.');
      $this->redirect('profil/index');
    }
    else
    {
      $tournamentSlot = $this->getUser()->getGuardUser()->TeamPlayer[0]->getTeam()->getTournamentSlot();
      if (!$tournamentSlot)
      {
        $this->getUser()->setFlash('error', 'Vous ne pouvez pas valider votre billet si vous navez pas d\'équipe inscrite pur un tournoi.');
        $this->redirect('profil/index');
      }
    }

    $this->weezevent = $this->getUser()->getGuardUser()->getSfGuardUserWeezevent();

    if (!$this->weezevent)
    {
      $this->weezevent = new SfGuardUserWeezevent();
      $this->weezevent->setUserId($this->getUser()->getGuardUser()->getId());
    }

    $this->form = new SfGuardUserWeezeventForm($this->weezevent);

    if ($request->isMethod(sfRequest::POST))
    {
      $ticket = Doctrine::getTable('SfGuardUserWeezevent')->findOneByBarcode($request->getPostParameter('sf_guard_user_weezevent[barcode]'));
      if ($ticket)
      {
        $this->getUser()->setFlash('error', 'Ce billet a deja ete enregistre par un autre joueur.');
      }
      else
      {
        try
        {
          $weezevent_API = new Weezevent_API();
        }
        catch (Exception $exc)
        {
          $result = false;
        }

        if (!isset($result))
        {
          $barcode = $request->getPostParameter('sf_guard_user_weezevent[barcode]');
          $result = $weezevent_API->checkParticipant($tournamentSlot->getWeezeventId(), $tournamentSlot->getTournament()->getWeezeventId(), $barcode);
        }

        //$result =true;
        if ($result)
        {
          $this->form->getObject()->setIsValid(1);
          $this->form->getObject()->setTournamentId($tournamentSlot->getTournament()->getWeezeventId());
          $this->form->getObject()->setEventId($tournamentSlot->getTournament()->getEvent()->getWeezeventId());
          $this->processForm($request, $this->form);
        }
        else
        {
          if ($result === false)
          {
            $this->getUser()->setFlash('error', 'Il semblerais quil y ai une erreur avec le service de weezevent. Envoyez immediatement un courriel a inscriptions@futurolan.net');
          }
          else
          {
            $this->getUser()->setFlash('error', 'Ce billet ne semble pas valide. Avez vous bien saisi votre codebar ?');
          }
        }
      }
      $this->redirect('user/weezevent');
    }
  }

  /**
   * @brief
   * @param
   * @return
   */
  public function executeDeleteWeezevent(sfWebRequest $request)
  {
    $this->redirectUnless($weezevent = Doctrine::getTable('SfGuardUserWeezevent')->findOneByUserId($this->getUser()->getGuardUser()->getId()), 'user/weezevent');

    $team_is_locked = false;
    foreach ($this->getUser()->getGuardUser()->getTeamPlayer() as $player)
    {
      if ($player->getTeam()->getIsLocked())
      {
        $team_is_locked = true;
      }
    }

    if ($team_is_locked)
    {
      $this->getUser()->setFlash('error', 'Vous ne pouvez pas supprimer votre billet apres avoir validee votre inscription.');
      $this->redirect('user/weezevent');
    }

    $weezevent->delete();

    $this->redirect('user/weezevent');
  }

  /**
   * @brief
   * @param
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

