#!/bin/bash

# EXAMPLE OF SCRIPT FOR INSTALL/UPDATE
# THIS SCRIPT SHOULD BE COPIED IN A GLOBAL DIRECTORY NEXT TO setenv_deploy

if [ $# -lt 1 ]; then
    echo "Usage:"
    echo " install.sh <artefact.tgz>"
    exit 1
fi

FILE=$1
DIR="${FILE%.*}"

if [ ! -f setenv_deploy ]; then
    echo "Error: setenv_deploy file missing"
    exit 2
fi

if [ ! -f $FILE ]; then
    echo "Error: source file $FILE does not exist"
    exit 3
fi

if [ -d $DIR ]; then
    echo "Error: directory $DIR already exist"
    exit 4
fi

if [ $DIR = $FILE ]; then
    echo "Error: $FILE should have an extension"
    exit 5
fi

source setenv_deploy

tar xfz $FILE && rm $FILE && cd $DIR && make -B update-prod
