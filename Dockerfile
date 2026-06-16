FROM php:8.2-apache

# Instala extensões do PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql mysqli

# Habilita mod_rewrite do Apache
RUN a2enmod rewrite

# Copia todo o projeto para o diretório do Apache
COPY . /var/www/html/

# Permissões corretas
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Permite .htaccess
RUN echo '<Directory /var/www/html>\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' >> /etc/apache2/apache2.conf

# O Railway define a porta via variável de ambiente PORT
RUN sed -i 's/Listen 80/Listen ${PORT:-80}/' /etc/apache2/ports.conf \
    && sed -i 's/:80>/:${PORT:-80}>/' /etc/apache2/sites-enabled/000-default.conf

EXPOSE 80