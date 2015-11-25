default: composer phplint test

composer:
	composer install

phplint:
	vendor/bin/parallel-lint src
	vendor/bin/parallel-lint tests

test:
	vendor/bin/phpunit -c tests/phpunit.xml tests/Lunchbot
