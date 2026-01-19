# Symfony Landing Page Project

Проект на Symfony с Docker и CI/CD настройками.

## Требования

- Docker и Docker Compose
- Git
- Composer (опционально, для локальной разработки)

## Локальная разработка

### Запуск с Docker

1. Клонируйте репозиторий:
```bash
git clone <repository-url>
cd landing-docker
```

2. Запустите контейнеры:
```bash
docker-compose up -d
# или
make up
```

3. Установите зависимости:
```bash
docker-compose exec php composer install
# или
make composer-install
```

4. Откройте в браузере:
```
http://localhost:8083
```

### Использование Makefile

Для удобства работы с проектом доступны следующие команды:

```bash
make help               # Показать все доступные команды
make build              # Собрать Docker образы
make up                 # Запустить контейнеры
make down               # Остановить контейнеры
make restart            # Перезапустить контейнеры
make logs               # Показать логи
make shell              # Войти в PHP контейнер
make composer-install   # Установить зависимости
make cache-clear        # Очистить кеш Symfony
make cs-check           # Проверить код линтером
make cs-fix             # Исправить код линтером
make phpstan            # Запустить PHPStan
make test               # Запустить все проверки
```

### Остановка контейнеров

```bash
docker-compose down
# или
make down
```

### Просмотр логов

```bash
docker-compose logs -f
# или
make logs
```

### Пересобрать PHP контейнер

```bash
docker-compose build php
```

## CI/CD

Проект настроен на автоматический деплой при коммите в ветку `prod`.

### GitHub Actions Secrets

Для работы CI/CD необходимо настроить следующие secrets в GitHub:

- `SSH_PRIVATE_KEY` - Приватный SSH ключ для доступа к серверу
- `SSH_USER` - Пользователь для SSH подключения
- `SSH_HOST` - Хост сервера
- `SSH_DEPLOY_PATH` - Путь к проекту на сервере

### Процесс деплоя

При коммите в ветку `prod` автоматически выполняются:

1. Проверка кода линтером (PHP CS Fixer)
2. Статический анализ (PHPStan)
3. Валидация composer.json
4. Деплой на сервер по SSH
5. Очистка кеша
6. Перезапуск сервисов

### Ручной деплой

```bash
# На сервере
cd /var/www/html/landing
git pull origin prod
composer install --no-dev --optimize-autoloader
php bin/console cache:clear --env=prod
php bin/console cache:warmup --env=prod
```

## Линтеры и проверки

### PHP CS Fixer

Проверка стиля кода:
```bash
composer run cs-check
```

Автоматическое исправление:
```bash
composer run cs-fix
```

### PHPStan

Статический анализ кода:
```bash
composer run phpstan
```

## Разработка

### Очистка кеша

```bash
php bin/console cache:clear
```

### Просмотр маршрутов

```bash
php bin/console debug:router
```