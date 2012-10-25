<?php


class TournamentTable extends Doctrine_Table
{
    
    public static function getInstance()
    {
        return Doctrine_Core::getTable('Tournament');
    }
    
    public function checkNbPlayer($slug, $nbplayer)
    {
      $q = Doctrine_Core::getTable('tournament')->findOneBySlug($slug);
    
      if ($nbplayer > $q->getPlayerPerTeam()):
        return false;
      else:
        return true;
      endif;
    }
}