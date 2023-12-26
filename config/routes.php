<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;


Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {

    $routes->connect('/:lang', ['controller' => 'Pages', 'action' => 'index'], ['lang' => '[a-z]{2}']);
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'index']);


    $routes->connect('/:lang/objects', ['controller' => 'Pages', 'action' => 'objects'], ['lang' => '[a-z]{2}']);
    $routes->connect('/objects', ['controller' => 'Pages', 'action' => 'objects']);

    $routes->connect('/:lang/about_us', ['controller' => 'Pages', 'action' => 'aboutUs'], ['lang' => '[a-z]{2}']);
    $routes->connect('/about_us', ['controller' => 'Pages', 'action' => 'aboutUs']);


    $routes->connect('/:lang/aboutUs', ['controller' => 'Pages', 'action' => 'aboutUs'], ['lang' => '[a-z]{2}']);
    $routes->connect('/aboutUs', ['controller' => 'Pages', 'action' => 'aboutUs']);

    $routes->connect('/:lang/contacts', ['controller' => 'Pages', 'action' => 'contacts'], ['lang' => '[a-z]{2}']);
    $routes->connect('/contacts', ['controller' => 'Pages', 'action' => 'contacts']);

    $routes->connect('/:lang/invest', ['controller' => 'Pages', 'action' => 'invest'], ['lang' => '[a-z]{2}']);
    $routes->connect('/invest', ['controller' => 'Pages', 'action' => 'invest']);

    $routes->connect('/:lang/services', ['controller' => 'Pages', 'action' => 'services'], ['lang' => '[a-z]{2}']);
    $routes->connect('/services', ['controller' => 'Pages', 'action' => 'services']);

    $routes->connect('/:lang/getPrj', ['controller' => 'Pages', 'action' => 'getPrj'], ['lang' => '[a-z]{2}']);
    $routes->connect('/getPrj', ['controller' => 'Pages', 'action' => 'getPrj']);

    $routes->connect('/:lang/gallery', ['controller' => 'Pages', 'action' => 'gallery'], ['lang' => '[a-z]{2}']);
    $routes->connect('/gallery', ['controller' => 'Pages', 'action' => 'gallery']);

    $routes->connect('/:lang/get_document/*', ['controller' => 'Pages', 'action' => 'getDocument'], ['lang' => '[a-z]{2}']);
    $routes->connect('/get_document/*', ['controller' => 'Pages', 'action' => 'getDocument']);


    $routes->connect('/:lang/getDocument/*', ['controller' => 'Pages', 'action' => 'getDocument'], ['lang' => '[a-z]{2}']);
    $routes->connect('/getDocument/*', ['controller' => 'Pages', 'action' => 'getDocument']);

    $routes->connect('/:lang/sendForm/*', ['controller' => 'Pages', 'action' => 'sendForm'], ['lang' => '[a-z]{2}']);
    $routes->connect('/sendForm/*', ['controller' => 'Pages', 'action' => 'sendForm']);

    $routes->connect('/:lang/thanks', ['controller' => 'Pages', 'action' => 'thanks'], ['lang' => '[a-z]{2}']);
    $routes->connect('/thanks', ['controller' => 'Pages', 'action' => 'thanks']);


//
//    $routes->connect('/getPrj/*', ['controller' => 'Pages', 'action' => 'getPrj']);
    $routes->connect('/:lang/projects', ['controller' => 'Pages', 'action' => 'projects'], ['lang' => '[a-z]{2}']);
    $routes->connect('/projects', ['controller' => 'Pages', 'action' => 'projects']);

    $routes->connect('/:lang/project/*', ['controller' => 'Pages', 'action' => 'project'], ['lang' => '[a-z]{2}']);
    $routes->connect('/project/*', ['controller' => 'Pages', 'action' => 'project']);


    $routes->connect('/:lang/blog/:category_slug/page/:page', ['controller' => 'Pages', 'action' => 'blog'], ['lang' => '[a-z]{2}', 'page' => '[0-9]+']);
    $routes->connect('/:lang/blog/:category_slug', ['controller' => 'Pages', 'action' => 'blog'], ['lang' => '[a-z]{2}']);
    $routes->connect('/blog/:category_slug/page/:page', ['controller' => 'Pages', 'action' => 'blog'], ['page' => '[0-9]+']);
    $routes->connect('/blog/:category_slug', ['controller' => 'Pages', 'action' => 'blog']);

    $routes->connect('/:lang/post/:post_slug', ['controller' => 'Pages', 'action' => 'post'], ['lang' => '[a-z]{2}']);
    $routes->connect('/post/:post_slug', ['controller' => 'Pages', 'action' => 'post']);


    $routes->connect('/:lang/:category_slug', ['controller' => 'Pages', 'action' =>  'category'], ['lang' => '[a-z]{2}']);
    $routes->connect('/:category_slug', ['controller' => 'Pages', 'action' =>  'category']);


    $routes->fallbacks(DashedRoute::class);
});

Router::prefix('admindom', function ($routes) {
    $routes->connect('/', ['controller' => 'Admin', 'action' => 'login']);

    $routes->connect('/:action', ['controller' => 'Admin']);
    $routes->fallbacks('DashedRoute');
});


/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
