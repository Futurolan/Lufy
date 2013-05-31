<?php

class newsComponents extends sfComponents
{

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeActualite(sfWebRequest $request)
  {
    if ($this->getUser()->getCulture() == 'en')
    {
      $this->actualites = Doctrine_Query::create()
              ->from('news n')
              ->Where('n.slug NOT LIKE "%-en"')
              ->AndWhere('n.status = 1')
              ->orderBy('n.publish_on DESC')
              ->limit($this->getRequestParameter('limit', 6))
              ->execute();
    }
    else
    {
      $this->actualites = Doctrine_Query::create()
              ->from('news n')
              ->Where('n.slug NOT LIKE "%-en"')
              ->AndWhere('n.status = 1')
              ->orderBy('n.publish_on DESC')
              ->limit($this->getRequestParameter('limit', 6))
              ->execute();
    }
  }

  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeActualitelight(sfWebRequest $request)
  {
    if ($this->getUser()->getCulture() == 'en')
    {
      $this->actualites = Doctrine_Query::create()
              ->from('news n')
              ->Where('n.slug NOT LIKE "%-en"')
              ->AndWhere('n.status = 1')
              ->orderBy('n.publish_on DESC')
              ->limit($this->getRequestParameter('limit', 7))
              ->execute();
    }
    else
    {
      $this->actualites = Doctrine_Query::create()
              ->from('news n')
              ->Where('n.slug NOT LIKE "%-en"')
              ->AndWhere('n.status = 1')
              ->orderBy('n.publish_on DESC')
              ->limit($this->getRequestParameter('limit', 7))
              ->execute();
    }
  }
  /**
   * @brief
   * @param[in]
   * @return
   */
  public function executeAffiche(sfWebRequest $request)
  {
    if ($this->getUser()->getCulture() == 'en')
    {
      $this->affiches = Doctrine_Query::create()
              ->select('*')
              ->from('news n, newsType n2')
              ->where('n.news_type_id = n2.id_news_type')
              ->andWhere('n.slug NOT LIKE "%-en"')
              ->andWhere('n2.is_special = 1')
              ->andWhere('n.status = 1')
              ->orderBy('n.publish_on DESC')
              ->limit($this->getRequestParameter('limit', 5))
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
              ->orderBy('n.publish_on DESC')
              ->limit($this->getRequestParameter('limit', 5))
              ->execute();
    }
  }

}
