<?php

declare(strict_types=1);

namespace Pubvana\Profiles\Controllers;

use Enlivenapp\FlightShield\Models\User;
use Pubvana\Admin\Controllers\PublicController;

/**
 * Public-facing profile controller — view any user, edit your own.
 */
class ProfilePublicController extends PublicController
{
    /**
     * View a user's public profile.
     */
    public function show(string $username): void
    {
        $user = $this->findUserByUsername($username);

        if ($user === null) {
            $this->app->halt(404, 'User not found');
            return;
        }

        $profile = $this->app->profiles()->findOrCreate((int) $user->id);

        $auth = $this->app->auth();
        $isOwner = $auth->loggedIn() && (int) $auth->user()->id === (int) $user->id;

        $this->render('profile', [
            'title'      => ($profile->display_name ?? $user->username) . "'s Profile",
            'profile'    => $profile,
            'user'       => $user,
            'isOwner'    => $isOwner,
            'avatar_url' => $this->publicAssetUrl($profile->avatar),
        ]);
    }

    /**
     * Edit form for own profile.
     */
    public function edit(string $username): void
    {
        $user = $this->findUserByUsername($username);

        if ($user === null) {
            $this->app->halt(404, 'User not found');
            return;
        }

        if ((int) $this->app->auth()->user()->id !== (int) $user->id) {
            $this->app->halt(403, 'You can only edit your own profile');
            return;
        }

        $profile = $this->app->profiles()->findOrCreate((int) $user->id);

        $this->render('profile_edit', [
            'title'   => 'Edit Profile',
            'profile' => $profile,
            'user'    => $user,
        ]);
    }

    /**
     * Save own profile.
     */
    public function update(string $username): void
    {
        $user = $this->findUserByUsername($username);

        if ($user === null) {
            $this->app->halt(404, 'User not found');
            return;
        }

        if ((int) $this->app->auth()->user()->id !== (int) $user->id) {
            $this->app->halt(403, 'You can only edit your own profile');
            return;
        }

        $post = $this->app->request()->data->getData();
        unset($post['_csrf_token']);

        $this->app->profiles()->updateProfile((int) $user->id, $post);

        $this->app->redirect('/profile/' . $username);
    }

    /**
     * Look up a user by username.
     */
    protected function findUserByUsername(string $username): ?User
    {
        $userModel = new User($this->app->get('db'));
        return $userModel->findByCredentials(['username' => $username]);
    }
}
