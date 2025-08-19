# Sistema de Gestión de Incapacidades Laborales

Presento el siguiente proyecto aplicado para obtener el título profesional de Ingeniería de Sistemas en la Universidad Nacional Abierta y a Distancia - UNAD.
Este proyecto se desarrolla con el objetivo de brindarle a las pequeñas y medianas empresas privadas de la ciudad de Santa Marta, Colombia, una plataforma web que les permita a esas entidades gestionar y automatizar sus procesos de incapacidades laborales. El desarrollo de este proyecto tecnológico no solamente me ayuda a demostrar mis destrezas en el desarrollo de software, también me permite aportar una solución práctica a una problemática real del entorno empresarial local, promoviendo la eficiencia operativa y el cumplimiento normativo en la gestión del talento humano. Esta iniciativa refuerza mi compromiso con el desarrollo tecnológico como herramienta de transformación social y evidencia mi capacidad para aplicar los conocimientos adquiridos en el programa académico de ingeniería de sistemas a situaciones concretas del mundo real.

## 📝 Módulos del Proyecto

* **Panel de Control:** Dashboard intuitiva, con gráfica de barras e indicadores visuales que muestran el total de incapacidades activas, pendientes, finalizadas y registradas en el sistema.
* **Puestos de Trabajo:** Crear, consultar, actualizar y eliminar registros de nombres de los puestos de trabajo de los empleados.
* **EPS:** Crear, consultar, actualizar y eliminar registros de nombres de Entidades Promotoras de Salud (EPS).
* **Empleados:** Crear, consultar, actualizar y eliminar registros de la información de los empleados.
* **Incapacidades:** Crear, consultar, actualizar y eliminar registros de incapacidades de los empleados.
* **Notificaciones:** Crear y enviar notificaciones a los empleados acerca del estado de su incapacidad por correo electrónico corporativo.
* **Reportes Estadísticos:** Generación de reportes PDF e imágenes en formato PNG sobre los registros de incapacidades.
* **Usuarios:** Crear, consultar, actualizar y eliminar registros de usuarios con roles y permisos que utilizan el sistema.
* **Roles:** Crear roles y permisos y asignarlos a los usuarios que utilizan el sistema.

## 💻 Tecnologías Utilizadas

* **Frontend:** HTML5, CSS3, JavaScript, Tailwind CSS y Filament 3.
* **Backend:** PHP y Laravel 12.
* **Base de Datos:** MySQL.
* **Servidor SMTP:** Mailtrap.


## 📦 Instalación del Proyecto

* **Paso 1:** Clona este repositorio en tu máquina.

```bash
  git clone https://github.com/samadev14/sistema-incapacidades.git
```

* **Paso 2:** Ingresa a la carpeta del proyecto.

```bash
  cd sistema-incapacidades
```

* **Paso 3:** Después de haber instalado PHP, Composer y Node.js, ahora instala las dependencias.

```bash
  composer install
  npm install && npm run dev
```

* **Paso 4:** Crea una copia del archivo .env.example con el nombre de .env.

```bash
  cp .env.example .env
```

* **Paso 5:** Genera una clave de cifrado para la aplicación.

```bash
  php artisan key:generate
```

* **Paso 6:** Configura la base de datos en el archivo .env.

```bash
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE={nombre de la base de datos}
  DB_USERNAME={nombre de usuario de la base de datos}
  DB_PASSWORD={contraseña de la base de datos}
```

* **Paso 7:** Después de crear la base de datos, ejecuta las migraciones.

```bash
  php artisan migrate
```

* **Paso 8:** Crea un usuario para acceder a la aplicación.

```bash
  php artisan make:filament-user
```

* **Paso 9:** Inicia el servidor.

```bash
  php artisan serve
```

* **Paso 10:** Ingresa a la siguiente URL.

```bash
  http://localhost
```
## 👨‍💻 Desarrollado por

- Salem Martínez [@samadev14](https://github.com/samadev14)
