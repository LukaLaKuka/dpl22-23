# Administración de Servidores Web

## Índice:

1. [Instalación](#instalación-del-módulo-ngx_small_light) del módulo [ngx_small_light](https://github.com/cubicdaiya/ngx_small_light) y cargarlo dinámicamente al servidor.
2. Creación de un [Virtual Host](#creación-del-virtual-host) que atiende peticiones en el dominio [images.alu7410.arkania.es](http://images.alu7410.arkania.es).
3. Creación de una [aplicación web](#aplicación-web) en JavaScript para tratar unas [imágenes predefinidas](https://github.com/Tomhuel/dpl22-23/tree/main/UT3/TE3/img).
4. [Redirigir](#redirecciones) el subdominio `www` al dominio base (en el puerto SSL). 
5. Incorporación del [certificado de seguridad CertBot](#certificación-de-seguridad).

___

## Instalación del módulo ngx_small_light

El módulo [ngx_small_light](https://github.com/cubicdaiya/ngx_small_light) es una herramienta para poder manipular las imágenes, con utilidades como redimensionar, rotar, bordear, cambio de formato de imágenes, ...

Este módulo lo queremos instalar dinámicamente para nuestra aplicación JavaScript, que va a trabajar con los bordes de las imágenes.

Inicialmente, debemos descargar el código fuente con la misma versión que tenemos instalada en el sistema, para posteriormente compilarlo junto al módulo:

```
curl -sL https://nginx.org/download/nginx-$(/sbin/nginx -v |& cut -d '/' -f2).tar.gz | tar xvz -C /tmp #Lo pondremos en la carpeta temporal
```

<div align="center">

![instalacionCodigoFuenteNginx](./screenshots/instalacionCodigoFuenteNginx.png)

</div>

El módulo de ngx_small_light tiene ciertas dependencias que requiere tenerlas instaladas previamente. Las dependencias que no tenemos isntaladas son la de ImageMagik y la de PCRE. Las instalaremos con el siguiente comando:

```
sudo apt install -y build-essential imagemagick libpcre3 libpcre3-dev libmagickwand-dev
```

Pero primero haremos un `sudo apt update`

<div align="center">

![sudoAptUpdate](./screenshots/sudoAptUpdate.png)

</div>

y posteriormente instalamos las dependencias:

<div align="center">

![historialInstalacionDependencias](./screenshots/historyDependenciesInstall.png)

</div>

Una vez las pdependencias instaladas, proseguiremos con la instalación del código fuente del módulo con el siguiente comando:

```
git clone https://github.com/cubicdaiya/ngx_small_light.git
```

<div align="center">

![gitCloneModuloNginx](./screenshots/gitCloneSmallLights.png)

</div>

Ahora nos dirigimos a la carpeta del repositorio de Nginx Small Lights y haremos un setup con el comando:

```
./setup
```

<div align="center">

![setupModulo](./screenshots/setupModulo.png)

</div>

Anteriormente, descargamos el código fuente de Nginx en la carpeta `/tmp`, por tanto, debemos dirigirnos ahí para poder añadir el módulo con el comando (aclarar que me tomó varios intentos porque estaba usando el de la propia documentación de ngx_small_light, que me daba problemas,  de ahí que la captura esté en CMD y que la carpeta del repositorio clonado esté en /tmp):

```
./configure --add-dynamic-module=../ngx_small_light --with-compat
```

<div align="center">

![aniadirModuloDinamico](./screenshots/aniadirModulo.png)

</div>

Posteriormente a la adición del módulo, generamos una librería:

```
make modules
```

<div align="center">

![makeModules](./screenshots/makeModules.png)

</div>

Ahora copiaremos la librería a la carpeta de módulos de la que Nginx consulta:

```
sudo cp objs/ngx_http_small_light_module.so /etc/nginx/modules
```

![copiarLibreriaACarpetaModulos](./screenshots/copiarLibreria.png)

</div>

Ahora debemos modificar el fichero de configuración de Nginx `/etc/nginx/nginx.conf`, añadiendole a este un:

```
load_module /etc/nginx/modules/ngx_http_small_light_module.so;
```

![configuracionNginxConf](./screenshots/configuracionNginxConf.png)

</div>

Ahora tendríamos que tener creado un [Virtual Host](#creación-del-virtual-host) donde añadir las directivas de ngx_small_light, ya que nos dirigiremos al archivo .conf del virtual host que queramos implementar las directivas del módulp. En mi caso es un archivo llamado ngx_small_light.conf

```
# Añadiremos el siguiente contenido:

location /files {
		small_light on; # Habilita el uso del módulo
		small_light_getparam_mode on; # Habilita poder llamar al módulo mediante parámetros
    }
```

<div align="center">

![virtualHostConf](./screenshots/virtualHostConf.png)

</div>

Y ya para quedarnos tranquilos de que todo fue correctamente, hacemos un:

```
sudo nginx -t
```

<div align="center">

![sudoNginx-T](./screenshots/sudoNginxT%2CModule.png)

</div>

___

## Creación del Virtual Host

Nginx se configura a partir de bloques del servidor. Estos bloques son los Virtual Hosts, que son capaces de montar servicios independientes entre ellos.

Estos hosts virtuales se definen mediante unos ficheros `nombreQueQueramos.conf` dentro de la carpeta `/etc/nginx/conf.d/`

Nosotros haremos un virtual host con la dirección [images.alu7410.arkania.es](http://images.alu7410.arkania.es)

Primero, debemos crear un fichero `.conf` en la carpeta de `/etc/ngix/conf.d/`. Yo haré un fichero que se llamará `ngx_small_light.conf`:

Para crear el fichero, debemos directamente editar un fichero que no exista en la carpeta:

```
sudo vi /etc/nginx/conf.d/ngx_small_lights.conf 

# Otra opción

sudo nano -l /etc/nginx/conf.d/ngx_small_lights.conf # El parámetro -l enseña las líneas en el editor
```

![sudoNano](./screenshots/sudoNanoConf.png)

queremos que el servername

```
server {
	server_name #nombre del server;
	root #ruta del fichero;
}
```

![hostConf](./screenshots/hostConf.png)

y comprobamos que tengamos la sintaxis correctamente:

```
sudo nginx -t
```

<div align="center">

![sudoNginx-T](./screenshots/sudoNginxT%2CModule.png)

</div>

A continuación, generaremos un fichero index en la ruta que hemos indicado en el `.conf` del virtual Host, en nuestro caso, en `/home/tomasantela/dev/ngx_small_lightJS`

El contenido del fichero será el siguiente:

```
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nginx + ngx_small_light</title>
    <link href="estilos.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="header">

        </div>
        <div class="main">
            
        </div>
        <div class="footer">

        </div>
    </div>
    <script src="imagenesDinamicas.js"></script>
</body>
</html>
```

<div align="center">

![index.html](./screenshots/indexHTML.png)

</div>

Posterior a crear el `index.html` hacemos un reload del servicio de Nginx para confirmar los cambios:

```
sudo systemctl reload nginx
```

<div align="center">

![reload](./screenshots/reload.png)

</div>

Nos faltaría simular un nombre de dominio de manera local en el archivo `/etc/hosts`

<div align="center">

![aniadorHostLocal](./screenshots/hostsAdd.png)

</div>

Ya podría entrar al index.html que tengo ahí desde otro dispositivo, por ejemplo desde mi portátil en un navegador Opera:

<div align="center">

![conectandoConMiVirtualHost](./screenshots/connectImagesArkania.png)

</div>

Podemos ver que el título de la web es el que pusimos en el html, por tanto, está funcionando correctamente.

___

## Aplicación web

Muy bien, ahora a desarrollar código.

El html y el css no le voy a dar mucha relevancia. 
Lo más relevante será la clase `.hide` en el css y la estructuración para llegar hasta las imágenes que se conformaría de lo siguiente:

<div align="center">

![indexHtml](./screenshots/Diagrama%20indexHtml.png)

</div>

Por tanto, para acceder al bloque de html donde tenemos todas las imágenes, tendríamos que acceder desde el document:

```
document -> body -> div.container -> div.main -> div.imagenes
```

El código JavaScript sería el siguiente:

```
/**
 * Metodo que modifica las imagenes segun los parametros introducidos, 
 * ademas de quitarles la clase hide para que ya no esten ocultas
 * @param {int} tamanio ancho y alto de la imagen
 * @param {int} borderWidth grosor del borde de la imagen
 * @param {String} borderColor color del borde de la imagen
 * @param {int} enfoqueRadio radio de enfoque
 * @param {int} desenfoqueRadio radio de desenfoque
 * @param {int} enfoqueMount cantidad de enfoque
 * @param {int} desenfoqueMount cantidad de desenfoque
 */
function modificarImagenes (tamanio, borderWidth, borderColor, enfoqueRadio, desenfoqueRadio, enfoqueMount, desenfoqueMount) {
    const imagenes = document.body.children['container'].children['main'].children['imagenes'];
    const totalImagenes = imagenes.childElementCount;
    imagenes.classList.remove("hide");
    for (let i=0; i<totalImagenes; i++) {
        imagenes.children[i].src = `img/${imagenes.children[i].name}.jpg?bw=${borderWidth}&bh=${borderWidth}&bc=${borderColor}&dh=${tamanio}&dw=${tamanio}&sharpen=${enfoqueRadio}x${enfoqueMount}&blur=${desenfoqueRadio}x${desenfoqueMount}`;
    }
}

/**
 * Metodo que es llamado al pulsar el boton "generar" del html. Este metodo recoge los datos necesarios del formulario y llama
 * al metodo modificarImagenes() para modificar las imagenes del html
 */
function imagenesDinamicas () {
    let tamanio = parseInt(getValorElemento("size"));
    let borderWidth = parseInt(getValorElemento("width"));
    let borderColor = getValorElemento("color").replace("#","");
    let enfoqueRadio = parseInt(getValorElemento("focus"));
    let desenfoqueRadio = parseInt(getValorElemento("nofocus"));
    let enfoqueMount = parseInt(getValorElemento("focusMount"));
    let desenfoqueMount = parseInt(getValorElemento("nofocusMount"));
    modificarImagenes(tamanio, borderWidth, borderColor, enfoqueRadio, desenfoqueRadio, enfoqueMount, desenfoqueMount);
}

/**
 * Metodo que devuelve el valor del objeto del html con el id deseado
 * @param {String} id del elemento del html deseado
 * @returns String
 */
function getValorElemento(id) {
    return document.getElementById(id).value;
}
```

| Método | Parámetros | Returns | Descripción |
|-|-|-|-|
| modificarImagenes | tamanio (int), borderWidth (int), borderColor (String), enfoqueRadio (int), desenfoqueRadio (int), enfoqueMount (int), desenfoqueMount (int) |  |  Método que modifica las imágenes según los parámetros introducidos además de quitarles la clase hide para que ya no estén ocultas |
| imagenesDinamicas (main) | | | Método que es llamado al pulsar botón "generar" del html. Este método recoge los datos necesarios del formulario y llama al método modificarImagenes() para modificar las imágenes del html |
| getValorElemento | id (String) | String | Método que devuelve el valor del objeto del html con el id deseado |

Si nos fijamos en el método modificarImagenes() podemos ver que accede al contenedor de imagenes con el `document.body.children['container'].children['main'].children['imagenes'];`.

Ya el método lo que hace es recorrer todos los nodos hijos del bloque div.imagenes y cambia el src con los parámetros introducidos.

La clase `.hide` es simplemente para que cuando entres por primera vez a la web, estén las imágenes ocultas. Ya el método modificarImagenes las pondrá visibles.

Ya finalmente solo nos faltaría subir los archivos `index.html`, `imagenesDinamicas.js`, `estilos.css` y la carpeta `/img/` al ordenador remoto de alu7410.arkania.es en la carpeta `/home/tomasantela/dev/ngx_small_lightJS`.

Para subirme todos los archivos del proyecto, como estoy en Windows usé la aplicación de [WinScp](https://winscp.net/eng/download.php), que permite conectarte por ssh a tu máquina remota y mandar archivos cómodamente:

<div align="center">

![WinScp](./screenshots/WinScp.png)

</div>

___

## Certificación de Seguridad

A día de hoy un certificado de seguridad es indispensable en cualquier web, ya que Google (el buscador más usado actualmente) no posiciona favorablemente a las webs sin certificados de seguridad. Además, el certificado de seguridad asegura que nuestra web tiene encriptación de datos a la hora de comunicarse entre servidor-cliente y viceversa.

El certificado que usaremos nosotros será [CertBot](https://certbot.eff.org).

Para instalar certbot primero debemos hacer un:

```
sudo apt update
```

y después hacemos un apt install de Certbot:

```
sudo apt install -y certbot
```

<div align="center">

![sudoAptInstallCertbot](./screenshots/aptInstallCertbot.png)

</div>

y comprobamos la versión de Certbot:

```
certbot --version
```

<div align="center">

![certBotVersion](./screenshots/certBotVersion.png)

</div>

Ahora deberíamos instalar un plugin de Nginx para que funcione Certbot:

```
sudo apt install -y python3-certbot-nginx
```

<div align="center">

![aptInstallNginxCertBot](./screenshots/aptInstallNginxCertBot.png)

</div>

Configuraremos a continuación el host que hicimos previamente en el apartado de [virtualHost](#creación-del-virtual-host):

```
sudo certbot --nginx
```

<div align="center">

![sudoCertBotNginx](./screenshots/certBotNginx.png)

</div>

En un principio, con esto todo debería estar hecho. Eso si, el certificado tiene una validez de 90 días, por tanto deberíamos renovarla, pero Certbot genera una tarea cron que comprueba 2 veces al día si quedan menos de 30 días para la renovación del certificado. En caso de que queden menos de 30 días para el fin del certificado, renueva automáticamente el certificado. Por tanto con esto ya simplemente debemos hacer un restart el servicio de Nginx para que ya se refleje el certificado:

```
sudo systemctl restart nginx
```

<div align="center">

![sudoSystemCtlRestartNginx](./screenshots/sudoNginxRestart.png)

![confirmarCertificado](./screenshots/confirmaCerti.png)

</div>


Ahora nos faltaría configurar la redirección de https://www.images.alu7410.arkania.es hasta https://images.alu7410.arkania.es, que eso lo tratamos en las [redirecciones](#redirecciones).

Y tras configurar las redirecciones, tenemos que hacer lo mismo que hicimos antes de `certbot --nginx` pero para el nuevo virtual host que hemos configurado para las redirecciones.

```
sudo certbot --nginx -d www.images.alu7410.arkania.es
```

<div align="center">

![sudoCertBotNginxWWW](./screenshots/certBotNginxWWW.png)

</div>

Y con esto finalizamos toda la certificación del dominio.

## Redirecciones

Ahora podemos acceder a la web mediante el enlace [images.alu7410.arkania.es](https://images.alu7410.arkania.es), un enlace que no tiene https (por ahora) ni tampoco tiene integrado el www. ¿Qué pasaría si intentamos ir por http://www.images.alu7410.arkania.es? Pues directamente no existiría esa web, porque no tenemos implementado ningún virtual host con esa dirección ni tampoco ninguna redirección. Por lo que queremos implementar es una redirección para que cuando alguien asista a la web http://www.images.alu7410.arkania.es sea redireccionado a http://images.alu7410.arkania.es automáticamente.

Por tanto, debemos primero crear un fichero .conf en la carpeta `/etc/nginx/conf.d/` en el que pondremos las redirecciones con el siguiente contenido:

Debemos crear un `.conf` en `/etc/nginx/conf.d/` en el que pondremos el siguiente contenido:

```
server {
    listen 80;
    server_name www.images.alu7410.arkania.es;
    return 301 https://images.alu7410.arkania.es$request_uri;
}
```

<div align="center">

![wwwConf](./screenshots/wwwConf.png);

</div>

Y ya solo faltaría certificar el dominio de [www.images.alu7410.arkania.es](https://www.images.alu7410.arkania.es) mediante el paso final de la certificación.

___

Tras terminar todos estos apartados, podríamos poder acceder a la web de [images.alu7410.arkania.es](https://images.alu7410.arkania.es) y siempre acceder a la mísma página.

<div align="center">

[Volver al Inicio](#administración-de-servidores-web)

</div>