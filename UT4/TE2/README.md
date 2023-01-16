# UT4-TE2: Administración de servidores web
___

## Índice:

1. Laravel
    - a
    - a
2. Express
    - a
    - a
3. Spring
    - a
    - a
4. Ruby on Rails
    - a
    - a
5. Django
    - a
    - a

___

## TE2.1 LARAVEL

<div align='center'>

![LaravelLogo](./images/laravelLogo.png)

</div>

Laravel es un framework web de código abierto para desarrollar aplicaciones y servicios web con PHP.

### Instalar Composer

Primero deberemos instalar un gestor de dependencias para PHP, Composer:

<div align='center'>

Máquina de Desarrollo

![DevComposerInstall](./screenshots/DevComposerInstall1.png)

Máquina de Producción

![ProComposerInstall](./screenshots/ProCOmposerInstall1.png)

</div>

### Instalar Paquetes de Soporte

Debemos hacer un `sudo apt update`.

Tendremos que instalar unos paquetes de soporte para poder habilitar algunos módulos PHP en el sistema:

<div align='center'>

Máquina de Desarrollo

![DevLaravelPaquetesSoporte](./screenshots/DevLaravelPaquetesSoporte.png)

Máquina de Producción

![ProLaravelPaquetesSoporte](./screenshots/ProLaravelPaquetesSoporte.png)

</div>

### Aplicación

Una vez los módulos habilitados y composer instalado, ya podríamos crear el proyecto.

<div align='center'>

![DevLaravelComposeCreateProject](./screenshots/DevLaravelComposeCreateProject.png)

![DevLaravelComposeListProject](./screenshots/DevLaravelComposeListProject.png)

</div>

Ahora deberemos comproban si se instalado correctamente artisan, la interfaz en línea de comandos usada en Laravel:

<div align='center'>

![DevLaravelArtisanVersion](./screenshots/DevLaravelArtisanVersion.png)

</div>

A continuación tendremos en la carpeta del proyecto un archivo de configuración `.env`, en este modificaremos algunos valores para especificar credenciales de acceso a la base de datos. IMPORTANTE NO SUBIR ESTE FICHERO AL CONTROL DE VERSIONES.

```
APP_NAME=TravelRoad
APP_ENV=development
...
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=travelroad
DB_USERNAME=travelroad_user
DB_PASSWORD=dpl5757
```

### Configuración Nginx

Actualmente voy a pushear el repositorio actual para poder pullear en la máquina de producción y también dejar los ajustes hechos.












___

## TE2.2 EXPRESS

<div align='center'

![ExpressLogo](./images/expressLogo.png)

</div>

___

## TE2.3 SPRING

<div align='center'

![SpringLogo](./images/springLogo.png)

</div>

___

## TE2.4 RUBY ON RAILS

<div align='center'

![RubyOnRailsLogo](./images/rorLogo.png)

</div>


___

## TE2.5 DJANGO

<div align='center'

![DjangoLogo](./images/djangoLogo.png)

</div>

