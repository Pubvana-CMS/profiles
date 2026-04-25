<?php

declare(strict_types=1);

namespace Pubvana\Profiles;

use Enlivenapp\FlightSchool\PluginInterface;
use flight\Engine;
use flight\net\Router;
use Pubvana\Profiles\Models\Profile;

class Plugin implements PluginInterface
{
    /**
     * Register profile extensions into the admin.
     *
     * Registers:
     *   - menu: SEO submenu under tools (test fixture)
     *   - page: Profile tab on users.edit.tabs
     *
     * @param Engine $app    The FlightPHP app instance
     * @param Router $router The FlightPHP router
     * @param array  $config Plugin config from app/config/config.php
     */
    public function register(Engine $app, Router $router, array $config = []): void
    {
        // Tab on the user edit form
        $app->adext('page', 'users.edit.tabs', 'pubvana.profile', [
            'label'    => 'Profile',
            'priority' => 20,
            'callable' => function (array $context) use ($app) {
                $model   = new Profile($app->get('db'));
                $profile = $model->findOrCreate($context['user_id']);

                return [
                    'fields' => [
                        'display_name' => [
                            'value' => $profile->display_name ?? '',
                            'type'  => 'string',
                            'title' => 'Display Name',
                        ],
                        'bio' => [
                            'value' => $profile->bio ?? '',
                            'type'  => 'text',
                            'title' => 'Bio',
                        ],
                        'avatar' => [
                            'value' => $profile->avatar ?? '',
                            'type'  => 'media_image',
                            'title' => 'Avatar',
                        ],
                        'website' => [
                            'value' => $profile->website ?? '',
                            'type'  => 'string',
                            'title' => 'Website',
                        ],
                        'twitter' => [
                            'value' => $profile->twitter ?? '',
                            'type'  => 'string',
                            'title' => 'Twitter',
                        ],
                        'facebook' => [
                            'value' => $profile->facebook ?? '',
                            'type'  => 'string',
                            'title' => 'Facebook',
                        ],
                        'linkedin' => [
                            'value' => $profile->linkedin ?? '',
                            'type'  => 'string',
                            'title' => 'LinkedIn',
                        ],
                    ],
                    'post_url'   => '/profile/' . $context['user_id'] . '/update',
                    'return_url' => $context['return_url'] ?? '',
                ];
            },
        ]);
    }
}
