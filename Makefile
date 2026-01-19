.PHONY: help build up down restart logs shell composer-install composer-update cache-clear

help: ## Показать эту справку
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

build: ## Собрать Docker образы
	docker-compose build

up: ## Запустить контейнеры
	docker-compose up -d

down: ## Остановить контейнеры
	docker-compose down

restart: ## Перезапустить контейнеры
	docker-compose restart

logs: ## Показать логи
	docker-compose logs -f

shell: ## Войти в PHP контейнер
	docker-compose exec php sh

composer-install: ## Установить зависимости через Composer
	docker-compose exec php composer install

composer-update: ## Обновить зависимости через Composer
	docker-compose exec php composer update

cache-clear: ## Очистить кеш Symfony
	docker-compose exec php php bin/console cache:clear

cs-check: ## Проверить код линтером
	docker-compose exec php composer run cs-check

cs-fix: ## Исправить код линтером
	docker-compose exec php composer run cs-fix

phpstan: ## Запустить PHPStan
	docker-compose exec php composer run phpstan

test: cs-check phpstan ## Запустить все проверки
