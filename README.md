# mDoc API SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/digitonic/mdoc-api.svg?style=flat-square)](https://packagist.org/packages/digitonic/mdoc-api)
[![Build Status](https://img.shields.io/travis/digitonic/mdoc-api/master.svg?style=flat-square)](https://travis-ci.org/digitonic/mdoc-api)
[![Quality Score](https://img.shields.io/scrutinizer/g/digitonic/mdoc-api.svg?style=flat-square)](https://scrutinizer-ci.com/g/digitonic/mdoc-api)
[![Total Downloads](https://img.shields.io/packagist/dt/digitonic/mdoc-api.svg?style=flat-square)](https://packagist.org/packages/digitonic/mdoc-api)

This is the official Framework Agnostic PHP SDK to interact with the mDoc API. Although framework agnostic by nature, the package also includes configurations for working in Laravel.

# Package is currently in heavy development, be careful of use in production

## Installation

You can install the package via composer:

```bash
composer require digitonic/mdoc-api
```

### Laravel Usage

In Laravel >5.5 the package will auto register the service provider and facades.

## Usage

### Framework Agnostic Usage

**Please Note: You must obtain your API key from your account profile**

```php
$baseUrl = 'https://mdoc.it/api/1.0/';
$apiKey = 'KxDMt9GNVgu6fJUOG0UjH3d4kjZPTxFiXd5RnPhUD8Qz1Q2esNVIFfqmrqgB';
```

```php
    // Instantiate a new Guzzle client
    $guzzle = new \GuzzleHttp\Client([
        'base_uri' => $baseUrl,
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $apiKey
        ],
    ]);
```

```php
    // Instantiate a new mDoc API client with the Guzzle dependency.
    $mdocApi = new \Digitonic\MdocApi\Client($guzzle)
```

The mDoc API client can now be used as a dependency for communicating with various endpoints. for example, to get a list of all teams available to the API use you can use the following - 

```php
    $listTeams = new Digitonic\MdocApi\Teams\ListAllTeams($mdocApi);
    $response = $listTeams->send();
    
    dd($response);
```

All endpoints that return data will return data as a `\Illuminate\Support\Collection`. This will provide various utility methods when searching the response. For more information on Laravel Collections see [https://laravel.com/docs/5.8/collections](https://laravel.com/docs/5.8/collections). Please note, this package does not require the full Laravel framework to be used.

```php
Collection {#548 ▼
  #items: array:2 [▼
    "data" => array:3 [▼
      0 => {#597 ▼
        +"uuid": "45bdd45e-59e4-11e9-a656-0a586460061d"
        +"name": "Test Team 1"
        +"owner": "87671060-4f20-11e9-8e5f-0a5864600621"
        +"created_at": "2019-04-08 10:54:16"
        +"updated_at": "2019-04-08 10:54:16"
      }
      1 => {#595 ▼
        +"uuid": "cb886c4c-4f1d-11e9-b27f-0a5864600621"
        +"name": "Test Team 2"
        +"owner": "bea63aea-4f1d-11e9-a775-0a5864600621"
        +"created_at": "2019-03-25 16:48:19"
        +"updated_at": "2019-04-18 11:42:11"
      }
      2 => {#598 ▼
        +"uuid": "77f98560-5b76-11e9-8a31-0a5864600906"
        +"name": "Test Team 3"
        +"owner": "19bca08a-5b72-11e9-a205-0a586460090b"
        +"created_at": "2019-04-10 10:53:18"
        +"updated_at": "2019-04-10 10:53:18"
      }
    ]
    "meta" => {#585 ▼
      +"pagination": {#586 ▼
        +"total": 3
        +"count": 3
        +"per_page": 15
        +"current_page": 1
        +"total_pages": 1
        +"links": []
      }
    }
  ]
}
```

### Laravel Usage

In Laravel >5.5 the package will auto register the service provider. In Laravel <5.5 you must install this service provider.

```php
// config/app.php
'providers' => [
    ...
    Digitonic\MdocApi\MdocApiServiceProvider::class,
    ...
];
```

In Laravel >5.5 the package will auto register the facades. In Laravel 5.4 you must install **all** facades manually.

```php
// config/app.php
'aliases' => [
    ...
    'ListAllTeams' => Digitonic\MdocApi\Facades\Teams\ListAllTeams::class,
    'CampaignCreate'=> Digitonic\MdocApi\Facades\Campaigns\Create::class
    ...
];
```

You can publish the config file of this package with this command:

``` bash
php artisan vendor:publish --provider="Digitonic\MdocApi\MdocApiServiceProvider"
```

The following config file will be published in `config/mdoc-api.php`

```php
return [
    'base_url' => env('MDOC_BASE_URL', 'https://mdoc.it/api/1.0/'),
    
    'api_key' => env('MDOC_API_KEY', ''),
];
```

#### IoC container

The IoC container will automatically resolve the `MdocApi` dependencies for you when calling any endpoint. Which means you can just type hint your endpoint to retrieve the object from the container with all configurations in place.

```php
// From a constructor
class FooClass {
    public function __construct(Digitonic\MdocApi\Teams\ListAllTeams $listTeams) {
       $listTeams->send();
    }
}

// From a method
class BarClass {
    public function barMethod(Digitonic\MdocApi\Teams\ListAllTeams $listTeams) {
       $listTeams->send();
    }
}
```

Alternatively you may use the facades directly

```php
    ListAllTeams:send();
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email steven@digitonic.co.uk instead of using the issue tracker.

## Credits

- [Steven Richardson](https://github.com/digitonic)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).