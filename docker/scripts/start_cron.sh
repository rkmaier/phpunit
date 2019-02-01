#!/usr/bin/env bash

echo "START CRON SIMULATION"
while [ true ]
do
  /usr/bin/php /var/www/artisan schedule:run --verbose --no-interaction
  sleep 60
done
