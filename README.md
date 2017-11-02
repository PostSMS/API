# PostSMS API SDK для PHP

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

Это SDK для сервиса отслеживания посылок PostSMS.by

Документация по API — http://docs.postsms.apiary.io/.


## Установка

Через composer

``` bash
$ composer require postsms/api
```

## Использование

``` php
<?php

require 'vendor/autoload.php';

use PostSMS\API\Client\Client;

// Ваши данные для входа в PostSMS:
$credentials = [
    'email' => 'user@site.by',
    'password' => '12345654321',
];

// Для «боевого» режима
$url = 'http://postsms.by/api/';

// Для режима «песочницы»
$url = 'http://sandbox.postsms.by/api/';

$client = new Client($credentials, $url);
```

Далее, можно выполнять запросы к API. Например:


``` php
...
use PostSMS\API\Entity\Sender;

// Получим список имен отправителей для СМС
$senders = (new Sender($client))->getAll();

```

## История изменений

Пожалуйста, смотрите [CHANGELOG](CHANGELOG.md) для более детальной информации по изменениям в SDK.

## Тестирование (TODO)

``` bash
$ composer test
```

## Участие в разработке и предложения по улучшению SDK

Пожалуйста, смотрите [CONTRIBUTING](CONTRIBUTING.md) и [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) для подробностей.

## Безопасность.

Если у вас есть какие-то замечания по безопасности, пожалуйста пишите на info@postsms.by вместо того, чтобы создавать заявку.

## Участники

- [Siarhei Bautrukevich][link-author]

## Лицензия

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/postsms/api.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/postsms/api/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/postsms/api.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/postsms/api.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/postsms/api.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/postsms/api
[link-travis]: https://travis-ci.org/postsms/api
[link-scrutinizer]: https://scrutinizer-ci.com/g/postsms/api/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/postsms/api
[link-downloads]: https://packagist.org/packages/postsms/api
[link-author]: https://github.com/bautrukevich
[link-contributors]: ../../contributors
