# SSH Windows

## Guardar hosts

Explicaremos cómo añadiremos un host en el archivo de hosts del sistema de Windows.

Primero debemos abrir una CMD como administrador

El archivo de hosts se encuentra en `C:\Windows\system32\drivers\etc\hosts`. Lo modificaremos usando el siguiente comando:
``` 
notepad C:\Windows\system32\drivers\etc\hosts 
```

Se nos abrirá un fichero como este:
```
# Copyright (c) 1993-2009 Microsoft Corp.
#
# This is a sample HOSTS file used by Microsoft TCP/IP for Windows.
#
# This file contains the mappings of IP addresses to host names. Each
# entry should be kept on an individual line. The IP address should
# be placed in the first column followed by the corresponding host name.
# The IP address and the host name should be separated by at least one
# space.
#
# Additionally, comments (such as these) may be inserted on individual
# lines or following the machine name denoted by a '#' symbol.
#
# For example:
#
#      102.54.94.97     rhino.acme.com          # source server
#       38.25.63.10     x.acme.com              # x client host

# localhost name resolution is handled within DNS itself.
#	127.0.0.1       localhost
#	::1             localhost
```

Y añadiremos fuera de las líneas que tengan un `#` al principio una línea con los hosts que nos interesa guardar:
```
    {IP del remoto}(Nombre que queremos asignar)    # informacion sobre el host
```

En nuestro ejemplo, queremos poner la IP 193.70.85.284 (que se corresponde al alu7410.arkania.es) y el nombre de host arkania:

```
    193.70.85.254 arkania    # servidor remoto OVH
```

Para terminar de configurar nuestro archivo de hosts, haremos un `CTRL + G` para guardar el archivo.

Y con esto nos queda configurado el host.


## SSH Key

Primero de todo, abriremos una CMD en 
```
C:\Users\{Nuestro Usuario}
```

Y nos generaremos la clave pública y privada de SSH:

```
C:\Users\tomhu> ssh-keygen -t rsa
```

Ahora, en linux haríamos un ssh-copy-id {dirección IP del remoto}, pero en este caso no haremos eso, tendremos que redirigir la clave pública hasta la máquina remota mediante el siguiente comando:

```
type C:\Users\{Usuario}\.ssh\id_rsa.pub | ssh {IP del remoto} "cat >> .ssh/authorized_keys"
```

En mi caso, el usuario de Windows es tomhu. El puerto de SSH que tengo en el remoto es el 2222, por tanto debo mandarlo mediante ese puerto al usuario tomasantela de la máquina remota. Nos pedirá la contraseña.

```
type C:\Users\tomhu\.ssh\id_rsa.pub | ssh -p2222 tomasantela@arkania "cat >> .ssh/authorized_keys"
# Equivalente a:
type C:\Users\tomhu\.ssh\id_rsa.pub | ssh -p2222 tomasantela@193.70.85.254 "cat >> .ssh/authorized_keys"
```

Ya si hacemos la conexión con un ```ssh {IP del remoto}``` deberíamos acceder al remoto sin tener que poner la contraseña.

En mi ejemplo sería con:
```
C:\Users\tomhu>ssh -p2222 tomasantela@arkania
Linux vps-29f34849 5.10.0-19-cloud-amd64 #1 SMP Debian 5.10.149-2 (2022-10-21) x86_64

The programs included with the Debian GNU/Linux system are free software;
the exact distribution terms for each program are described in the
individual files in /usr/share/doc/*/copyright.

Debian GNU/Linux comes with ABSOLUTELY NO WARRANTY, to the extent
permitted by applicable law.
Last login: Thu Nov 10 16:46:05 2022 from 83.59.46.14
tomasantela@vps-29f34849:~$
```
