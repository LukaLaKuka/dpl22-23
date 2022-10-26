# UT - TE1 Implantación de arquitecturas web

Objetivo: Implantar una aplicación PHP (tanto en nativo como "_dockerizado_") de una calculadora usando Nginx + php-fpm incluyendo en la interfaz la siguiente imagen:

<div align=center>
  <img src="https://github.com/sdelquin/dpl/blob/main/ut2/te1/images/calculadora.png">
</div>

## ¿Qué realizaremos?

1. Instalación de Nginx + PHP-FPM de forma nativa
2. Configuraremos el virtual-host en nativo
3. Instalación del Docker
4. Prepararemos el entorno "_dockerizado_"
5. Finalmente haremos la aplicación PHP


## 1. Instalación de Nginx y PHP-FPM en **Nativo**

### Nginx

Actualizaremos el listado de los paquetes con `sudo apt update` (en mi caso ya los tenía actualizados porque perdí las capturas previas):

![image](https://user-images.githubusercontent.com/90792144/198064366-40857280-9397-4d42-8627-e31c9a2bab99.png)


A continuación, instalaremos los paquetes de soporte, con el comando  <br/> 
`sudo apt install -y curl gnupg2 ca-certificates lsb-release debian-archive-keyring`:

![image](https://user-images.githubusercontent.com/90792144/198064805-3341ae70-11f4-4f8a-beec-ed6741b2d93c.png)


Descargaremos, desmontaremos y guardamos la clave firma de nginx: `curl -fsSL https://nginx.org/keys/nginx_signing.key \ | sudo gpg --dearmor -o /etc/apt/trusted.gpg.d/nginx.gpg` (en mi caso ya tenía la clave firma guardada, o sea que simplemente la sobreescribí):
![image](https://user-images.githubusercontent.com/90792144/198065430-279419f0-5411-4968-a303-eb7c756887eb.png)

Ahora añadiremos a Nginx como repositorio oficial en el fichero sources.list.d, dentro del directorio /etc/apt con el comando `echo 'deb http://nginx.org/packages/debian bullseye nginx' \ | sudo tee /etc/apt/sources.list.d/nginx.list > /dev/null` :

![image](https://user-images.githubusercontent.com/90792144/198088328-feffd994-88f0-4929-99a2-751b76a7b0ba.png)


Volvemos a actualizar el listado de paquetes con un `sudo apt install` :

![image](https://user-images.githubusercontent.com/90792144/198090654-fcb41343-5a37-41d5-aa11-3a5e1179fd64.png)


Instalaremos Nginex con un `sudo apt install -y nginx` :

![image](https://user-images.githubusercontent.com/90792144/198091059-b441bdc9-3b1a-4a29-bbe9-676e7c0df1fb.png)


Comprobamos la versión de nuestro Nginx:

![image](https://user-images.githubusercontent.com/90792144/198091278-0f742dd9-9e1d-4d43-97b3-3bf8e6677a48.png)

Una vez ya hemos comprobado que tenemos instalado Nginx y su versión (1.22.1), comprobaremos el estado del demonio de Nginx:

![image](https://user-images.githubusercontent.com/90792144/198091528-add64c55-ab99-4340-bb02-3b5e87a66af0.png)


Podemos comprobar que el estado del demonio de Nginx es inactivo, por tanto, debemos iniciarlo:

![image](https://user-images.githubusercontent.com/90792144/198091741-c07a21ef-b219-430e-bcfa-c392deb5f6a2.png)

Y en un principio el servidor web ya está disponible, si accedemos al localhost podemos apreciar que nos conectaremos a un HTML que nos ofrece Nginx de prueba:

![image](https://user-images.githubusercontent.com/90792144/198092470-c49ac2c6-8144-41fc-87b5-684e35ce54f6.png)
También funciona si ponemos la IP de localhost (127.0.0.1)
![image](https://user-images.githubusercontent.com/90792144/198092836-e28a9bef-6abe-4554-9016-1a514b333a41.png)




### PHP-FPM 

Actualiraremos el listado de paquetes con `sudo apt update`:

![image](https://user-images.githubusercontent.com/90792144/198093729-838906d4-f196-4093-a4f1-073b8458e29f.png)


E instalaremos algunos prerequisitos que necesitaremos con `sudo apt install -y lsb-release ca-certificates \apt-transport-https software-properties-common gnupg2`: 

![image](https://user-images.githubusercontent.com/90792144/198094373-9bbc71f2-518f-4c67-9c36-d563a6fd85b4.png)


Añadiremos el repositorio como repositorio oficial del sistema en /etc/apt/sources.list.d con `echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" \ | sudo tee /etc/apt/sources.list.d/sury-php.list`:

![image](https://user-images.githubusercontent.com/90792144/198096378-d605664f-ccdb-435c-8e93-7ed91c886641.png)


Importamos la clave GPG del repositorio:

![image](https://user-images.githubusercontent.com/90792144/198097066-d0043407-6ff1-4665-a04f-d1e1d02a5293.png)


Y vamos a confirmar si el repositorio está disponible tras actualizar la lista de repositorios oficiales:

![image](https://user-images.githubusercontent.com/90792144/198097770-799751e3-4406-4938-881d-16f54566fa44.png)

Podemos apreciar que el repositorio sí está disponible, en el Des:5 y Des:6.


Ahora observaremos cuáles versiones tenemos disponibles con el comando `apt-cache search --names-only 'php*-fpm'`:

![image](https://user-images.githubusercontent.com/90792144/198098827-83c2687d-dc13-4e87-a067-9b6e3aef33fe.png)

Aqui pareciamos que tenemos disponible el PHP*-FPM desde la versión 5.6 hasta la 8.2 . Descargaremos la más reciente:

``` 
sudo apt install -y php8.2-fpm
Leyendo lista de paquetes... Hecho
Creando árbol de dependencias... Hecho
Leyendo la información de estado... Hecho
Se instalarán los siguientes paquetes adicionales:
  libpcre2-8-0 php-common php8.2-cli php8.2-common php8.2-opcache php8.2-readline
Paquetes sugeridos:
  php-pear
Se instalarán los siguientes paquetes NUEVOS:
  php-common php8.2-cli php8.2-common php8.2-fpm php8.2-opcache php8.2-readline
Se actualizarán los siguientes paquetes:
  libpcre2-8-0
1 actualizados, 6 nuevos se instalarán, 0 para eliminar y 3 no actualizados.
Se necesita descargar 4.706 kB de archivos.
Se utilizarán 21,2 MB de espacio de disco adicional después de esta operación.
Des:1 https://packages.sury.org/php bullseye/main amd64 libpcre2-8-0 amd64 10.40-1+0~20220713.16+debian11~1.gbpb6cec5 [258 kB]
Des:2 https://packages.sury.org/php bullseye/main amd64 php-common all 2:92+0~20220117.43+debian11~1.gbpe0d14e [16,4 kB]
Des:3 https://packages.sury.org/php bullseye/main amd64 php8.2-common amd64 8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008 [660 kB]
Des:4 https://packages.sury.org/php bullseye/main amd64 php8.2-opcache amd64 8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008 [338 kB]
Des:5 https://packages.sury.org/php bullseye/main amd64 php8.2-readline amd64 8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008 [12,6 kB]
Des:6 https://packages.sury.org/php bullseye/main amd64 php8.2-cli amd64 8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008 [1.705 kB]
Des:7 https://packages.sury.org/php bullseye/main amd64 php8.2-fpm amd64 8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008 [1.716 kB]
Descargados 4.706 kB en 2s (2.635 kB/s)
apt-listchanges: Leyendo lista de cambios...
(Leyendo la base de datos ... 222860 ficheros o directorios instalados actualmente.)
Preparando para desempaquetar .../libpcre2-8-0_10.40-1+0~20220713.16+debian11~1.gbpb6cec5_amd64.deb ...
Desempaquetando libpcre2-8-0:amd64 (10.40-1+0~20220713.16+debian11~1.gbpb6cec5) sobre (10.36-2+deb11u1) ...
Configurando libpcre2-8-0:amd64 (10.40-1+0~20220713.16+debian11~1.gbpb6cec5) ...
Seleccionando el paquete php-common previamente no seleccionado.
(Leyendo la base de datos ... 222860 ficheros o directorios instalados actualmente.)
Preparando para desempaquetar .../0-php-common_2%3a92+0~20220117.43+debian11~1.gbpe0d14e_all.deb ...
Desempaquetando php-common (2:92+0~20220117.43+debian11~1.gbpe0d14e) ...
Seleccionando el paquete php8.2-common previamente no seleccionado.
Preparando para desempaquetar .../1-php8.2-common_8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008_amd64.deb ...
Desempaquetando php8.2-common (8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008) ...
Seleccionando el paquete php8.2-opcache previamente no seleccionado.
Preparando para desempaquetar .../2-php8.2-opcache_8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008_amd64.deb ...
Desempaquetando php8.2-opcache (8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008) ...
Seleccionando el paquete php8.2-readline previamente no seleccionado.
Preparando para desempaquetar .../3-php8.2-readline_8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008_amd64.deb ...
Desempaquetando php8.2-readline (8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008) ...
Seleccionando el paquete php8.2-cli previamente no seleccionado.
Preparando para desempaquetar .../4-php8.2-cli_8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008_amd64.deb ...
Desempaquetando php8.2-cli (8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008) ...
Seleccionando el paquete php8.2-fpm previamente no seleccionado.
Preparando para desempaquetar .../5-php8.2-fpm_8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008_amd64.deb ...
Desempaquetando php8.2-fpm (8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008) ...
Configurando php-common (2:92+0~20220117.43+debian11~1.gbpe0d14e) ...
Created symlink /etc/systemd/system/timers.target.wants/phpsessionclean.timer → /lib/systemd/system/phpsessionclean.timer.
Configurando php8.2-common (8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008) ...

Creating config file /etc/php/8.2/mods-available/calendar.ini with new version

Creating config file /etc/php/8.2/mods-available/ctype.ini with new version

Creating config file /etc/php/8.2/mods-available/exif.ini with new version

Creating config file /etc/php/8.2/mods-available/fileinfo.ini with new version

Creating config file /etc/php/8.2/mods-available/ffi.ini with new version

Creating config file /etc/php/8.2/mods-available/ftp.ini with new version

Creating config file /etc/php/8.2/mods-available/gettext.ini with new version

Creating config file /etc/php/8.2/mods-available/iconv.ini with new version

Creating config file /etc/php/8.2/mods-available/pdo.ini with new version

Creating config file /etc/php/8.2/mods-available/phar.ini with new version

Creating config file /etc/php/8.2/mods-available/posix.ini with new version

Creating config file /etc/php/8.2/mods-available/shmop.ini with new version

Creating config file /etc/php/8.2/mods-available/sockets.ini with new version

Creating config file /etc/php/8.2/mods-available/sysvmsg.ini with new version

Creating config file /etc/php/8.2/mods-available/sysvsem.ini with new version

Creating config file /etc/php/8.2/mods-available/sysvshm.ini with new version

Creating config file /etc/php/8.2/mods-available/tokenizer.ini with new version
Configurando php8.2-opcache (8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008) ...

Creating config file /etc/php/8.2/mods-available/opcache.ini with new version
Configurando php8.2-readline (8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008) ...

Creating config file /etc/php/8.2/mods-available/readline.ini with new version
Configurando php8.2-cli (8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008) ...
update-alternatives: utilizando /usr/bin/php8.2 para proveer /usr/bin/php (php) en modo automático
update-alternatives: utilizando /usr/bin/phar8.2 para proveer /usr/bin/phar (phar) en modo automático
update-alternatives: utilizando /usr/bin/phar.phar8.2 para proveer /usr/bin/phar.phar (phar.phar) en modo automático

Creating config file /etc/php/8.2/cli/php.ini with new version
Configurando php8.2-fpm (8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008) ...

Creating config file /etc/php/8.2/fpm/php.ini with new version
Created symlink /etc/systemd/system/multi-user.target.wants/php8.2-fpm.service → /lib/systemd/system/php8.2-fpm.service.
Procesando disparadores para man-db (2.9.4-2) ...
Procesando disparadores para libc-bin (2.31-13+deb11u5) ...
Procesando disparadores para php8.2-cli (8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008) ...
Procesando disparadores para php8.2-fpm (8.2.0~rc4-1+0~20221024.6+debian11~1.gbp6c2008) ...
```

PHP-FPM se instala como un demonio, por tanto, debemos primero mirar el estado de este:

![image](https://user-images.githubusercontent.com/90792144/198100426-c6d5ef28-44d1-4cc4-8598-b9517bf628dd.png)

Podemos apreciar que el servicio está corriendo en el sistema.

Junto a la instalación del PHP-FPM también se instala el intérprete de PHP:

![image](https://user-images.githubusercontent.com/90792144/198100688-01dfbcf8-db8b-4f48-ae5c-e7d6bacdf007.png)


## Configurar VirtualHost en Nativo

Nginx no manejar ficheros escritos en PHP, de ello el haber instalado el PHP-FPM. 

Deberemos darle permisos al usuario `nginx` para que pueda acceder al **socket unix** (es un medio para que procesos puedan comunicarse entre ellos mediante el buffer de la memoria) en el fichero `/etc/php/8.2/fpm/pool.d/www.conf` (usar **sudo**, ya que es un fichero de /etc/).

![image](https://user-images.githubusercontent.com/90792144/198103121-e64d6d36-482d-4c65-bfee-3a43b7bedb1f.png) <br/>
![image](https://user-images.githubusercontent.com/90792144/198102996-0f338aab-6a93-429a-8e03-5c6138c2ce09.png)


Ahora no reiniciaremos el demonio de PHP, sino que vamos a _recargarlo_ con un: `sudo systemctl reload php8.2-fpm` (no tiene ninguna salida si se ha ejecutado con éxito).

A continuación pondremos el /html de Nginx como raíz de html a uno de los archivos de configuración de PHP-FPM. Para ello, debemos acceder al fichero `/etc/nginx/conf.d/default.conf` y donde poner `` location ~ \.php `` (importante usar **sudo**, yaque es un fichero de /etc/):

![image](https://user-images.githubusercontent.com/90792144/198105389-db1c9dd9-057e-4fe3-9fee-de4f90b9c67d.png)


Para comprobar si la sintaxis del fichero de configuración es correcta, podemos hacer un `sudo nginx -t` en la consola:

![image](https://user-images.githubusercontent.com/90792144/198106579-a8a2c0b2-807d-40a6-88a0-9167b16b06e0.png)

Finalmente recargaremos el demonio de Nginx para recargar la configuración con un `sudo systemctl reload nginx`:

![image](https://user-images.githubusercontent.com/90792144/198107772-466c821e-77a1-441a-88ca-767beadd9239.png)


## Instalación Docker

Para poder preparar el entorno de nginx dockerizado, necesitaremos instalar Docker. 

Primero de todo, actualizaremos los repositorios oficiales con `sudo apt update`:

![image](https://user-images.githubusercontent.com/90792144/198109246-42563b76-08b1-4660-b257-f4bb8d26ef2c.png)

E instalaremos unos requisitos previos con `sudo apt install -y \`:

![image](https://user-images.githubusercontent.com/90792144/198109630-829c0c0c-a652-4ca7-989a-0d329b4694a8.png)

Importamos y desarmamos la clave GPG de docker con el comando `curl -fsSL https://download.docker.com/linux/debian/gpg | sudo gpg --dearmor -o /etc/apt/trusted.gpg.d/docker.gpg` (no debería dar ninguna salida si se ejecutó con éxito):

![image](https://user-images.githubusercontent.com/90792144/198110238-5cc61d40-de1a-4abd-8c3a-7fa111d33089.png)

A continuación añadiremos el repositorio externo de Docker a la lista de repositorios oficiales `/etc/apt/sources.list.d` con el comando `echo \
  "deb [arch=$(dpkg --print-architecture)] https://download.docker.com/linux/debian \  $(lsb_release -cs) stable" | sudo tee /etc/apt/sources.list.d/docker.list > /dev/null`:

![image](https://user-images.githubusercontent.com/90792144/198132035-c0f857ae-1299-4115-8d2e-4a1f014f4df2.png)


Llego la hora de instalar docker, primeramente vamos a actualizar la lista de repositorios oficiales:

![image](https://user-images.githubusercontent.com/90792144/198132385-0a78f5a9-7231-4b31-8f03-5b94776c623e.png)

y después instalaremos docker con `sudo apt install -y docker-ce docker-ce-cli containerd.io docker-compose-plugin` (yo ya lo tenía instalado previamente):

![image](https://user-images.githubusercontent.com/90792144/198132616-da230d87-bbd0-4549-9b34-7c03d35481e9.png)

Comprobamos el estado del demonio de Docker:

![image](https://user-images.githubusercontent.com/90792144/198132840-97ea2baf-29b4-403a-865d-839e3a52b7ee.png)

Finalmente nos añadiremos en el grupo Docker, ya que nadie que no sea `sudo` o `root` no puede utilizar Docker (debemos reiniciar la sesión para que podamos empezar a usar Docker):

```
sudo groupadd docker $USER
```

## Instalación Nginx _Dockerizado_

Para iniciar Nginx en Docker, primero debemos cargar la imagen, si tratamos de ejecutar una imagen que no tenemos se descargará automáticamente la imagen. Haremos esto mismo con Nginx, por tanto, debemos hacer un 
``` 
docker run -p 80:80 nginx
```
Esto lo que hace es correr el contenedor de Docker con Nginx en el puerto 80:80.

![image](https://user-images.githubusercontent.com/90792144/198134268-b242585b-61a7-4f33-bb7a-59189f834b66.png)

***IMPORTANTE*** Si queremos usar Nginx en el puerto 80:80, debemos parar el Nginx nativo de la máquina con un `sudo systemctl stop nginx`.

Si ahora en un navegador vamos a localhost o a 127.0.0.1 nos encontraremos con el siguiente html:

![image](https://user-images.githubusercontent.com/90792144/198142367-f363e10d-3f2a-47bf-938c-83107ed1976b.png)


## Aplicación PHP

### En nativo

Inicio el servicio de Nginx:

![image](https://user-images.githubusercontent.com/90792144/198150646-dc9beeea-acfd-4f97-bc12-b687a6f9dac8.png)

Primero me cree un directorio en mi `/home` llamado `dev` junto al script de PHP que ya había hecho previamente:

![image](https://user-images.githubusercontent.com/90792144/198150050-d5e133c2-411d-4364-87c2-82d830598972.png)

Después enlacé el fichero al root del servidor web, o sea, en  `/usr/share/nginx/html` con el comando `sudo ln -s ~/dev/calculadora.php /usr/share/nginx/html/`: 

![image](https://user-images.githubusercontent.com/90792144/198150420-7dc93a3c-06ef-45c9-9c4a-c591cd424e3a.png)

En la imagen superior se aprecia que no generé el enlace, pero repetí el comando y ya me hizo el enlace:

![image](https://user-images.githubusercontent.com/90792144/198151133-7888cc7f-c2e2-4fc3-a16e-058b7c0167a3.png)

Y al acceder a `localhost/calculadora.php` en el navegador se me muestra lo siguiente:

![image](https://user-images.githubusercontent.com/90792144/198151288-cc057844-72e5-4b9f-a103-1bf150106b11.png)


### En Docker

Voy a generarme un directorio llamado app dentro del directorio dev:

![image](https://user-images.githubusercontent.com/90792144/198151715-80396700-8d04-432b-b536-ffb64608f9eb.png)

En esta carpeta app me monto la siguiente estructura y pongo los ficheros default.conf y docker-compose.yml

![image](https://user-images.githubusercontent.com/90792144/198153434-ac44ada5-8ac1-416a-8b3f-7063913bec38.png)

Y finalmente componemos con `docker compose up`:

![image](https://user-images.githubusercontent.com/90792144/198154254-90a57cca-9e34-463f-a724-88857da8a166.png)


Poniendo en ambos casos la imagen de la calculadora en donde tengo puesto la ruta relativa ya me imprime la foto incluida:

![image](https://user-images.githubusercontent.com/90792144/198154167-78671f41-ad4a-4f54-a3ed-011b9905d5da.png)



