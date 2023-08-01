cp .env.lumen ../lumen/.env
docker-compose up -d --build --force-recreate --always-recreate-deps 
docker-compose exec -T php /bin/sh -c "composer install && \
php artisan key:generate && \
php artisan storage:link && \
docker-compose stop
