# Composer
    composer install -n

# Environment
    cp .env .env.local

# Run migration
    php bin/console doctrine:migrations:migrate

# Load fixtures
    php bin/console doctrine:fixtures:load --append

# Run tests
    php ./vendor/bin/phpunit --coverage-text
