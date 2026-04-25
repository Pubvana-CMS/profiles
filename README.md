[![Version](http://poser.pugx.org/pubvana/profiles/version)](https://packagist.org/packages/pubvana/profiles)
[![License](http://poser.pugx.org/pubvana/profiles/license)](https://packagist.org/packages/pubvana/profiles)
[![PHP Version Require](http://poser.pugx.org/pubvana/profiles/require/php)](https://packagist.org/packages/pubvana/profiles)

# Pubvana Profiles

User profiles module for [Pubvana](https://pubvanacms.com). Built as a [Flight School](https://github.com/enlivenapp/flight-school) plugin. 

## Features

- Per-user profile records linked to Shield users
- Avatar support via the media picker widget
- Profile fields: display name, bio, avatar, website, Twitter, Facebook, LinkedIn
- Registers an `adext` page contribution for user edit tabs when admin is present

## Requirements

- PHP 8.1+
- `enlivenapp/flight-school` 
- `enlivenapp/flight-shield` 
- `enlvienapp/migrations`
- `flightphp/active-record`

## Recommends

- `pubvana/admin` (The head for Pubvana headless)
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


## Model

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
