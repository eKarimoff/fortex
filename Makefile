artisan  = docker exec -it insurapro php artisan
composer = docker exec -it insurapro composer
compose  = docker compose

start:
	@$(compose) up -d
down:
	@$(compose) down
ssh:
	docker exec -it mysql bash
migrate:
	 @$(artisan) migrate
migrate-fresh:
	@$(artisan) migrate:fresh
seed:
	@$(artisan) db:seed
cache-clear:
	@$(artisan) cache:clear
config-clear:
	@$(artisan) config:clear
optimize:
	@$(artisan) optimize:clear
composer-install:
	@$(composer) install
auto-load:
	@$(composer) dump-autoload

clear: cache-clear config-clear optimize
restart: down start

