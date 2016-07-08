#!/bin/bash

# Try to find project name
COMPOSER=`cat composer.json`
[[ $COMPOSER =~ \"name\":[\ ]*\"([^\"]*)\" ]]
PROJECT=${BASH_REMATCH[1]//'/'/'-'}

if [ -n "$1" ]; then
    FILE=${1}
else
    if [ -z "$PROJECT" ]; then
        PROJECT=artefact
    fi
    NOW=$(date +"%Y%m%d-%H%M%S")
    FILE="${PROJECT}-${NOW}"
fi

echo "Build artefact ${FILE}..."
mkdir -p build
rm -f build/$FILE.tgz
composer install -o --no-scripts --prefer-dist
php bin/console assets:install -e prod
tar cfz build/$FILE.tgz . --transform s,^,${FILE}/, --exclude=build/*.tgz --exclude=var/* --exclude=app/config/parameters.yml --exclude=tests/* --exclude=installer --exclude=web/config.php
