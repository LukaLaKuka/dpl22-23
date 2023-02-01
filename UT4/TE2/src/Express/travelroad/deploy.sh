#!/bin/bash

ssh tomasantela@arkania "
    cd ~/dev/dpl22-23/UT4/TE2/src/Express/travelroad
    git pull
    pm2 restart travelroad --update-env
"