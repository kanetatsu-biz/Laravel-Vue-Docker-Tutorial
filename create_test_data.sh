#!/bin/bash

docker-compose exec laravel php artisan migrate
docker-compose exec laravel php artisan db:seed --class=TaskSeeder