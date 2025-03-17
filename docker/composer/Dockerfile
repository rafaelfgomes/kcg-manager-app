FROM composer:2.8.6

ARG UID
ARG GID
ARG TIMEZONE

RUN apk --no-cache update && apk add --no-cache shadow sudo

RUN groupadd -g ${GID} container && useradd -m -u ${UID} -g container admin

RUN echo "admin ALL=(ALL) NOPASSWD: ALL" > /etc/sudoers.d/admin && chmod 0440 /etc/sudoers.d/admin

RUN docker-php-ext-install pdo pdo_mysql

RUN ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime

WORKDIR /app

RUN chown -R admin:container .

USER admin

CMD ["tail", "-f", "/dev/null"]