FROM php:7.0-apache
LABEL vendor="Skatteverket SPAR"

EXPOSE 80

RUN apt-get update -y \
  && apt-get install -y \
    libxml2-dev \
    php-soap \
	git \
  && apt-get clean -y \
  && docker-php-ext-install soap


ADD src /var/www/html/
