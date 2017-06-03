#!/bin/sh

domain=vertilia-sample
dir=`dirname "$0"`

php $dir/../vendor/vertilia/nls/po2php.php $dir/../app/locale/en/$domain.po > $dir/../app/locale/en/$domain.php
php $dir/../vendor/vertilia/nls/po2php.php $dir/../app/locale/fr/$domain.po > $dir/../app/locale/fr/$domain.php

php $dir/../vendor/vertilia/nls/po2php.php $dir/../vendor/vertilia/locale/en/vertilia.po > $dir/../vendor/vertilia/locale/en/vertilia.php
php $dir/../vendor/vertilia/nls/po2php.php $dir/../vendor/vertilia/locale/fr/vertilia.po > $dir/../vendor/vertilia/locale/fr/vertilia.php
