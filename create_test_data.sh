#!/bin/bash

docker-compose exec laravel php artisan migrate:refresh
docker-compose exec laravel php artisan db:seed --class=TaskSeeder