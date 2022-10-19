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

Actualizaremos el listado de los paquetes con `sudo apt update`:

![comando sudo apt update](https://user-images.githubusercontent.com/90792144/196782792-7d33d6fe-d2d4-4b01-8e35-02a747c6d290.png)

En mi caso, se puede ver que no me actualiza los paquetes directamente, me dice que puedo actualizar 39 paquetes distintos y que use el comando `apt list --upgradable`

![image](https://user-images.githubusercontent.com/90792144/196784091-1131a337-5ba9-42a7-9091-e0e2516c60e6.png)

Y no me dejó actualizarlos todos de golpe, por tanto, tuve que actualizar uno a uno:

A continuación, instalaremos los paquetes de soporte, con el comando  <br/> 
`sudo apt install -y curl gnupg2 ca-certificates lsb-release debian-archive-keyring`:

