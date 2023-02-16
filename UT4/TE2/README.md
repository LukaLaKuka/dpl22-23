# UT4-TE2: Administración de servidores web
___

## Índice:

1. [Laravel](#te21-laravel)
    - Instalación
        - [Instalación Composer](#instalar-composer)
        - [Instalar Paquetes de Soporte](#instalar-paquetes-de-soporte)
    - Desarrollo
        - [Aplicación - Laravel](#aplicación---laravel)
        - [Configuración Nginx](#configuración-nginx---Laravel)
        - [Lógica de Negocio](#lógica-de-negocio---Laravel)
    - Seguridad
        - [Certificación](#certificación---Laravel)

2. [Express](#te22-express)
    - Instalación
        - [Instalación](#instalación---express)
    - Aplicación
        - [Aplicación](#aplicación---express)
        - [Configuración de base de datos](#configuración-base-de-datos---express)
        - [Lógica de negocio](#lógica-de-negocio---express)
    - Despliegue
        - [Gestión de procesos](#gestionando-procesos---express)
        - [Configuración de Nginx](#configuración-de-nginx---express)
        - [Script de Despliegue](#script-de-despliegue---express)
    - Seguridad
        - [Certificación](#certificación---express)

3. [Spring](#te23-spring)
    - Instalación
        - [JDK](#jdk)
        - [SDKMAN](#sdkman)
        - [Spring-Boot](#spring-boot)
        - [Maven](#maven)
    - Aplicación
        - [Proceso de construcción](#proceso-de-construcción)
        - [Entorno de producción](#entorno-de-producción---spring)
    - Despliegue
        - [Configuración Nginx](#configuración-de-nginx---spring)
        - [Acceso a la aplicación web](#acceso-a-la-aplicación-web---spring)
        - [Script de Despliegue](#script-de-despliegue---spring)
    - Seguridad
        - [Certificación](#certificación---spring)

4. [Django](#te25-django)
    - Instalación
        - [Instalación Python](#instalación---python)
        - [Instalación Django](#instalación---django)
    - Aplicación
        - [Aplicación](#aplicación---django)
            - [Acceso a la base de Datos](#acceso-a-la-base-de-datos---django)

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

### Aplicación - Laravel

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

### Configuración Nginx - Laravel

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

### Lógica de negocio - Laravel

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

Con esto ya podremos usar nuestro script para pullear el repositorio en la máquina de producción.

Hay tener en cuenta que la carpeta `vendor` no está incluída en el control de versiones (no preocuparse, ya que el propio framework de Laravel se encarga de añadirlo al gitignore.). Por lo que en la máquina de producción haremos un `composer install` en el proyecto para poder instalar las dependencias necesarias y crear esta carpeta que no se incluye en el control de versiones:

<div align='center'>

![ProComposerInstall](./screenshots/ProComposerInstall15.png)

![ProComposerInstallOutput](./screenshots/ProComposerInstall16.png)

</div>

Realizaremos a continuación el script de despliegue [deploy.sh](./src/Laravel/travelroad/deploy.sh)

<div align='center'>

![deploySh](./screenshots/deploySh17.png)

</div>

Y le damos permisos de ejecución al script:

<div align='center'>

![chmodDeploy](./screenshots/chmodDeploy18.png)

</div>

Y lo ejecutamos:

<div align='center'>

![LaravelDeployment](./screenshots/LaravelDeployment19.png)

</div>

### Certificación - Laravel

A continuación haremos la certificación del virtual host con Certbot:

<div align='center'>

![Laravel Certbot](./screenshots/LaravelCertbot.png)

</div>

Haremos restart al servicio de Nginx y ya debería estar certificado:

<div align='center'>

![LaravelNginxRestart](./screenshots/LaravelNginxRestart21.png)

</div>

<div align='center'>

![Laravel Final](./screenshots/ProLaravelFinal22.png)

![Laravel Final Visited](./screenshots/ProLaravelFinalVisited22.png)

![Laravel Final Wished](./screenshots/ProLaravelFinalWIshed22.png)

</div>

___

## TE2.2 EXPRESS

<div align='center'>

![ExpressLogo](./images/expressLogo.png)

</div>

Express es un framework web para desarrollar con NodeJS.

### Instalación - Express

En mi caso ya tenía instalado NodeJS y npm en la máquina de Desarrollo, por lo que mostraré el proceso de instalación solo con la máquina de producción.

Primero nos haremos un curl de la última versión de NodeJS y le daremos los permisos de root:

<div align='center'>

![ExpressCurlVersion](./screenshots/ProExpressCurlVersion23.png)

</div>

E instalamos NodeJS

<div align='center'>

![ExpressInstall](./screenshots/ProExpressInstall24.png)

![NodeVersion](./screenshots/ProExpressNodeVersion25.png)

</div>

### Aplicación - Express

A continuación, conn el gestor de dependencias de NodeJS (npm), instalaremos las dependencias necesarias para poder trabajar con el framework de `Express`.

<div align='center'>

![ExpressInstall](./screenshots/DevExpressInstall26.png)

</div>

Ahora si podemos crear nuestro proyecto. Lo crearé en la carpeta [Express](./src/Express/):

<div align='center'>

![ExpressStartProject](./screenshots/ExpressStartProject27.png)

</div>

El último comando debió generar una estructura de carpetas tal que así:

<div align='center'>

![ExpressTree](./screenshots/ExpressTree28.png)

</div>

Por lo que ahora debemos instalar las dependencias necesarias para poder trabajar con express (importante hacerlo dentro de la carpeta del proyecto de express):

<div align='center'>

![ExpressNPMInstall](./screenshots/DevExpressNPMInstall29.png)

</div>

Ahora podremos probar la aplicación en el equipo de desarrollo, que abrirá el puerto 3000 para que podamos probar nuestra aplicación:

<div align='center'>

![DevExpressDebug](./screenshots/DevExpressDebug30.png)

![DevExpressDebugConnect](./screenshots/DevExpressDebugConnect31.png)

</div>

### Configuración Base de Datos - Express

A continuación configuraremos nuestro proyecto de Express para poder acceder a la base de datos de travelroad montada con PostgreSQL, que para poder acceder a esta, deberemos instalar una dependencia adicional llamada node-postgres. Realizaremos la instalación con nuestro gestor de dependencias `npm`.

<div align='center'>

![DevExpressPGInstall](./screenshots/DevExpressPGInstall32.png)

</div>

Nos interesa guardar las credenciales en un fichero independiente, por lo que trabajaremos con un ficheri `.env` con lo que necesitaremos en el paquete dotenv, paquete que tenemos que instalar también como dependencia:

<div align='center'>

![DevExpressDotenvInstall](./screenshots/DevExpressDotenvInstall33.png)

</div>

En el fichero `.env` guardaremos los datos para la conexión a la base de datos. Como en nuestro caso estamos trabajando en la máquina de Desarrollo, usaremos la base de datos que tenemos en la máquina de Desarrollo.

<div align='center'>

![DevExpressSaveEnv](./screenshots/DevExpressSaveEnv34.png)

Esto habría que hacerlo en la máquina de producción también.

</div>

### Lógica de negocio - Express

Ya tenemos creado nuestro fichero `.env` con las credenciales de nuestra base de datos de desarrollo, a continuación tendremos que configurar la conexión para poder cargar los datos y mostrarlos en una plantilla.

Primero crearemos una carpeta `config` en nuestro proyecto, junto a un fichero llamado `database.js`.

<div align='center'>

![DevExpressConfigCreate](./screenshots/DevExpressConfigCreate35.png)

Fichero `database.js`

![DevExpressConfig](./screenshots/DevExpressConfigDatabase36.png)

</div>

A continuación gestionaremos las rutas modificando el fichero `routes/index.js`

<div align='center'>

![DevExpressRoutes](./screenshots/DevExpressRoutes37.png)

</div>

A continuación crearemos nuestras plantillas deseadas en la ruta `views/` y crearemos los ficheros con las plantillas deseadas. Si nos fijamos en la anterior captura, en donde dice `res.render` introducimos 2 parámetros, el primero es la plantilla que tenemos que procesar y el segundo las variables que queremos "exportar" a la plantilla para poder introducirlos.

Tendremos que hacer la plantilla `index.pug`, `wished.pug` y `visited.pug`.

<div align='center'>

Plantilla Index

![DevExpressIndexView](./screenshots/DevExpressIndexView38.png)

Plantilla Wished

![ProExpressIndexView](./screenshots/DevExpressWishedView38.png)

Plantilla Visited

![ProExpressIndexView](./screenshots/DevExpressWishedView38.png)

</div>

Una vez hemos terminado de diseñar las plantillas para nuestra aplicación, vamos a probar si funcionan correctamente en la máquina de Desarrollo:

<div align='center'>

Salida de terminal:

![DevExpressTravelroadTest](./screenshots/DevExpressTravelroadTest39.png)

Web:

![DevExpressTravelroadTestWeb](./screenshots/DevExpressTravelroadTestWeb40.png)

</div>

Como podemos apreciar, simplemente falta corregir un pequeño salto de línea de la plantilla

<div align='center'>

![DevExpressIndexViewCorrect](./screenshots/DevExpressIndexViewCorrect41.png)

Index

![DevExpressIndexWeb](./screenshots/DevExpressIndexWeb42.png)

Visited

![DevExpressVisitedWeb](./screenshots/DevExpressVisitedWeb42.png)

Wished

![DevExpressWishedWeb](./screenshots/DevExpressWishedWeb42.png)

</div>

### Gestionando Procesos - Express

Si nos fijamos con detalle, para poder poner la aplicación en funcionamiento tenemos que dar de alta a la aplicación desde una terminal y dejar un proceso en la terminal directamente. Esto no es lo idílico, ya que los procesos pueden morir y habría que iniciarlos de nuevo, algo que no es admisible para un servidor web.

A continuación trabajaremos en la máquina de producción para poder configurar un paquete para NodeJS para poder controlar los procesos de nuestra aplicación en NodeJS.

Lo primero será instalar el gestor de procesos, que nosotros usaremos `pm2`.

<div align='center'>

![ProExpressPM2Install](./screenshots/ProExpressPM2Install43.png)

</div>

Ahora accederemos a la carpeta de nuestro proyecto [Express](./src/Express/travelroad) y ejecutamos `pm2`

<div align='center'>

![ProExpressPM2Start](./screenshots/ProExpressPM2Start44.png)
![ProExpressPM2Start2](./screenshots/ProExpressPM2Start2-44.png)

</div>

### Configuración de Nginx - Express

Lo último sería configurar el virtual host en Nginx para conectarnos al proceso de Node.JS

Vamos a crear el virtual host correspondiente para express:

<div align='center'>

![ProExpressVirtualHost](./screenshots/ProExpressVirtualHost45.png)

</div>

Y ya nos podemos conectar tras haber recargado nginx:

<div align='center'>

![ProExpressConnect](./screenshots/ProExpressConnect46.png)

</div>

### Script de Despliegue - Express

Tenemos que preparar un script de despliegue que actualize los cambios hechos en el repositorio en nuestra máquina de producción y volver a iniciar el proceso de `pm2`

<div align='center'>

![DevExpressDeployScript](./screenshots/DevExpressDeployScript48.png)

</div>

### Certificación - Express

<div align='center'>

![ProExpressCertification](./screenshots/ProExpressCertification.png)

</div>

___

## TE2.3 SPRING

<div align='center'>

![SpringLogo](./images/springLogo.png)

</div>

Spring es un framework web para el desarrollo de aplicaciones web en Java.

### Instalación - Spring

#### JDK

Lo primero debemos instalar el Java Development Kit, por lo que primero descargaremos el paquete del OpenJDK:

<div align='center'>

Máquina de Desarrollo

![DevSpringCurl](./screenshots/DevSpringCurl49.png)

Máquina de Producción

![ProSpringCurl](./screenshots/ProSpringCurl49.png)

</div>

A continuación descomprimimos el paquete en `/usr/lib/jvm`

<div align='center'>

Máquina de Desarrollo

![DevSpringUnPack](./screenshots/DevSpringUnPack50.png)

Máquina de Producción

![ProSpringUnPack](./screenshots/ProSpringUnPack50.png)

</div>

Nuestro sistema no sabe dónde tenemos descargados los ejecutables de JAVA, por lo que a continuación deberemos indicarle al sistema dónde tenemos guardados esos ficheros. A continuación modificaremos el fichero `/etc/profile.d/jdk_home.sh`.

<div align='center'>

![DevSpringJdkHome](./screenshots/DevSpringJdkHome51.png)

</div>

Ahora actualizaremos las alternativas para los ejecutables:

<div align='center'>

Máquina de Desarrollo

![DevSprngUpdateAlternatives](./screenshots/DevSpringUpdateAlternatives52.png)

Máquina de Producción

![ProSpringUpdateAlternatives](./screenshots/ProSpringUpdateAlternatives52.png)

</div>

Ya tenemos instalados el intérprete de java y su compilador respectivamente.

#### SDKMAN

SDKMAN es una herramienta para la gestión de versiones de kits de desarrollo.

Primero instalaremos el paquete `zip` en el sistema.

<div align='center'>

Máquina de Desarrollo

![DevSpringZip](./screenshots/DevSpringZIP53.png)

Máquina de Producción

![ProSpringZip](./screenshots/ProSpringZIP53.png)

</div>

SDKMAN nos dan un script de instalación que nos configura todo automáticamente, por lo que simplemente haremos un curl de ese script:

<div align='center'>

Máquina de Desarrollo

![DevSpringSDKCurl](./screenshots/DevSpringSDKCurl54.png)

Máquina de Producción

![ProSpringSDKCurl](./screenshots/ProSpringSDKCurl54.png)

</div>

A continuación activamos el punto de entrada:

<div align='center'>

Máquina de Desarrollo

![DevSpringPuntoEntrada](./screenshots/DevSpringPuntoEntrada.png)

Máquina de Producción

![ProSpringPuntoEntrada](./screenshots/ProSpringPuntoEntrada.png)

</div>

Ya comprobamos si el SDK está instalado:

<div align='center'>

Máquina de Desarrollo

![DevSpringSDKVersion](./screenshots/DevSpringSDKVersion56.png)

Máquina de Producción

![ProSpringSDKVersion](./screenshots/ProSpringSDKVersion56.png)

</div>

#### Spring Boot

Ahora que tenemos instalado SDK, podemos instalar Spring Boot, un subproyecto que nos facilita el despliegue de aplicaciones en producción.

<div align='center'>

Máquina de Desarrollo

![DevSpringBootInstall](./screenshots/DevSpringBootInstall57.png)

Máquina de Producción

![ProSpringBootInstall](./screenshots/ProSpringBootInstall57.png)

</div>

Y comprobamos versión:

<div align='center'>

Máquina de Desarrollo

![DevSpringVersion](./screenshots/DevSpringVersion58.png)

Máquina de Producción

![ProSpringVersion](./screenshots/ProSpringVersion58.png)

</div>

#### Maven

Maven es una herramienta para la construcción de proyectos en Java y gestión de las dependencias.

Primero vamos a instalar Maven con SDK:

<div align='center'>

Máquina de Desarrollo

![DevSpringMavenInstall](./screenshots/DevSpringMavenInstall59.png)

Máquina de Producción

![ProSpringMavenInstall](./screenshots/ProSpringMavenInstall59.png)

</div>

<div align='center'>

Máquina de Desarrollo

![DevSpringMavenVersion](./screenshots/DevSpringMavenVersion60.png)

Máquina de Producción

![ProSpringMavenVersion](./screenshots/ProSpringMavenVersion60.png)

</div>

### Aplicación - Spring

A continuación vamos a crear nuestro proyecto en Spring, por lo que voy a crear el proyecto en la carpeta [src/Spring](./src/Spring/)

<div align='center'>

![DevSpringInit](./screenshots/DevSpringInit61.png)

![DevSpringTravelroadTree](./screenshots/DevSpringTravelroadTree62.png)

</div>

Ahora nos dirigiremos a la parte `main` de nuestro proyecto, que es donde escribiremos nuestro código.

Nos crearemos las siguientes carpetas:

| Carpeta | Utilidad |
| --- | --- |
| Controllers | Aquí guardaremos los controladores de nuestro proyecto |
| Models | Aquí guardaremos los modelos de nuestro proyecto |
| Repositories | // PENDIENTE |

Y un fichero para cada carpeta.

<div align='center'>

![DevSpringDIRs](./screenshots/DevSpringDIRs63.png)

</div>

Falta añadir las templates wished y visited:

<div align='center'>

![DevSPringTemplates](./screenshots/DevSpringTemplates64.png)

</div>


A continuación modificaremos los ficheros que hemos creado:

<div align='center'>

Controlador

![DevSpringController](./screenshots/DevSpringController65.png)

Modelo

![DevSpringModel](./screenshots/DevSpringModel65-1.png)
![DevSpringModel](./screenshots/DevSpringModel65-2.png)

Repositorio

![DevSpringRepository](./screenshots/DevSpringRepository65.png)

Templates

![DevSpringTemplateHome](./screenshots/DevSpringTemplateHome65.png)
![DevSpringTemplateHome](./screenshots/DevSpringTemplateVisited65.png)
![DevSpringTemplateHome](./screenshots/DevSpringTemplateWished65.png)

</div>

Previamente instalamos Maven, que es nuestro gestor de dependencias. Por tanto debemos definir estas en un fichero llamado [pom.xml](./src/Spring/travelroad/pom.xml).

Para definir las dependencias, debemos acceder al elemento `<dependencies>` y añadir:

```
<dependency>
    <groupId></groupId>
    <artifactId></artifactId>
</dependency>
```

<div align='center'>

![DevSpring](./screenshots/DevSpringPomConfig66.png)

</div>

A continuación vamos a incluir las credeniales de nuestra base de datos en el fichero `src/main/resources/application.properties`

<div align='center'>

![DevSpringProperties](./screenshots/DevSpringProperties67.png)

</div>

#### Proceso de construcción

A continuación deberemos hacer 2 pasos esenciales para poder procesar nuestros proyectos en Java.

Java se trata de un lenguaje compilado e interpretado, un híbrido, ya que debemos compilar los ficheros `.java` para convertirlos en unos ficheros `.class` y así el intérprete de Java pueda procesar estos ficheros.

Teniendo en cuenta lo anterior, observamos que el primer paso es compilar todos estos ficheros. Pero además debemos empaquetar todos estos ficheros compilados en un paquete para reducir almacenamiento y darle mayor unidad a los proyectos.

Entonces nos dirigimos al primer punto, compilar el proyecto. Maven nos trae una herramienta que se llama Maven Wrapper que nos facilita la construcción de los proyectos:

Para compilar el proyecto deberemos hacer un `mvnw compile` en la carpeta del proyecto:

<div align='center'>

![DevSpringMVNWCompile](./screenshots/DevSpringMVNWCompile68.png)

</div>

Con esto se nos creara una carpeta `.mvn/wrapper` en el proyecto, por lo que a continuación vamos a empaquetar todo el proyecto.

<div align='center'>

![DevSpringMVNWPackage](./screenshots/DevSpringMVNWPackage69.png)

</div>

Tras esto, se nos debería haber generado un fichero en la carpeta [target](./src/Spring/travelroad/target/) del proyecto llamado `travelroad-0.0.1-SNAPSHOT.jar`

<div align='center'>

![DevSpringTargetTree](./screenshots/DevSpringTargetTree70.png)

</div>

Dentro del empaquetado nos incluye un servidor de aplicaciones para Java que se puede usar en producción. Si ejecutamos el fichero empaquetado de nuestro proyecto [travelroad-0.0.1-SNAPSHOT.jar](./src/Spring/travelroad/target/travelroad-0.0.1-SNAPSHOT.jar) podremos acceder al `puerto 8080` en localhost para comprobar que la aplicación funciona con éxito:

<div align='center'>

![DevSpringJavaJarTravelroad](./screenshots/DevSpringJavaJarTravelroad71.png)

</div>

Y nos conectamos desde el navegador a `localhost:8080` y comprobamos que la aplicación se ejecutó con éxito:

<div align='center'>

![DevSpringTest](./screenshots/DevSpringTest72.png)

</div>

### Entorno de Producción - Spring

A continuación generaremos un script que nos facilite la ejecución de nuestra aplicación web:

<div align='center'>

![DevSpringRunSH](./screenshots/DevSpringRunSH73.png)

</div>

Y le tenemos que dar permisos de ejecución:

<div align='center'>

![DevSpringRunPriviligies](./screenshots/DevSpringRunPriligies74.png)

</div>

Una cosa importante, tras hacernos un pull a nuestra máquina de producción, deberíamos hacer un envío del fichero de credenciales.

<div align='center'>

![DevSpringSCP](./screenshots/DevSpringSCP75.png)

</div>

Adicionalmente, he modificado las credenciales a las que tengo en la máquina de producción.

Ahora en la máquina de producción generaremos un fichero de servicio para poder gestionarlo mediante systemd:

<div align='center'>

Máquina de Desarrollo

![ProSpringServiceDir](./screenshots/ProSpringServiceDir76.png)

Máquina de Producción

![ProSpringServiceConf](./screenshots/ProSpringServiceConf77.png)

</div>

A continuación deberemos habilitar el servicio para que se arranque automáticamente:

<div align='center'>

![ProSpringServiceEnable](./screenshots/ProSpringServiceEnable78.png)

</div>

En mi caso a la hora de intentar arrancar el servicio me da error porque me falta la carpeta target (incluída en el [.gitignore](./src/Spring/travelroad/.gitignore))

<div align='center'>

![ProSpringServiceError](./screenshots/ProSpringServiceError79.png)

</div>

Por lo que nos vamos a pasar por SCP la carpeta target para poder ejecutar nuestra app.

<div align='center'>

![DevSpringSCPTarget](./screenshots/DevSpringSCPTarget80.png)

</div>

Y en un principio debería de ejecutarse bien el servicio:

<div align='center'>

![ProSpringServiceRunning](./screenshots/ProSpringServiceRunning81.png)

</div>

### Configuración de Nginx - Spring

Ya simplemente nos falta configurar Nginx y así podemos tener la aplicación disponible:

<div align='center'>

![ProSpringNginxConf](./screenshots/ProSpringNginxConf82.png)

</div>

y hacemos un reload del servicio de Nginx:

<div align='center'>

![ProSpringNginxReload](./screenshots/ProSpringNginxReload83.png)

</div>

### Acceso a la aplicación web - Spring

Por alguna razón, al ejecutar el servicio de travelroad en spring, en lo que tarda en abrir el servidor de tomcat consume un alto % de la CPU, por lo que el sistema da un error al sistema:

<div align='center'>

![ProSPringServiceError](./screenshots/ProSpringServiceError84.png)

</div>

Intenté solucionarlo de distintas maneras, bajando la prioridad o consumo de la app pero sigue saltando error al cabo de 20 segundos de iniciar el servicio.

### Script de Despliegue - Spring

<div align='center'>

![DevSPringDeploySH](./screenshots/DevSpringDeploySH.png)

</div>

### Certificación - Spring

<div align='center'>

![ProSpringCertification](./screenshots/ProSpringCertification85.png)

</div>

___

## TE2.4 DJANGO

<div align='center'>

![DjangoLogo](./images/djangoLogo.png)

</div>

Django es un framework de desarrollo web para Python.

### Instalación - Python

En mi caso yo ya hice la instalación de `Python` y `pip` en un pasado en ambas máquinas para el despliegue de una interfaz para gestionar nuestra base de datos PostgreSQL.

Pero deberemos instalar el framework de Django:

#### Instalación - Django

Primero abriremos un entorno virtual de python:

<div align='center'>

![DevPyEnviroment](./screenshots/DevPyEnviroment86.png)

</div>

A continuación instalamos Django con la herramienta de python `pip` (ya la tenía instalada):

<div align='center'>

![DevPyDjangoInstall](./screenshots/DevPyDjangoInstall87.png)

![DevPyDjangoVersion](./screenshots/DevPyDjangoVersion88.png)

</div>

A continuación vamos a crear el proyecto travelroad:

<div align='center'>

![DevPyDjangoStart](./screenshots/DevPyDjangoStart89.png)

</div>

Podremos ejecutar el fichero `manage.py` para ejecutar un servidor de desarrollo en el puerto `8000`:

<div align='center'>

![DevPyRunSever](./screenshots/DevPyRunServer90.png)

![DevPyRunSever2](./screenshots/DevPyRunServer2-90.png)

</div>

### Aplicación - Django

A continuación en nuestro proyecto Django crearemos nuestra "aplicación" `places`:

<div align='center'>

![DevPyPlaceStart](./screenshots/DevPyPlaceStart91.png)

</div>

Django de serie no reconoce a `places` como aplicación, por lo que debemos indicarle a este que tome en cuenta a `places` modificando el fichero `main/settings.py`:

<div align='center'>

![DevPyPlaceConfig](./screenshots/DevPyPlaceConfig92.png)

</div>

#### Acceso a la base de datos - Django

Para poder acceder a la base de datos que tenemos en PostgreSQL, debemos instalar un paquete de soporte denominado psycopg para poder conectar Python con nuestra base de datos.

Cómo ya hicimos la instalación en persona, pues adjunto captura de la verificación de que ya está instalado:

<div align='center'>

![DevPyPsycopgInstall](./screenshots/DevPyPsycopgInstall92.png)

</div>

El error parece ser porque en un fichero `.venv/lib/python3.11/site-packages/setuptools/config/setupcfg.py` hay una línea que `license_file` cuando debería poner `license_files`?

Establecemos las credenciales a la base de datos en `main/settings.py`:

<div align='center'>

![DevPyDatabaseSettings](./screenshots/DevPyDatabaseSettings93.png)

</div>

Y comprobamos que todo esté correcto:

<div align='center'>

![DevPyCheck](./screenshots/DevPyCheck.png)

</div>

A continuación haremos el modelo, y el controlador para nuestra aplicación:

<div align='center'>

![DevPyModel](./screenshots/DevPyModel96.png)

![DevPyView](./screenshots/DevPyView96.png)

</div>

A continuación nos creamos una carpeta `places/templates/` y nos crearemos las plantillas que queremos renderizar:

<div align='center'>

Estructura: 

![DevPyTemplates](./screenshots/DevPyTemplates97.png)

Plantilla Index:

![DevPyTemplateIndex](./screenshots/DevPyTemplateIndex97.png)

Plantilla Visited:

![DevPyTemplateVisited](./screenshots/DevPyTemplateVisited97.png)

Plantilla Wished:

![DevPyTemplateWished](./screenshots/DevPyTemplateWished97.png)

</div>

A continuación deberíamos configurar el enrutamiento de nuestro proyecto en el fichero `places/urls.py`:

<div align='center'>

![DevPyURL](./screenshots/DevPyURL98.png)

</div>

y enlazarlo con el enrutamiento de nuestro `main/urls.py`:

<div align='center'>

![DevPyURLMain](./screenshots/DevPyURL99.png)

</div>

A continuación compronamos que todo esté instalado correctamente con un `python manage.py check`:

![DevPyCheck2](./screenshots/DevPyCheck.png)

Ahora una vez hemos comprobado que toda la sintaxis está correctamente, vamos a probar a ejecutar nuestro programa en local:

<div align='center'>

![DevPyRunServer](./screenshots/DevPyRunServer100.png)

![DevPyRunServer](./screenshots/DevPyRunServer101.png)

</div>

Cómo estamos cambiando entre máquinas, queremos poder modificar las credenciales de la base de datos en el proyecto en función a la máquina en la que estemos trabajando, por lo que deberemos instalar un paquete llamado `prettyconf` que nos permite cargar variables de entorno mediante un fichero de configuración:

<div align='center'>

![DevPyPrettyConfInstall](./screenshots/DevPyPrettyConfInstall102.png)

</div>

Y deberemos añadir al fichero de configuración la siguiente línea:

<div align='center'>

![DevPyPrettyConf](./screenshots/DevPyPrettyConf103.png)

</div>

Y comprobamos que todo esté en orden:

<div align='center'>

![DevPyCheck3](./screenshots/DevPyCheck3-104.png)

</div>

### Especificación de requerimientos

Deberíamos tener un fichero donde marquemos las dependencias de nuestro proyecto, por lo que en la misma carpeta del proyecto simplemente crearemos un fichero `requirements.txt` donde escribiremos las dependencias (django, prettyconf y psycopg2):

<div align='center'>

![DevPyRequirements](./screenshots/DevPyRequirements105.png)

</div>

### Entorno de producción:

