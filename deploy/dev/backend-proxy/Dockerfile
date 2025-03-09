FROM nginx:alpine

COPY ./deploy/dev/backend-proxy/nginx.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www

COPY ./backend /var/www