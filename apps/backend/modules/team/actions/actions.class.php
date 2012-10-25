<?php

/**
 * team actions.
 *
 * @package    lufy
 * @subpackage team
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class teamActions extends sfActions {

  public function executeIndex(sfWebRequest $request)
  {
    $this->teams = new sfDoctrinePager('team', '20');

    $this->teams->setQuery(Doctrine::getTable('team')
      ->createQuery('a')
      ->orderBy('id_team DESC'));


    $this->teams->setPage($request->getParameter('page', 1));
    $this->teams->init();

    $this->form = new TeamFormFilter;
  }

  public function executeFilter(sfWebRequest $request)
  {
    $post_parameters = $request->getParameter('team_filters');

    $teams = Doctrine_Query::create()
      ->select('t.name, t.tag, t.slug, t.country, t.locked')
      ->from('Team t')
      ->orderBy('id_team DESC');

    foreach ($post_parameters as $key => $value)
    {
      if ($value['text'] != '')
      {
        $teams->andWhere($key.' LIKE "%'.$value['text'].'%"');
      }
    }
    $this->teams = new sfDoctrinePager('team', '20');
    $this->teams->setQuery($teams);

    $this->teams->setPage($request->getParameter('page', 1));
    $this->teams->init();

    $this->form = new TeamFormFilter;

    $this->setTemplate('index');
  }


    public function executeView(sfWebRequest $request) {
        $this->forward404Unless($this->team = Doctrine::getTable('team')->findOneByIdTeam($request->getParameter('id_team')));
    }

    public function executeNew(sfWebRequest $request) {
        $this->form = new teamForm();
    }

    public function executeCreate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST));

        $this->form = new teamForm();

        $this->processForm($request, $this->form);

        $this->setTemplate('new');
    }

    public function executeEdit(sfWebRequest $request) {
        $this->forward404Unless($team = Doctrine::getTable('team')->find(array($request->getParameter('id_team'))), sprintf('Object team does not exist (%s).', $request->getParameter('id_team')));
        $this->form = new teamForm($team);
    }

    public function executeUpdate(sfWebRequest $request) {
        $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
        $this->forward404Unless($team = Doctrine::getTable('team')->find(array($request->getParameter('id_team'))), sprintf('Object team does not exist (%s).', $request->getParameter('id_team')));
        $this->form = new teamForm($team);

        $this->processForm($request, $this->form);

        $this->setTemplate('edit');
    }

    public function executeDelete(sfWebRequest $request) {
        $request->checkCSRFProtection();

        $this->forward404Unless($team = Doctrine::getTable('team')->find(array($request->getParameter('id_team'))), sprintf('Object team does not exist (%s).', $request->getParameter('id_team')));

        Doctrine::getTable('team')
                ->deleteTeamPlayers($team[0]->getIdTeam());
        $s = Doctrine::getTable('team')
                        ->InSlot($team[0]->getIdTeam());
        Doctrine::getTable('tournamentSlot')
                ->setLibre($s->getIdTournamentSlot());
        $team->delete();

        $this->redirect('team/index');
    }

    protected function processForm(sfWebRequest $request, sfForm $form) {
        $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
        if ($form->isValid()) {
            $team = $form->save();

            $this->redirect('team/edit?id_team=' . $team->getIdTeam());
        }
    }

  protected function getFilters()
  {
    return $this->getUser()->getAttribute('sfGuardUser.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('sfGuardUser.filters', $filters, 'admin_module');
  }

  protected function getPager()
  {
    $pager = $this->configuration->getPager('sfGuardUser');
    $pager->setQuery($this->buildQuery());
    $pager->setPage($this->getPage());
    $pager->init();

    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('sfGuardUser.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('sfGuardUser.page', 1, 'admin_module');
  }

  protected function buildQuery()
  {
    $tableMethod = $this->configuration->getTableMethod();
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $this->filters->setTableMethod($tableMethod);

    $query = $this->filters->buildQuery($this->getFilters());

    $this->addSortQuery($query);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_query'), $query);
    $query = $event->getReturnValue();

    return $query;
  }

  protected function addSortQuery($query)
  {
    if (array(null, null) == ($sort = $this->getSort()))
    {
      return;
    }

    if (!in_array(strtolower($sort[1]), array('asc', 'desc')))
    {
      $sort[1] = 'asc';
    }

    $query->addOrderBy($sort[0] . ' ' . $sort[1]);
  }

  protected function getSort()
  {
    if (null !== $sort = $this->getUser()->getAttribute('sfGuardUser.sort', null, 'admin_module'))
    {
      return $sort;
    }

    $this->setSort($this->configuration->getDefaultSort());

    return $this->getUser()->getAttribute('sfGuardUser.sort', null, 'admin_module');
  }

  protected function setSort(array $sort)
  {
    if (null !== $sort[0] && null === $sort[1])
    {
      $sort[1] = 'asc';
    }

    $this->getUser()->setAttribute('sfGuardUser.sort', $sort, 'admin_module');
  }

  protected function isValidSortColumn($column)
  {
    return Doctrine_Core::getTable('sfGuardUser')->hasColumn($column);
  }
}
