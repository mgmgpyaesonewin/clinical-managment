FROM nginx:stable-alpine

ADD ./nginx/default.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /var/www/html

RUN mkdir -p /etc/nginx/certs/

ADD ./nginx/certs/ /etc/nginx/certs/

RUN mkdir -p /etc/nginx/errors/