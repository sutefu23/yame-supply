up:
	docker-compose up -d
build:
	docker-compose build --no-cache --force-rm
laravel-install:
	docker-compose exec laravel composer create-project --prefer-dist laravel/laravel .
create-project:
	@make build
	@make up
	@make laravel-install
	docker-compose exec laravel php artisan key:generate
	docker-compose exec laravel php artisan storage:link
	docker-compose exec laravel chmod -R 777 storage bootstrap/cache
	@make fresh
install-recommend-packages:
	docker-compose exec laravel composer require doctrine/dbal "^2"
	docker-compose exec laravel composer require --dev ucan-lab/laravel-dacapo
	docker-compose exec laravel composer require --dev barryvdh/laravel-ide-helper
	docker-compose exec laravel composer require --dev beyondcode/laravel-dump-server
	docker-compose exec laravel composer require --dev barryvdh/laravel-debugbar
	docker-compose exec laravel composer require --dev roave/security-advisories:dev-master
	docker-compose exec laravel composer require --dev nunomaduro/larastan
	docker-compose exec laravel composer require --dev stechstudio/laravel-php-cs-fixer
	docker-compose exec laravel php artisan vendor:publish --provider="BeyondCode\DumpServer\DumpServerServiceProvider"
	docker-compose exec laravel php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"
breeze:
	docker-compose exec laravel composer require laravel/breeze --dev
vue-init:
	@breeze
	docker-compose exec laravel php artisan breeze:install vue
react-init:
	@breeze
	docker-compose exec laravel php artisan breeze:install react
init:
	docker-compose up -d --build
	docker-compose exec laravel composer install
	docker-compose exec laravel cp .env.example .env
	docker-compose exec laravel php artisan key:generate
	docker-compose exec laravel php artisan storage:link
	docker-compose exec laravel chmod -R 777 storage bootstrap/cache
	@make fresh
remake:
	@make destroy
	@make init
stop:
	docker-compose stop
down:
	docker-compose down --remove-orphans
restart:
	@make down
	@make up
migrate:
	docker-compose exec laravel php artisan migrate
fresh:
	docker-compose exec laravel php artisan migrate:fresh --seed
test:
	docker-compose exec laravel php artisan test
model-library-install:
	docker-compose exec laravel composer require --dev reliese/laravel
model:
# 要make model-library-install及びproviderへの登録
# 全DBからfield付きmodelを生成
	docker-compose exec laravel php artisan vendor:publish --tag=reliese-models
	docker-compose exec laravel php artisan config:clear
	docker-compose exec laravel php artisan code:models
analyse:
	docker-compose exec laravel ./vendor/bin/phpstan analyse
