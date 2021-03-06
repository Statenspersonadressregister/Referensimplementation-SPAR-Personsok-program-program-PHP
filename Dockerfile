FROM php:7.4.20-apache
LABEL vendor="Skatteverket SPAR"

EXPOSE 80

RUN apt-get update -y \
  && apt-get install -y \
    libxml2-dev \
	git \
  && apt-get clean -y \
  && docker-php-ext-install soap


ADD src /var/www/html/
