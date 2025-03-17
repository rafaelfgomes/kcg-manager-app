FROM nginx:mainline-alpine

ARG PORT
ARG TIMEZONE

RUN ln -sf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime

WORKDIR /var/www/html

EXPOSE ${PORT}

ENTRYPOINT [ "nginx" ]

CMD [ "-g", "daemon off;" ]