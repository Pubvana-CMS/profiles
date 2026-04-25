[![Version](http://poser.pugx.org/pubvana/profiles/version)](https://packagist.org/packages/pubvana/profiles)
[![License](http://poser.pugx.org/pubvana/profiles/license)](https://packagist.org/packages/pubvana/profiles)
[![PHP Version Require](http://poser.pugx.org/pubvana/profiles/require/php)](https://packagist.org/packages/pubvana/profiles)

# Pubvana Profiles

User profiles module for [Pubvana](https://pubvana.com). Built as a [Flight School](https://github.com/enlivenapp/flight-school) plugin. Adds profile fields (display name, bio, avatar, social links) to Shield users via the admin extension system.

## Features

- Self-service profile page at `/admin/profile`
- Profile tab injected into the admin user edit form via `adext`
- Avatar selection via the media picker widget
- Profile fields: display name, bio, avatar, website, Twitter, Facebook, LinkedIn

## Requirements

- PHP 8.1+
- `enlivenapp/flight-school` ^0.2
- `enlivenapp/flight-shield` ^0.1
- `pubvana/admin`

## Installation

```bash
composer require pubvana/profiles
```

Enable in `app/config/config.php`:

```php
'plugins' => [
    'pubvana/profiles' => [
        'enabled'  => true,
        'priority' => 70,
    ],
],
```

The migration creates the `profiles` table automatically on first load.

## How it works

### Self-service page

Logged-in admin users can edit their own profile at `/admin/profile`. The `ProfileController` finds or creates a profile row for the current user and renders the edit form.

### User edit tab

The plugin registers a **Profile** tab on the admin user edit page via `adext('page', 'users.edit.tabs', ...)`. When an admin edits any user, the profile fields appear as an additional tab. The tab callable returns field definitions — admin renders the form.

### Model

The `Profile` model provides:

- `findByUserId(int $userId)` — find a profile by user ID
- `findOrCreate(int $userId)` — find or create (lazy initialization)
- `updateFromArray(array $data)` — update allowed fields from form POST data

## Schema

| Column | Type | Notes |
|--------|------|-------|
| `id` | int | Primary key |
| `user_id` | int | Foreign key to `users` |
| `display_name` | varchar, nullable | |
| `bio` | text, nullable | |
| `avatar` | varchar, nullable | Path to media image |
| `website` | varchar, nullable | |
| `twitter` | varchar, nullable | |
| `facebook` | varchar, nullable | |
| `linkedin` | varchar, nullable | |
| `created_at` | datetime | |
| `updated_at` | datetime | |

## License

MIT
