FROM debian:10.4
MAINTAINER atlas <doroshuk33@yandex.by>
RUN apt-get update && apt-get -y upgrade \
    && apt-get -y install apache2 php7.3 php7.3-mysql  libapache2-mod-php7.3 git curl

RUN a2enmod php7.3
RUN a2enmod rewrite

COPY ./ /var/www/test/
COPY config/virtualhost.conf /etc/apache2/sites-available/

RUN a2ensite test.conf
EXPOSE 80

ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]
