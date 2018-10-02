#!/usr/bin/env bash

# install dependencies
composer install

# clear and warmup app cache
bin/console cache:clear --env=prod
bin/console cache:warmup --env=prod

# run the app
bin/console server:run -vvv 0.0.0.0:8100
