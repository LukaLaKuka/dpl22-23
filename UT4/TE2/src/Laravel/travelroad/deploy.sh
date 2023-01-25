#!/bin/bash

ssh tomasantela@arkania "
    cd /home/tomasantela/dev/dpl22-23/UT4/TE2/src/Laravel/travelroad
    git pull
    composer install
"