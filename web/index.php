<?php

require_once(dirname(__FILE__) . '/../config/ProjectConfiguration.class.php');

list($subdomain, $domain, $tld) = explode('.', $_SERVER['HTTP_HOST']);

// Default values
$app = 'frontend';
$env = 'prod';
$dbg = false;


// Select an application and environment
switch ($subdomain)
{
  case 'backend':
    $app = 'backend';
    $env = 'prod';
    $dbg = true;
    break;

  case 'presse':
    $app = 'presse';
    $env = 'prod';
//    $dbg = true;
    break;

  case 'partenaire':
    $app = 'presse';
    $env = 'prod';
    $dbg = false;
    break;

  case 'dev-backend':
    $app = 'backend';
    $env = 'dev';
    $dbg = true;
    break;

  case 'dev':
    $app = 'frontend';
    $env = 'dev';
    $dbg = true;
    break;

  default:
    $app = 'frontend';
    $env = 'prod';
    $dbg = false;
    break;
}


$configuration = ProjectConfiguration::getApplicationConfiguration($app, $env, $dbg);
sfContext::createInstance($configuration)->dispatch();
