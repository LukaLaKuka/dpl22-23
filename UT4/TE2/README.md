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

![DevLaravelPaquetesSoporte](./screenshots/DevLaravelPaquetesSoporte2.png)

Máquina de Producción

![ProLaravelPaquetesSoporte](./screenshots/ProLaravelPaquetesSoporte2.png)

</div>

### Aplicación

Una vez los módulos habilitados y composer instalado, ya podríamos crear el proyecto.

<div align='center'>

![DevLaravelComposeCreateProject](./screenshots/DevLaravelComposeCreateProject3.png)

![DevLaravelComposeListProject](./screenshots/DevLaravelComposeListProject4.png)

</div>

Ahora deberemos comproban si se instalado correctamente artisan, la interfaz en línea de comandos usada en Laravel:

<div align='center'>

![DevLaravelArtisanVersion](./screenshots/DevLaravelArtisanVersion5.png)

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

Deberemos fijar unos permisos a los ficheros del proyecto, para que los servicios de Nginx y PHP-FPM puedan acceder a ellos sin problema.

<div align='center'>

Máquina de Desarrollo

![DevLaravelPermisos](./screenshots/DevLaravelPermisos6.png)

Máquina de Producción

![ProLaravelPermisos](./screenshots/ProLaravelPermisos6.png)

</div>

Ahora haremos una configuración de virtual host Nginx para la aplicación que hagamos en Laravel:

<div align='center'>

Máquina de Desarrollo

![DevVirtualHost](./screenshots/DevVirtualHost7.png)

Máquina de Producción

![ProVirtualHost](./screenshots/ProVirtualHost7.png)

</div>

Añadí al fichero `/etc/hosts` el host para probar que Laravel esté correctamente desplegado en Nginx. 

Me pasé por `scp` el fichero `.env` (el que tiene las credenciales) para poder configurarlo para la base de datos del servidor de producción.

<div align='center'>

![scpEnv](./screenshots/scpEnv9.png)

</div>

A continuación voy a configurar el fichero .env en la máquina de producción:

<div align='center'>

![LaravelConf](./screenshots/ProLaravelEnvConf10.png)

</div>

Probamos a conectarnos a [laravel.travelroad.alu7410.arkania](http://laravel.travelroad.alu7410.arkania.es):


<div align='center'>

![ProLaravelConnect](./screenshots/ProLaravelConnect11.png)

</div>

### Lógica de negocio

A partir de ahora, trabajaremos en la máquina de desarrollo para modificar el comportamiento de la aplicación para cargar los datos y procesarlos (renderizarlos) en una plantilla que nosotros predefinamos.

Modificaremos ahora el fichero de las rutas de `routes/web.php` :

<div align='center'>

![DevRoutesConfiguration](./screenshots/DevRoutesConf12.png)

</div>

Y ahora escribiremos la plantilla que será en la que imprimiremos los datos. Esta se ubica en la carpeta `resources/views/` y crearemos 3 plantillas: `travelroad.blade.php`, `wished.blade.php` y `visited.blade.php`. En esta indicaremos dónde queremos ver qué valores queremos ver:


<div align='center'>

![DevTravelroadBlade](./screenshots/DevTravelroadBlade13.png)

![DevTravelroadBlade](./screenshots/DevVisitedBlade13.png)

![DevTravelroadBlade](./screenshots/DevWishedBlade13.png)

</div>


Y cuando nos conectamos mediante el navegador nos saldrá algo tal que así:

<div align='center'>

![DevTravelroadBladeNav](./screenshots/DevTravelroadBladeNav14.png)

![DevVisitedBladeNav](./screenshots/DevVisitedBladeNav14.png)

![DevWIshedBladeNav](./screenshots/DevWishedBladeNav14.png)

</div>

A tener en cuenta que la carpeta `vendor` no está incluída en el control de versiones (no preocuparse, ya que el propio framework de Laravel se encarga de añadirlo al gitignore.). Por lo que en la máquina de producción haremos un `composer instal` en el proyecto para poder instalar las dependencias necesarrias y crear esta carpeta que no se incluye en el control de versiones.












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

