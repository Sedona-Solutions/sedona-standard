#!/bin/bash

echo "Migrage database..."
php bin/console doctrine:migrations:migrate -n

