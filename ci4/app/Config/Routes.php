<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
 $routes->get("/", "Home::index");
 $routes->get("/about", "Page::about");
 $routes->get("/contact", "Page::contact");
 $routes->get("/faqs", "Page::faqs");
 $routes->get("/tos", "Page::tos");
 $routes->get("/artikel", "Artikel::index");
 $routes->get("artikel/(:any)", 'Artikel::view/$1');
 
 // Routes untuk Login
 $routes->get("/user/login", "User::login");
 $routes->post("/user/login", "User::login");
 $routes->get("/user/logout", "User::logout");
 
 // Route untuk AJAX
 $routes->get("/ajax", "AjaxController::index");
 $routes->get("ajax/getData", "AjaxController::getData");
 $routes->delete("ajax/delete/(:num)", 'AjaxController::delete/$1');
 $routes->post("ajax/save", "AjaxController::save");
 
 $routes->post('api/login', 'Api\Auth::login');
 
 // ↓ Taruh di sini — SEBELUM options dan resource
 $routes->post('post', 'Post::create', ['filter' => 'apiauth']);
 $routes->put('post/(:segment)', 'Post::update/$1', ['filter' => 'apiauth']);
 $routes->delete('post/(:segment)', 'Post::delete/$1', ['filter' => 'apiauth']);
 
 
 // Options dan resource SETELAH route berfilter
 $routes->options('(:any)', static function () {
     return response()->setStatusCode(200);
 });
 $routes->resource('post');
 
 $routes->group("admin", ["filter" => "auth"], function ($routes) {
     $routes->get("artikel", "Artikel::admin_index");
     $routes->get("artikel/add", "Artikel::add");
     $routes->post("artikel/add", "Artikel::add");
     $routes->get("artikel/edit/(:num)", 'Artikel::edit/$1');
     $routes->post("artikel/update/(:num)", 'Artikel::update/$1');
     $routes->get("artikel/delete/(:num)", 'Artikel::delete/$1');
 });
 
 $routes->setAutoRoute(true);