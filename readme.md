docker run -it --rm --volume $PWD/src:/app composer require kreait/firebase-php ^4.0

docker run -t -p 3000:80 -v $PWD/src:/var/www/html php:7.2-apache

docker run -t --rm -h kb-authservice.kamerbaas.nl -p 8081:80 -v $PWD/src:/var/www/html php:7.2-apache

info firebase-php: https://firebase-php.readthedocs.io/en/latest/authentication.html

//"storageBucket": "",