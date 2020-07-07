<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('convenience_categories', 'ConvenienceCategoryController');
    $router->resource('convenience_info', 'ConvenienceInfoController');
    $router->get('convenience_posters/{info_id}', 'PosterController@convenienceInfo');
});