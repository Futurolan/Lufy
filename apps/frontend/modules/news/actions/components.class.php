<?php

class newsComponents extends sfComponents
{
  public function executeActualite(sfWebRequest $request)
  {
    if ($this->getUser()->getCulture() == 'en')
    {
      $this->actualites = Doctrine_Query::create()
        ->select('n.title, n.summary, n.publish_on, n.slug, nt.logourl, u.username, COUNT(c.id_comment) AS nb_comment')
        ->from('News n')
        ->leftJoin('n.NewsType nt')
        ->leftJoin('n.SfGuardUser u')
        ->leftJoin('n.Comment c')
        ->where('n.slug LIKE "%-en"')
        ->andWhere('n.status = 1')
        ->andWhere('n.publish_on < NOW()')
        ->groupBy('n.id_news')
        ->orderBy('n.publish_on DESC')
        ->limit(7)
        ->execute();
    }
    else
    {
      $this->actualites = Doctrine_Query::create()
        ->select('n.title, n.summary, n.publish_on, n.slug, nt.logourl, u.username, COUNT(c.id_comment) AS nb_comment')
        ->from('News n')
        ->leftJoin('n.NewsType nt')
        ->leftJoin('n.SfGuardUser u')
        ->leftJoin('n.Comment c')
        ->where('n.slug NOT LIKE "%-en"')
        ->andWhere('n.status = 1')
        ->andWhere('n.publish_on < NOW()')
        ->groupBy('n.id_news')
        ->orderBy('n.publish_on DESC')
        ->limit(7)
        ->execute();
    }
  }


  public function executeActualitelight(sfWebRequest $request)
  {
    if ($this->getUser()->getCulture() == 'en')
    {
      $this->actualites = Doctrine_Query::create()
        ->select('n.title, n.publish_on, n.slug, nt.logourl, u.username, COUNT(c.id_comment) AS nb_comment')
        ->from('News n')
        ->leftJoin('n.NewsType nt')
        ->leftJoin('n.SfGuardUser u')
        ->leftJoin('n.Comment c')
        ->where('n.slug LIKE "%-en"')
        ->andWhere('n.status = 1')
        ->andWhere('n.publish_on < NOW()')
        ->groupBy('n.id_news')
        ->orderBy('n.publish_on DESC')
        ->limit(7)
        ->execute();
    }
    else
    {
      $this->actualites = Doctrine_Query::create()
        ->select('n.title, n.publish_on, n.slug, nt.logourl, u.username, COUNT(c.id_comment) AS nb_comment')
        ->from('News n')
        ->leftJoin('n.NewsType nt')
        ->leftJoin('n.SfGuardUser u')
        ->leftJoin('n.Comment c')
        ->where('n.slug NOT LIKE "%-en"')
        ->andWhere('n.status = 1')
        ->andWhere('n.publish_on < NOW()')
        ->groupBy('n.id_news')
        ->orderBy('n.publish_on DESC')
        ->limit(7)
        ->execute();
    }
  }

  public function executeAffiche(sfWebRequest $request)
  {
    if ($this->getUser()->getCulture() == 'en')
    {
      $this->affiches = Doctrine_Query::create()
        ->select('*')
        ->from('news n, newsType n2')
        ->where('n.news_type_id = n2.id_news_type')
        ->andWhere('n.slug LIKE "%-en"')
        ->andWhere('n2.is_special = 1')
        ->andWhere('n.status = 1')
        ->andWhere('n.publish_on < NOW()')
        ->orderBy('n.publish_on DESC')
        ->limit(5)
        ->execute();
    }
    else
    {
      $this->affiches = Doctrine_Query::create()
        ->select('*')
        ->from('news n, newsType n2')
        ->where('n.news_type_id = n2.id_news_type')
        ->andWhere('n.slug NOT LIKE "%-en"')
        ->andWhere('n2.is_special = 1')
        ->andWhere('n.status = 1')
        ->andWhere('n.publish_on < NOW()')
        ->orderBy('n.publish_on DESC')
        ->limit(5)
        ->execute();
    }
  }
}
