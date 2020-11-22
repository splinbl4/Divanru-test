init: docker-down-clear docker-up divanru-init

docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

divanru-init: divanru-composer-install divanru-wait-db divanru-migrations divanru-fixture

divanru-composer-install:
	docker-compose run --rm divanru-php-cli composer install

divanru-wait-db:
	until docker-compose exec -T divanru-postgres pg_isready --timeout=0 --dbname=app ; do sleep 1 ; done

divanru-migrations:
	docker-compose run --rm divanru-php-cli php yii migrate --interactive=0

divanru-fixture:
	docker-compose run --rm divanru-php-cli php yii fixture "*" --interactive=0

divanru-test:
	docker-compose run --rm divanru-php-cli php vendor/bin/codecept run