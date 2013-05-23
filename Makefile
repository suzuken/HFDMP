PHP_BIN = $(shell which php)

all: install

install: composer.phar
	php composer.phar selfupdate
	php composer.phar install

composer.phar:
	php -r "eval('?>'.file_get_contents('https://getcomposer.org/installer'));"


test:
	@echo "test stub"

ci: php-cs-fixer test

php-cs-fixer:
	$(PHP_BIN) php-cs-fixer.phar fix ./lib --level=all
	$(PHP_BIN) php-cs-fixer.phar fix ./t --level=all
