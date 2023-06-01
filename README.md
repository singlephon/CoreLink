# CommonSource: CoreLink

[![Latest Version on Packagist](https://img.shields.io/packagist/v/singlephon/corelink.svg?style=flat-square)](https://packagist.org/packages/singlephon/corelink)
[![Total Downloads](https://img.shields.io/packagist/dt/singlephon/corelink.svg?style=flat-square)](https://packagist.org/packages/singlephon/corelink)

This project is a Laravel-based microservices architecture designed to allow easy communication between multiple applications through a centralized parent application. The parent application acts as a hub for communication between the child applications, allowing for efficient and streamlined data sharing across multiple services.

This architecture allows for easy scaling and maintenance of individual services without affecting the entire system. With the use of Serviceable and Syncable classes, this system can synchronize data across different applications, ensuring that all services remain up to date with the latest information.

Developers can easily extend this architecture by adding new services, implementing Serviceable and Syncable classes, and defining routes to handle data synchronization. Overall, this project provides an efficient and scalable solution for building microservices-based applications.

## Installation

1. Install **CoreLink** to Laravel project

```php
composer require singlephon/corelink
```

2. Publish neccessary files

```php
php artisan vendor:publish --provider="Singlephon\Corelink\CoreLinkServiceProvider"
```

3. Execute structure make command

```php
php artisan corelink:init
```

4. Migrate tables

```php
php artisan migrate
```

5. [Configure your **Nodelink** application (Install **NodeLink** package, configure **.env**)](https://github.com/bcorpj/NodeLink/blob/master/README.md)

6. Register NodeLink application

```php
php artisan corelink:register :URL :KEY
```

## Usage

```php
// Usage description here
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


### Security

If you discover any security related issues, please email singlephon@gmail.com instead of using the issue tracker.

## Credits

-   [Rakhat Bakytzhanov](https://github.com/singlephon)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.





