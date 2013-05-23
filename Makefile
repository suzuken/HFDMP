PHP_BIN = $(shell which php)

all: install

install:
	php composer.phar install

test:
	@echo "test stub"

ci: php-cs-fixer test

php-cs-fixer:
	$(PHP_BIN) php-cs-fixer.phar fix ./lib --level=all
	$(PHP_BIN) php-cs-fixer.phar fix ./t --level=all

start-supply:
	$(PHP_BIN) -S localhost:8081 -t public_html/s.php

