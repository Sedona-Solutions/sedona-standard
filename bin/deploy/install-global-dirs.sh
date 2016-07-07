#!/bin/bash

echo "Managing symbolic links"
pwd=`pwd`

## PARAMETERS.YML
if [ -n "$WEB_PARAMETERS" ]; then
    echo " using external parameters.yml in $WEB_PARAMETERS"
    touch $WEB_PARAMETERS
    ln -nsf $WEB_PARAMETERS app/config/parameters.yml
else
    echo " no WEB_PARAMETERS, create locally"
fi
composer run-script buildParameters

## LOGS
bin/deploy/add-external-dir.sh logs var/logs $WEB_LOGS

## CACHE
bin/deploy/add-external-dir.sh cache var/cache $WEB_CACHE

## SESSION
bin/deploy/add-external-dir.sh sessions var/sessions $WEB_SESSION
