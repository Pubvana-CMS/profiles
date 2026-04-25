<?php

declare(strict_types=1);

namespace Pubvana\Profiles\Controllers;

use Pubvana\Admin\Controllers\AdminController;
use Pubvana\Profiles\Models\Profile;

class ProfileController extends AdminController
{
    protected function model(): Profile
    {
        return new Profile($this->app->get('db'));
    }

    /**
     * Self-service profile page for the current admin user.
     */
    public function index(): void
    {
        $user    = $this->app->auth()->user();
        $profile = $this->model()->findOrCreate((int) $user->id);

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
        $profile = $this->model()->findOrCreate((int) $userId);

        $post = $this->app->request()->data->getData();
        unset($post['_csrf_token'], $post['return_url']);

        $profile->updateFromArray($post);

        $returnUrl = $this->app->request()->data->return_url ?? '/admin/profile';
        $this->app->redirect($returnUrl);
    }
}
