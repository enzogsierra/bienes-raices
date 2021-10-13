# Bienes raíces


## Pre-requisitos
Tener instalado:
* Node.js
* MySQL
* PHP
* Composer

## Iniciando
Tienes que instalar las dependencias de **Node.js** y **Composer**; en la carpeta raíz del proyecto abre la terminal y escribe
```
npm install
```
Cuando finalice, escribe
```
composer install
```
------

Cada vez que abras el proyecto tendrás que correr el servidor PHP y las tareas de Gulp.

Para iniciar el servidor PHP escribe
```
cd .\public
php -S localhost:3000
```
El servidor se inicia en la carpeta "/public", que es donde se encuentra el archivo index.php.
En tu navegador ve a `http://localhost:3000` y tendrás la página cargada.


Luego, abre otra terminal y escribe
```
gulp
``` 
Este iniciará las tareas de gulp para compilar los archivos .sass, .js e imágenes que se encuentran en la carpeta "/src".

## Usuarios
Para crear un usuario con privilegios de administrador, ingresa al archivo "usuario.php" y lee la mini documentación.

## PHP
Para que InterventionImage pueda funcionar correctamente, es importante que agregues/habilites/cambies los siguientes valores en tu `php.ini`
````
extension=php_fileinfo.dll
extension=gd

upload_max_filesize = 40M
post_max_size = 40M
max_execution_time = 300
memory_limit = 128M
```