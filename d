#!/usr/bin/env bash

DOCKER_COMPOSE_EXEC="docker compose"

if [ $# -gt 0 ]; then
    if [ "$1" == "php" ]; then
      shift 1
      $DOCKER_COMPOSE_EXEC exec -T php php "$@"
    elif [ "$1" == "composer" ]; then
      shift 1
      $DOCKER_COMPOSE_EXEC exec php bash -c "composer $@"
    elif [ "$1" == "init" ]; then
      shift 1

      cp .env.dist .env &&
        $DOCKER_COMPOSE_EXEC up -d &&
        ./d composer install &&
        sleep 10 &&
        yes | ./d php vendor/bin/doctrine-migrations migrations:migrate --configuration=config/migrations.yaml
    fi
fi