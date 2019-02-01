FROM ubuntu:18.10
MAINTAINER Tobias Kuendig <tobias@offline.swiss>

ENV DEBIAN_FRONTEND=noninteractiv

RUN apt-get update
RUN apt-get install -y software-properties-common && add-apt-repository ppa:ondrej/php
RUN apt-get update && apt-get -y install git curl apache2 php7.1 libapache2-mod-php7.1 php7.1-mysql php7.1-sqlite php7.1-mcrypt php7.1-xml php7.1-gd php7.1-zip unzip php7.1-mbstring php7.1-json php7.1-curl supervisor nodejs npm && apt-get -y autoremove && apt-get clean && rm -rf /var/lib/apt/lists/*


RUN /usr/sbin/a2enmod rewrite php7.1

ADD 000-laravel.conf /etc/apache2/sites-available/
RUN /usr/sbin/a2enmod ssl

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
RUN /usr/bin/curl -sS https://getcomposer.org/installer |/usr/bin/php
RUN /bin/mv composer.phar /usr/local/bin/composer
RUN /bin/chown www-data:www-data -R /var/www

WORKDIR /var/www

EXPOSE 80
EXPOSE 443

CMD ["apachectl", "-D", "FOREGROUND"]
