FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

# ... (suas etapas anteriores de instalar extensões e copiar arquivos)

# Copia o script para a raiz do container e dá permissão de execução
COPY docker-entrypoint.sh /docker-entrypoint.sh
RUN chmod +x /docker-entrypoint.sh

# Altera o WORKDIR para a pasta onde está seu backend PHP
WORKDIR /var/www/html/backend

EXPOSE 80

# Comando crucial para o Docker usar o seu script em vez do padrão do Railway
ENTRYPOINT ["/docker-entrypoint.sh"]
