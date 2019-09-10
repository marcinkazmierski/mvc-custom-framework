#!/bin/sh

docker-compose up -d
docker-compose exec app sh -c "composer install"

xdg-open http://localhost:8088/
docker-compose exec app bash