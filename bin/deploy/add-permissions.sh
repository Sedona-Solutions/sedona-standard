#!/bin/bash

if [ -n "$1" ]; then
    sudo setfacl -R -m u:www-data:rwX -m u:`whoami`:rwX $1
    sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx $1
else
    echo "ERROR: path missing"
    echo " usage: add-permissions <path>"
    exit 1
fi
