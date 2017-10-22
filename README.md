# pnr

This package let's you format Swedish national identification numbers.

## Install

Via Composer

``` bash
$ composer require adaptivemedia/pnr
```

## Usage

``` php
require_once 'vendor/autoload.php';

// Short format...
$pnr = '198306030217';
$pnrService = new SwedishPersonalNumber($pnr);
$formattedIdentificationNumber = $pnrService->format(); // 830603-0217

// Long format...
$formatter = SwedishPersonalNumber::FORMAT_LONG;
$pnrService = new SwedishPersonalNumber('830603-0217', new $formatter);

$formattedIdentificationNumber = $pnrService->format(); // 19830603-0217
```

## Testing

``` bash
$ phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
