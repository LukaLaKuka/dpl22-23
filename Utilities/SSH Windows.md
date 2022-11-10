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
ssh-keygen -t rsa
```

