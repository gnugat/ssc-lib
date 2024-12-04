#!/usr/bin/env sh

echo ''
echo '// Running tests...'

composer --quiet dump --optimize

vendor/bin/phpspec --no-interaction run -fdot #&& \
#    vendor/bin/phpunit && \
#    PHP_CS_FIXER_IGNORE_ENV=1 vendor/bin/php-cs-fixer fix --allow-risky=yes --dry-run
