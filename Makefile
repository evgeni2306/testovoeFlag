install: cp-env up nginx-restart  composer-install   migrate generate-key

up:
	@docker-compose up -d

composer-install:
	@docker-compose exec --user=www php composer install

migrate:
	@docker-compose exec --user=www php php artisan migrate

down:
	@docker-compose down

cp-env:
	@test -f .env || cp .env.example .env

generate-key:
	@docker-compose exec --user=www php php artisan key:generate

nginx-restart:
	@docker-compose restart nginx


