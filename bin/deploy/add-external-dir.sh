#!/bin/bash

if [ $# -ne 2 ]; then
    echo "Usage add-external-dir <name> <local_dir> <external_dir>"
    exit 1
fi

name=${1// }
local_dir=${2// }
external_dir=${3// }

if [ ! -z $external_dir ]; then
    echo " using external $name in $external_dir"
    if [ ! -d $external_dir ]; then
        sudo mkdir -p $external_dir
        bin/deploy/add-permissions.sh $external_dir
    fi
    ln -nsf $external_dir $local_dir
else
    echo " no global $name, create locally in $local_dir"
    mkdir -p $local_dir
    bin/deploy/add-permissions.sh $local_dir
fi

