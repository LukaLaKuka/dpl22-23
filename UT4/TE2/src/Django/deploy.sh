#!/bin/bash

ssh arkania "
  cd /home/tomasantela/dev/UT4/TE2/src/Django
  git pull

  source .venv/bin/activate
  pip install -r requirements.txt
  # python manage.py migrate
  # python manage.py collectstatic --no-input

  supervisorctl restart travelroad
"