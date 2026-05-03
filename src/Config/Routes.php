<?php

/**
 * @package   Pubvana\Profiles
 * @copyright 2026 Pubvana
 * @license   MIT
 */

/**
 * Public profile routes.
 *
 * Auto-prefixed by Flight School. Prefix: /profile
 *
 * Routes:
 *   GET  /profile/@username        - View any user's profile
 *   GET  /profile/@username/edit   - Edit own profile form
 *   POST /profile/@username/update - Save own profile
 */

use Enlivenapp\FlightCsrf\Middlewares\CsrfMiddleware;
use Enlivenapp\FlightShield\Middlewares\PermissionMiddleware;
use Pubvana\Profiles\Controllers\ProfilePublicController;

/** @var \flight\net\Router $router */
/** @var \flight\Engine $app */
/** @var string $configPrepend */

$router->get('/@username', function (string $username) use ($app, $configPrepend) {
    (new ProfilePublicController($app, $configPrepend))->show($username);
});

$router->get('/@username/edit', function (string $username) use ($app, $configPrepend) {
    (new ProfilePublicController($app, $configPrepend))->edit($username);
})->addMiddleware(new PermissionMiddleware($app, 'profile.edit'));

$router->post('/@username/update', function (string $username) use ($app, $configPrepend) {
    (new ProfilePublicController($app, $configPrepend))->update($username);
})->addMiddleware(new PermissionMiddleware($app, 'profile.edit'))
  ->addMiddleware(new CsrfMiddleware($app));
