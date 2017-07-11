# Hawkbit Datastream

Compressed binary data designed for inter-process communication.

## Features

- Keep data types as is
- Transfer collections and simple objects
- serialisation via JSON

## Install

### Using Composer

Datastream is available on [Packagist](https://packagist.org/packages/hawkbit/datastream) and can be installed using [Composer](https://getcomposer.org/). This can be done by running the following command or by updating your `composer.json` file.

```bash
composer require hawkbit/hawkbit
```

composer.json

```javascript
{
    "require": {
        "hawkbit/datastream": "~1.0"
    }
}
```

Be sure to also include your Composer autoload file in your project:

```php
<?php

require __DIR__ . '/vendor/autoload.php';
```

### Downloading .zip file

This project is also available for download as a `.zip` file on GitHub. Visit the [releases page](https://github.com/hawkbit/hawkbit/releases), select the version you want, and click the "Source code (zip)" download button.

### Requirements

The following versions of PHP are supported by this version.

* PHP 7.0
* PHP 7.1
* HHVM

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email <mjls@web.de> instead of using the issue tracker.

## Credits

- [Marco Bunge](https://github.com/mbunge)
- [All contributors](https://github.com/hawkbit/hawkbit/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
