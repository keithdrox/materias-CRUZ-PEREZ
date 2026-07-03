FROM php:8.3-apache

# Habilitar mod_rewrite para Apache
RUN a2enmod rewrite

# Instalar dependencias para PostgreSQL y PDO
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Configurar Apache DocumentRoot (apuntando a /var/www/html/src)
ENV APACHE_DOCUMENT_ROOT /var/www/html/src

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar el código fuente
COPY . /var/www/html/

# Ajustar permisos
RUN chown -R www-data:www-data /var/www/html
