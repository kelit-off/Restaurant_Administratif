<?php

use Core\Router;

$router = new Router();

$router->get('/', 'LandingPageController@index');
$router->get('/auth/login', 'AuthController@viewLogin');
$router->post('/auth/login', 'AuthController@postLogin');
$router->get('/auth/register', 'AuthController@viewRegister');
$router->post('/auth/register', 'AuthController@postRegister');

$router->get('/admin', 'AdminController@index');
$router->get('/admin/users', 'AdminController@viewUsers');
$router->get('/admin/usager', 'AdminController@viewUsager');
$router->get('/admin/category', 'AdminController@viewCategory');
$router->get('/admin/prestation', 'AdminController@viewPrestation');

$router->run();