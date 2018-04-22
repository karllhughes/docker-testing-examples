# Enhancing Your Test Suite with Docker - Examples

This repository includes examples of how you can improve your test suite with Docker. Examples are in PHP or Node, and require you to have Docker installed locally.

Use the short instructions below, or check out the blog post (coming soon) for more details.

## Ex 1: Running PHPUnit tests in older version of PHP

- Navigate to `/ex-1` directory
- Install dependencies (using Docker and Composer): `docker run --rm -v $(pwd):/app -w /app composer install`
- Run PHPUnit in PHP 7.2: `docker run --rm -v $(pwd):/app -w /app php:7.2 vendor/bin/phpunit index.php` (should pass)
- Run PHPUnit in PHP 7.1: `docker run --rm -v $(pwd):/app -w /app php:7.1 vendor/bin/phpunit index.php` (should pass)
- Run PHPUnit in PHP 7.0: `docker run --rm -v $(pwd):/app -w /app php:7.0 vendor/bin/phpunit index.php` (should pass)
- Run PHPUnit in PHP 5.6: `docker run --rm -v $(pwd):/app -w /app php:5.6 vendor/bin/phpunit index.php` (should throw syntax error)

## Ex 2: Connecting to MySQL when missing database extension

- Navigate to `/ex-2` directory
- Install dependencies (using Docker and Composer): `docker run --rm -v $(pwd):/app -w /app composer install`
- Run a MySQL container to test connections on: `docker run --name database --rm -d -e MYSQL_ALLOW_EMPTY_PASSWORD=true mysql:5.7`
- Run PHPUnit in PHP 7.2: `docker run --rm -v $(pwd):/app -w /app --link database php:7.2 vendor/bin/phpunit index.php` (should fail)
- Build a custom image from Dockerfile (with mysqli extension): `docker build . -t php-72-mysqli`
- Run PHPUnit using custom image: `docker run --rm -v $(pwd):/app -w /app --link database php-72-mysqli vendor/bin/phpunit index.php` (should pass)
- Stop/remove the MySQL container when you're done: `docker rm -f database`

## Ex 3: Integration test with different versions of MySQL

- Navigate to `/ex-3` directory
- Install dependencies (using Docker and Composer): `docker run --rm -v $(pwd):/app -w /app composer install`
- Build the PHP/mysqli image from Dockerfile (same as in Ex 2): `docker build . -t php-72-mysqli`
- Run a MySQL 5.6 container to test with: `docker run --name database --rm -d -e MYSQL_ALLOW_EMPTY_PASSWORD=true -e MYSQL_DATABASE=test mysql:5.6`. Wait a few seconds for the container to boot.
- Run PHPUnit using custom image: `docker run --rm -v $(pwd):/app -w /app --link database php-72-mysqli vendor/bin/phpunit index.php` (should fail)
- Stop/remove the MySQL container: `docker rm -f database`
- Run a MySQL 5.7 container to test with: `docker run --name database --rm -d -e MYSQL_ALLOW_EMPTY_PASSWORD=true -e MYSQL_DATABASE=test mysql:5.7`. Wait a few seconds for the container to boot.
- Run PHPUnit using custom image: `docker run --rm -v $(pwd):/app -w /app --link database php-72-mysqli vendor/bin/phpunit index.php` (should pass)
- Stop/remove the MySQL container when you're done: `docker rm -f database`

## Ex 4: Seeding data with volumes

- Navigate to `/ex-4` directory
- Install dependencies (using Docker and Composer): `docker run --rm -v $(pwd):/app -w /app composer install`
- Build the PHP/mysqli image from Dockerfile (same as in Ex 2): `docker build . -t php-72-mysqli`
- Run a MySQL container with a bind mount: `docker run --name database --rm -d -e MYSQL_ALLOW_EMPTY_PASSWORD=true -v $(pwd)/data:/var/lib/mysql mysql:5.7`. Wait a few seconds for the container to boot.
- Run PHPUnit using custom image: `docker run --rm -v $(pwd):/app -w /app --link database php-72-mysqli vendor/bin/phpunit index.php` (should pass)
- Stop/remove the MySQL container when you're done: `docker rm -f database`

## Ex 5: NGinx network spins up and works

## Ex 6: Integration test for networked services

## Ex 7: Automating with Codeship
