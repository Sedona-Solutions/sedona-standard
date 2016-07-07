#!/bin/bash

echo "Publishing to WEB_ROOT"
pwd=`pwd`

php bin/console cache:warm -e prod

if [ -n "$WEB_ROOT" ]; then
    ln -s $pwd "${WEB_ROOT}.new"
    mv -T "${WEB_ROOT}.new" $WEB_ROOT
else
    echo "No global WEB_ROOT, skipping"
fi
