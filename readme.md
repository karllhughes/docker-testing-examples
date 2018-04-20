# Enhancing Your Test Suite with Docker - Examples

This repository includes examples of how you can improve your test suite with Docker. Examples are in PHP or Node, and require you to have Docker installed locally.

Use the short instructions below, or check out the blog post (coming soon) for more details.

## Ex 1: Running PHPUnit tests in older version of PHP

- Navigate to `/ex-1` directory
- Install dependencies (using Docker and Composer): `docker run --rm -v $(pwd):/app -w /app composer install`
- Run PHPUnit in PHP 7.2: `docker run --rm -v $(pwd):/app -w /app php:7.2 vendor/bin/phpunit index.php ` (should pass)
- Run PHPUnit in PHP 7.1: `docker run --rm -v $(pwd):/app -w /app php:7.1 vendor/bin/phpunit index.php ` (should pass)
- Run PHPUnit in PHP 7.0: `docker run --rm -v $(pwd):/app -w /app php:7.0 vendor/bin/phpunit index.php ` (should pass)
- Run PHPUnit in PHP 5.6: `docker run --rm -v $(pwd):/app -w /app php:5.6 vendor/bin/phpunit index.php ` (should throw syntax error)

## Ex 2: Handling missing PHP extensions

## Ex 3: Integration test with older version of MySQL

## Ex 4: Seeding data with volumes

## Ex 5: NGinx network spins up and works

## Ex 6: Integration test for networked services

## Ex 7: Automating with Codeship
