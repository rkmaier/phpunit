#!/bin/sh

cd /var/www > /dev/null 2>&1 &
echo "COMPOSER INSTALL"
composer install

exec "/bin/bash"