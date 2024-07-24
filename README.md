# Proyecto Laravel

Este es el proyecto de prueba solicitado, a continuación estaran las intrsucciones de instalación

## Clonar el Repositorio

Para clonar el repositorio, utiliza el siguiente comando:

git clone https://github.com/david9805/pruebaLaravel-retail.git

### Instalar las dependencias

Despues nos vamos a posicionar sobre el proyecto con el siguiente comando:

cd pruebaLaravel-retail

Ahora con la siguiente instrucción instalaremos las dependencias:

composer install


#### Configurar entorno

para las variables de entorno ejecutamos el siguiente comando:

cp .env.example .env

##### Ejecutar migraciones

Para la creación de tablas debemos ejecutar las migraciones para ello vamos a ejecutar el siguiente código

php artisan migrate

###### Ejecutar proyecto

Despues de realizar los pasos anteriores, debemos ejecutar el siguiente comando para utilizar el proyecto:

php artisan serve
