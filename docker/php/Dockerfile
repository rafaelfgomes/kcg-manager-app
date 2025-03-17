FROM php:8.4.5-fpm-alpine

ARG UID
ARG GID
ARG TIMEZONE

RUN apk --no-cache update && apk add --no-cache build-base openssl-dev autoconf shadow sudo

RUN apk del build-base openssl-dev autoconf

RUN groupadd -g ${GID} container && useradd -m -u ${UID} -g container admin

RUN echo "admin ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/admin && chmod 0440 /etc/sudoers.d/admin

RUN docker-php-ext-install pdo pdo_mysql

RUN ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime

WORKDIR /var/www/html

RUN chown -R admin:container .

USER admin

EXPOSE 9000

CMD [ "php-fpm" ]
