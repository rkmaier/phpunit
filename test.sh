#!/bin/bash

echo "RUN PHPUNIT"
echo "========================================================================"
docker exec -i server_1_test  ./vendor/bin/phpunit --verbose
echo "========================================================================"
echo "END PHPUNIT"

read -p 'Hit ENTER'