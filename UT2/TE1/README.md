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

Actualizaremos el listado de los paquetes con `sudo apt update` (en mi caso ya los tenía actualizados porque perdí las capturas previas):

![image](https://user-images.githubusercontent.com/90792144/198064366-40857280-9397-4d42-8627-e31c9a2bab99.png)


A continuación, instalaremos los paquetes de soporte, con el comando  <br/> 
`sudo apt install -y curl gnupg2 ca-certificates lsb-release debian-archive-keyring`:

![image](https://user-images.githubusercontent.com/90792144/198064805-3341ae70-11f4-4f8a-beec-ed6741b2d93c.png)


Descargaremos, desmontaremos y guardamos la clave firma de nginx: `curl -fsSL https://nginx.org/keys/nginx_signing.key \ | sudo gpg --dearmor -o /etc/apt/trusted.gpg.d/nginx.gpg` (en mi caso):
![image](https://user-images.githubusercontent.com/90792144/198065430-279419f0-5411-4968-a303-eb7c756887eb.png)
