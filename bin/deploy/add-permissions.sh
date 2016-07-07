#!/bin/bash

HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
CLIUSER=`whoami`

if [ $HTTPDUSER = $CLIUSER ]; then
    # Same user of http and cli, no need to add custom rights
    exit 0
fi

[[ 'root' = $CLIUSER ]] && sudo='' || sudo='sudo '

if [ -n "$1" ]; then
    $sudo setfacl -R -m u:$HTTPDUSER:rwX -m u:$CLIUSER:rwX $1
    $sudo setfacl -dR -m u:$HTTPDUSER:rwX -m u:$CLIUSER:rwX $1
else
    echo "ERROR: path missing"
    echo " usage: add-permissions <path>"
    exit 1
fi
