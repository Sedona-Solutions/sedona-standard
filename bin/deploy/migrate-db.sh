#!/bin/bash

echo "Migrate database..."
php bin/console doctrine:migrations:migrate -n

