# Auth library

## Simple

Configure a single username/password to login with. Useful in combination with basic auth middleware (`auth.basic:simple`).
```php
// config/auth.php

'guards' => [
    'simple' => [
        'driver'   => 'session',
        'provider' => 'simple',
    ],
],

'providers' => [
    'simple' => [
        'driver'   => 'gm:simple',
        'email'    => env('SIMPLE_AUTH_USER'),
        'password' => env('SIMPLE_AUTH_PASS'),
    ],
],
```
