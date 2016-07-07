#!/bin/bash

echo "Create artefact..."
mkdir -p build
FILE=artefact.tgz
rm build/$FILE
composer install -o --no-scripts
tar cfz build/$FILE . --exclude=build/* --exclude=var/* --exclude=app/config/parameters.yml
