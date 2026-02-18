FROM php:8.2-apache

# Instala extensões necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ativa mod_rewrite
RUN a2enmod rewrite

RUN sed -i 's!/var/www/html!/var/www/html/App!g' /etc/apache2/sites-available/000-default.conf

# Define diretório padrão
WORKDIR /var/www/html

# Copia os arquivos do projeto
COPY . .

# Ajusta permissões
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
