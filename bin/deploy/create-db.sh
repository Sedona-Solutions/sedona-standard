#!/bin/bash

echo "Create database..."
php bin/console doctrine:database:create
php bin/console doctrine:schema:create
