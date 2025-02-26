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
$router->get('/admin/tarif', 'AdminController@viewTarif');
$router->get('/admin/ticket', 'AdminController@viewTicket');
$router->get('/admin/droits', 'AdminController@viewDroits');
$router->get('/admin/depot', 'AdminController@viewDepot');

// Page de creation
$router->get('/admin/users/create', 'AdminController@viewCreateUser');
$router->get('/admin/usager/create', 'AdminController@viewCreateUsager');
$router->get('/admin/category/create', 'AdminController@viewCreateCategory');
$router->get('/admin/prestation/create', 'AdminController@viewCreatePrestation');
$router->get('/admin/tarif/create', 'AdminController@viewCreateTarif');
$router->get('/admin/ticket/create', 'AdminController@viewCreateTicket');
$router->get('/admin/droits/create', 'AdminController@viewCreateDroits');
$router->get('/admin/depot/create', 'AdminController@viewCreateDepot');

// Page de modification
$router->get('/admin/users/edit/{id}', 'AdminController@viewUpdateUser');
$router->get('/admin/usager/edit/{id}', 'AdminController@viewUpdateUsager');
$router->get('/admin/category/edit/{id}', 'AdminController@viewUpdateCategory');
$router->get('/admin/prestation/edit/{id_prestation}-{id_categorie}', 'AdminController@viewUpdateTarif');
$router->get('/admin/tarif/edit/{id}', 'AdminController@viewUpdateTarif');
$router->get('/admin/ticket/edit/{id}', 'AdminController@viewUpdateTicket');
$router->get('/admin/droits/edit/{id}', 'AdminController@viewUpdateDroits');
$router->get('/admin/depot/edit/{id}', 'AdminController@viewUpdateDepot');

// Page du post
$router->post('/admin/users/create', 'AdminController@postCreateUser');
$router->post('/admin/usager/create', 'AdminController@postCreateUsager');
$router->post('/admin/category/create', 'AdminController@postCreateCategory');
$router->post('/admin/prestation/create', 'AdminController@postCreatePrestation');
$router->post('/admin/tarif/create', 'AdminController@postCreateTarif');
$router->post('/admin/ticket/create', 'AdminController@postCreateTicket');
$router->post('/admin/droits/create', 'AdminController@postCreateDroits');
$router->post('/admin/depot/create', 'AdminController@postCreateDepot');

$router->post('/admin/users/update', 'AdminController@postUpdateUser');
$router->post('/admin/usager/update', 'AdminController@postUpdateUsager');
$router->post('/admin/category/update', 'AdminController@postUpdateCategory');
$router->post('/admin/prestation/update', 'AdminController@postUpdatePrestation');
$router->post('/admin/tarif/update', 'AdminController@postUpdateTarif');
$router->post('/admin/ticket/update', 'AdminController@postUpdateTicket');
$router->post('/admin/droits/update', 'AdminController@postUpdateDroits');
$router->post('/admin/depot/update', 'AdminController@postUpdateDepot');

$router->get('/admin/users/{id}/delete', 'AdminController@deleteUser');
$router->get('/admin/usager/{id}/delete', 'AdminController@deleteUsager');
$router->get('/admin/category/{id}/delete', 'AdminController@deleteCategory');
$router->get('/admin/prestation/{id}/delete', 'AdminController@deletePrestation');
$router->get('/admin/tarif/{id_prestation}-{id_categorie}/delete', 'AdminController@deleteTarif');
$router->get('/admin/ticket/{id}/delete', 'AdminController@deleteTicket');
$router->get('/admin/droits/{id}/delete', 'AdminController@deleteDroits');
$router->get('/admin/depot/{id}/delete', 'AdminController@deleteDepot');

$router->run();