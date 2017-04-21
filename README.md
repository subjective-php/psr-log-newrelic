# PSR Log NewRelic

[![Build Status](https://travis-ci.org/chadicus/psr-log-newrelic.svg?branch=master)](https://travis-ci.org/chadicus/psr-log-newrelic)
[![Code Quality](https://scrutinizer-ci.com/g/chadicus/psr-log-newrelic/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/chadicus/psr-log-newrelic/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/chadicus/psr-log-newrelic/badge.svg?branch=master)](https://coveralls.io/github/chadicus/psr-log-newrelic?branch=master)

[![Latest Stable Version](https://poser.pugx.org/chadicus/psr-log-newrelic/v/stable)](https://packagist.org/packages/chadicus/psr-log-newrelic)
[![Latest Unstable Version](https://poser.pugx.org/chadicus/psr-log-newrelic/v/unstable)](https://packagist.org/packages/chadicus/psr-log-newrelic)
[![License](https://poser.pugx.org/chadicus/psr-log-newrelic/license)](https://packagist.org/packages/chadicus/psr-log-newrelic)

[![Total Downloads](https://poser.pugx.org/chadicus/psr-log-newrelic/downloads)](https://packagist.org/packages/chadicus/psr-log-newrelic)
[![Monthly Downloads](https://poser.pugx.org/chadicus/psr-log-newrelic/d/monthly)](https://packagist.org/packages/chadicus/psr-log-newrelic)
[![Daily Downloads](https://poser.pugx.org/chadicus/psr-log-newrelic/d/daily)](https://packagist.org/packages/chadicus/psr-log-newrelic)

This is an implementation of [PSR-3](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md) reporting to [SobanVuex\NewRelic](http://soban.co/php-newrelic/).

## Requirements

PSR Log NewRelic requires PHP 7.0 (or later).

## Composer
To add the library as a local, per-project dependency use [Composer](http://getcomposer.org)! Simply add a dependency on `chadicus/psr-log-newrelic` to your project's `composer.json`.
```sh
composer require chadicus/psr-log-newrelic
```

## Contact
Developers may be contacted at:

 * [Pull Requests](https://github.com/chadicus/psr-log-newrelic/pulls)
 * [Issues](https://github.com/chadicus/psr-log-newrelic/issues)

## Run Unit Tests
With a checkout of the code get [Composer](http://getcomposer.org) in your PATH and run:

```sh
composer install
./vendor/bin/phpunit
