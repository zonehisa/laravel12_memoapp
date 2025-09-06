# richarvey/nginx-php-fpmをベースとする
FROM richarvey/nginx-php-fpm:latest

COPY . .

# Image config
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

# Laravel config
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

# Allow composer to run as root
ENV COMPOSER_ALLOW_SUPERUSER 1

# Ensure database directory exists and has proper permissions
RUN mkdir -p /var/www/html/database && \
    mkdir -p /var/www/html/storage/framework/{cache,sessions,views} && \
    mkdir -p /var/www/html/storage/logs && \
    touch /var/www/html/database/database.sqlite && \
    chown -R www-data:www-data /var/www/html/storage && \
    chown -R www-data:www-data /var/www/html/database && \
    chmod -R 775 /var/www/html/storage && \
    chmod -R 775 /var/www/html/database && \
    chmod 664 /var/www/html/database/database.sqlite

CMD ["/start.sh"]
