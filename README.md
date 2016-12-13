# pnr

This package let's you handle swedish pnrs.

## Install

Via Composer

``` bash
$ composer require adaptivemedia/pnr
```

## Usage

``` php
require_once 'vendor/autoload.php';

$pnr = '198306030217';
$pnrService = new Adaptivemedia\Pnr\Pnr($pnr);

$formattedPnr = $pnrService->get8WithHyphen();
```

## Testing

``` bash
$ phpunit
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
