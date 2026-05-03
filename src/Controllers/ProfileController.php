<?php

declare(strict_types=1);

namespace Pubvana\Profiles\Controllers;

use Pubvana\Admin\Controllers\AdminController;

/**
 * Admin controller for user profile self-service and tab-based updates.
 */
class ProfileController extends AdminController
{
    /**
     * Self-service profile page for the current admin user.
     */
    public function index(): void
    {
        $user    = $this->app->auth()->user();
        $profile = $this->app->profiles()->findOrCreate((int) $user->id);

        $this->render('profile/index', [
            'pageTitle' => 'My Profile',
            'profile'   => $profile,
            'user'      => $user,
        ]);
    }

    /**
     * Save profile for a given user ID.
     * Used by both the self-service page and the admin user edit tab.
     */
    public function update(string $userId): void
    {
        $post = $this->app->request()->data->getData();
        unset($post['_csrf_token'], $post['return_url']);

        $this->app->profiles()->updateProfile((int) $userId, $post);

        $returnUrl = $this->app->request()->data->return_url ?? '/admin/profile';
        $this->app->redirect($returnUrl);
    }
}
