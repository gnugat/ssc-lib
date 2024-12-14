#!/usr/bin/env bash

SHORT_HELP="$0 [-h] [-f]'"

while getopts ":hf" opt; do
    case $opt in
        h)
            echo 'Usage:'
            echo "  $SHORT_HELP"
            echo ''
            echo 'Options:'
            echo '  -f           Fix coding style'
            echo ''
            exit 0
            ;;
        f)
            echo ''
            echo '// Fixing CS...'
            echo ''

            vendor/bin/php-cs-fixer fix --allow-risky=yes
            exit 0
            ;;
        \?)
            echo '' >&2
            echo "    [KO] The \"-$OPTARG\" option does not exist" >&2
            echo '' >&2
            echo "    $SHORT_HELP" >&2
            echo '' >&2
            exit 1
            ;;
    esac
done
unset SHORT_HELP

echo ''
echo '// Running tests...'

composer --quiet dump --optimize
find . -name '*bak' -print -delete

vendor/bin/phpspec --no-interaction run -fdot && \
#    vendor/bin/phpunit && \
    vendor/bin/php-cs-fixer fix --allow-risky=yes --dry-run
