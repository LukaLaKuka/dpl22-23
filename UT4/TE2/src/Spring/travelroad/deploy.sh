#!/bin/bash

ssh tomasantela@arkania "
    cd dev/dpl22-23
    git pull
    systemctl --user restart travelroad.service
"
