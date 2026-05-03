<?php

declare(strict_types=1);

namespace Pubvana\Profiles\Models;

/**
 * Profile ActiveRecord model.
 *
 * @property int         $id
 * @property int         $user_id
 * @property string|null $display_name
 * @property string|null $bio
 * @property string|null $avatar
 * @property string|null $website
 * @property string|null $twitter
 * @property string|null $facebook
 * @property string|null $linkedin
 * @property string      $created_at
 * @property string      $updated_at
 */
class Profile extends \flight\ActiveRecord
{
    public function __construct($pdo = null, array $config = [])
    {
        parent::__construct($pdo, 'profiles', $config);
    }

    /**
     * Find a profile by user ID.
     */
    public function findByUserId(int $userId): ?self
    {
        $this->reset();
        $this->eq('user_id', $userId)->find();

        return $this->isHydrated() ? $this : null;
    }

    /**
     * Find or create a profile for a user.
     */
    public function findOrCreate(int $userId): self
    {
        $profile = $this->findByUserId($userId);

        if ($profile !== null) {
            return $profile;
        }

        $now = (new \DateTimeImmutable())->format('Y-m-d H:i:s');

        $new = new self($this->getDatabaseConnection());
        $new->user_id    = $userId;
        $new->created_at = $now;
        $new->updated_at = $now;
        $new->insert();

        return $new;
    }

    /**
     * Find or create a profile, then update it from an array of field values.
     */
    public function updateProfile(int $userId, array $data): self
    {
        $profile = $this->findOrCreate($userId);
        $profile->updateFromArray($data);

        return $profile;
    }

    /**
     * Update profile fields from an associative array.
     */
    public function updateFromArray(array $data): void
    {
        $allowed = ['display_name', 'bio', 'avatar', 'website', 'twitter', 'facebook', 'linkedin'];

        foreach ($allowed as $field) {
            if (array_key_exists($field, $data)) {
                $this->$field = trim($data[$field]) ?: null;
            }
        }

        $this->updated_at = (new \DateTimeImmutable())->format('Y-m-d H:i:s');
        $this->save();
    }
}
