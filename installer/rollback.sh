#!/bin/bash

# EXAMPLE OF SCRIPT FOR ROLLBACK
# THIS SCRIPT SHOULD BE COPIED IN A GLOBAL DIRECTORY NEXT TO setenv_deploy

if [ $# -lt 1 ]; then
    echo "Usage:"
    echo " rollback.sh <directory>"
    exit 1
fi

DIR=$1

if [ ! -f setenv_deploy ]; then
    echo "Error: setenv_deploy file missing"
    exit 2
fi

if [ ! -d $DIR ]; then
    echo "Error: source file $FILE does not exist"
    exit 3
fi

source setenv_deploy

cd $DIR && make -B update-prod
