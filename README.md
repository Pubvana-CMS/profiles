[![Stable? Not Quite Yet](https://img.shields.io/badge/stable%3F-not%20quite%20yet-blue?style=for-the-badge)](https://packagist.org/packages/pubvana/profiles)
[![License](https://img.shields.io/packagist/l/pubvana/profiles?style=for-the-badge)](https://packagist.org/packages/pubvana/profiles)
[![PHP Version](https://img.shields.io/packagist/php-v/pubvana/profiles?style=for-the-badge)](https://packagist.org/packages/pubvana/profiles)
[![Monthly Downloads](https://img.shields.io/packagist/dm/pubvana/profiles?style=for-the-badge)](https://packagist.org/packages/pubvana/profiles)
[![Total Downloads](https://img.shields.io/packagist/dt/pubvana/profiles?style=for-the-badge)](https://packagist.org/packages/pubvana/profiles)
[![GitHub Issues](https://img.shields.io/github/issues/Pubvana-CMS/profiles?style=for-the-badge)](https://github.com/Pubvana-CMS/profiles/issues)
[![Contributors](https://img.shields.io/github/contributors/Pubvana-CMS/profiles?style=for-the-badge)](https://github.com/Pubvana-CMS/profiles/graphs/contributors)
[![Latest Release](https://img.shields.io/github/v/release/Pubvana-CMS/profiles?style=for-the-badge)](https://github.com/Pubvana-CMS/profiles/releases)
[![Contributions Welcome](https://img.shields.io/badge/contributions-welcome-blue?style=for-the-badge)](https://github.com/Pubvana-CMS/profiles/pulls)

# Pubvana Profiles

**I noticed folks downloading some of these packages. I'm super grateful, Thank You!  I would like to let folks know until this notice disappears I'm doing a lot of breaking changes without worrying about them.  Once versions are up around 0.5.x things should settle down.**

User profiles module for [Pubvana](https://pubvanacms.com). Built as a [Flight School](https://github.com/enlivenapp/flight-school) plugin. 

## Features

- Per-user profile records linked to Shield users
- Avatar support via the media picker widget
- Profile fields: display name, bio, avatar, website, Twitter, Facebook, LinkedIn
- Profile service mapped on `$app->profiles()`
- Registers an `adext` page contribution for user edit tabs when admin is present

## Requirements

- PHP 8.1+
- `enlivenapp/flight-school` 
- `enlivenapp/flight-shield` 
- `enlvienapp/migrations`
- `flightphp/active-record`

## Recommends

- `pubvana/admin` (Admin UI for user edit tabs and profile management)
- `pubvana/media` (for Avatar Image support)


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

Migrations package creates the `profiles` table automatically on first load.

## Flight School config

This package uses Flight School's return-array config format. `src/Config/Config.php` returns the package defaults as an array, Flight School stores that array under `pubvana.profiles` on `$app`, and the current public route prefix is defined there with `'routePrepend' => 'profile'`.


## Model

The package also exposes a service on `$app->profiles()` for common profile lookups and updates.

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
