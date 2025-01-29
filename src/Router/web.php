<?php

use Router\Router;

require_once 'src/Router/Router.php';

$router = new Router();

$router->get('/', 'LandingPageController@index');

$router->run();