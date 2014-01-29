<?php

/*
  if ($_SERVER['SERVER_NAME'] != 'backend.gamers-assembly.net')
  {
  header('Location: http://backend.gamers-assembly.net/');
  }
 */

require_once(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'dev', true);
sfContext::createInstance($configuration)->dispatch();
