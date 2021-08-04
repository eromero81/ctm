FROM centos:7
RUN yum update -y
RUN yum install -y \
  httpd \
  httpd-tools \
  wget \
  openssl \
  mod_ssl
RUN wget -q http://rpms.remirepo.net/enterprise/remi-release-7.rpm
RUN wget -q https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
RUN rpm -i remi-release-7.rpm epel-release-latest-7.noarch.rpm
RUN rm -rf remi-release* epel-release*
RUN yum-config-manager --enable remi-php74
RUN yum install -y \
  php \
  php-common \
  php-opcache \
  php-mcrypt \
  php-cli \
  php-gd \
  php-curl \
  php-psql \
  php-dom \
  php-mbstring \
  php-pdo_pgsql \
  php-mysql \
  php-zip \
  php-ldap \
  php-sqlite3 \
  php-pdo_sqlite

RUN yum remove wget -y
RUN yum clean all -y

WORKDIR /var/www

RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

RUN composer config -g repo.packagist composer https://packagist.org
RUN composer config -g github-protocols https

ARG ENV

RUN echo ${ENV}

ADD ./etc/httpd/conf.d/httpd.ctmtest.conf /etc/httpd/conf.d/httpd.ctmtest.conf

CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]
