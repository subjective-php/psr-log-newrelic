# PSR Log NewRelic

[![Build Status](https://travis-ci.org/subjective-php/psr-log-newrelic.svg?branch=master)](https://travis-ci.org/subjective-php/psr-log-newrelic)
[![Code Quality](https://scrutinizer-ci.com/g/subjective-php/psr-log-newrelic/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/subjective-php/psr-log-newrelic/?branch=master)
[![Coverage Status](https://coveralls.io/repos/github/subjective-php/psr-log-newrelic/badge.svg?branch=master)](https://coveralls.io/github/subjective-php/psr-log-newrelic?branch=master)

[![Latest Stable Version](https://poser.pugx.org/subjective-php/psr-log-newrelic/v/stable)](https://packagist.org/packages/subjective-php/psr-log-newrelic)
[![Latest Unstable Version](https://poser.pugx.org/subjective-php/psr-log-newrelic/v/unstable)](https://packagist.org/packages/subjective-php/psr-log-newrelic)
[![License](https://poser.pugx.org/subjective-php/psr-log-newrelic/license)](https://packagist.org/packages/subjective-php/psr-log-newrelic)

[![Total Downloads](https://poser.pugx.org/subjective-php/psr-log-newrelic/downloads)](https://packagist.org/packages/subjective-php/psr-log-newrelic)
[![Monthly Downloads](https://poser.pugx.org/subjective-php/psr-log-newrelic/d/monthly)](https://packagist.org/packages/subjective-php/psr-log-newrelic)
[![Daily Downloads](https://poser.pugx.org/subjective-php/psr-log-newrelic/d/daily)](https://packagist.org/packages/subjective-php/psr-log-newrelic)

This is an implementation of [PSR-3](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md) reporting to [SobanVuex\NewRelic](http://soban.co/php-newrelic/).

## Requirements

PSR Log NewRelic requires PHP 7.0 (or later).

## Composer

To add the library as a local, per-project dependency use [Composer](http://getcomposer.org)! Simply add a dependency on `subjective-php/psr-log-newrelic` to your project's `composer.json`.
```sh
composer require subjective-php/psr-log-newrelic
```

## Contact

Developers may be contacted at:

 * [Pull Requests](../../pulls)
 * [Issues](../../issues)

## Run Build

With a checkout of the code get [Composer](http://getcomposer.org) in your PATH and run:

```sh
composer install
./vendor/bin/phpunit
./vendor/bin/phpcs
