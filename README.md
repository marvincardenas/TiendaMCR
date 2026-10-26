# Mi Aplicación Web con Nginx + PHP-FPM + MySQL en Docker

## 📌 Descripción

Este proyecto contiene una aplicación web PHP desplegada en un entorno **Docker Compose** utilizando:

* **Nginx** como servidor web y proxy inverso.
* **PHP-FPM** para ejecutar los scripts PHP.
* **MySQL** como gestor de base de datos.

La aplicación incluida es un ejemplo básico (WordPress o aplicación PHP personalizada), pensada para prácticas de administración de servidores de aplicaciones.

---

## ⚙️ Requisitos

* Docker
* Docker Compose

Verificar la instalación con:

```bash
docker --version
docker-compose --version
```

---

## 🚀 Despliegue local

1. Clonar el repositorio:

   ```bash
   git clone https://github.com/usuario/miapp-docker.git
   cd miapp-docker
   ```

2. Levantar los servicios:

   ```bash
   docker-compose up -d
   ```

3. Acceder a la aplicación en el navegador:
   👉 [http://localhost:8080](http://localhost:8080)

---

## 🗂️ Estructura del proyecto

```
miapp-docker/
├── code/                # Código fuente de la aplicación PHP
├── nginx.conf           # Configuración del servidor Nginx
├── docker-compose.yml   # Definición de servicios Docker
├── .gitignore           # Archivos y carpetas ignorados por Git
└── README.md            # Documentación del proyecto
```

---

## 🔐 Seguridad aplicada

* Uso de cabeceras HTTP seguras en Nginx:

  * `X-Frame-Options`
  * `X-Content-Type-Options`
  * `Content-Security-Policy`
* Protección con autenticación básica en rutas sensibles.
* Restricciones de configuración en `php.ini`.

---

## 🧪 Pruebas de funcionamiento

* Logs de servicios:

  ```bash
  docker logs nginx-app
  docker logs php-fpm-app
  docker logs mariadb-app
  ```
* Pruebas de carga (desde el host):

  ```bash
  ab -n 100 -c 10 http://localhost:8080/
  ```

---

## ☁️ Despliegue en la nube

Este proyecto puede ser fácilmente desplegado en servicios cloud compatibles con Docker:

* AWS Lightsail Containers
* Azure Container Apps
* Google Cloud Run
* Kubernetes (conversión con `kompose`)

---

## 👨‍💻 Autor

Nombre del estudiante – Unidad de Trabajo: Administración de Servidores de Aplicaciones
