<?php

/**
 * @package   Pubvana\Profiles
 * @copyright 2026 Pubvana
 * @license   MIT
 */

/**
 * Profile admin routes.
 *
 * Auto-prefixed by Flight School. Prefix: /admin
 *
 * Routes:
 *   GET  /admin/profile              - Self-service profile page
 *   POST /admin/profile/@userId/update - Save profile for a user
 */

use Enlivenapp\FlightCsrf\Middlewares\CsrfMiddleware;
use Enlivenapp\FlightShield\Middlewares\SessionAuthMiddleware;
use Pubvana\Profiles\Controllers\ProfileController;

/** @var \flight\net\Router $router */
/** @var \flight\Engine $app */
/** @var string $configPrepend */

$router->get('/profile', function () use ($app, $configPrepend) {
    (new ProfileController($app, $configPrepend))->index();
})->addMiddleware(new SessionAuthMiddleware($app));

$router->post('/profile/@userId/update', function (string $userId) use ($app, $configPrepend) {
    (new ProfileController($app, $configPrepend))->update($userId);
})->addMiddleware(new SessionAuthMiddleware($app))
  ->addMiddleware(new CsrfMiddleware($app));
