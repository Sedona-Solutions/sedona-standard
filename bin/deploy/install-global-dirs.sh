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
if [ -n "$WEB_LOGS" ]; then
    echo " using external logs in $WEB_LOGS"
    sudo mkdir -p $WEB_LOGS
    bin/deploy/add-permissions.sh $WEB_LOGS
    ln -nsf $WEB_LOGS var/logs
else
    echo " no global WEB_LOGS, create locally"
    mkdir -p var/logs
    bin/deploy/add-permissions.sh var/logs
fi

## CACHE
if [ -n "$WEB_CACHE" ]; then
    echo " using external cache in $WEB_CACHE"
    sudo mkdir -p $WEB_CACHE
    bin/deploy/add-permissions.sh $WEB_CACHE
    ln -nsf $WEB_CACHE var/cache
else
    echo " no global WEB_CACHE, create locally"
    mkdir -p var/cache
    bin/deploy/add-permissions.sh var/cache
fi

## SESSION
if [ -n "$WEB_SESSION" ]; then
    echo " using external cache in $WEB_SESSION"
    sudo mkdir -p $WEB_SESSION
    bin/deploy/add-permissions.sh $WEB_SESSION
    ln -nsf $WEB_SESSION var/session
else
    echo " no global WEB_SESSION, create locally"
    mkdir -p var/session
    bin/deploy/add-permissions.sh var/session
fi
