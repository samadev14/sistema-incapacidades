# Sistema de Gestión de Incapacidades Laborales

![Imagen de Portada](https://github.com/user-attachments/assets/9bb502c7-9531-4e2d-8278-c54f873d53e2)

Presento el siguiente proyecto aplicado para obtener el título profesional de Ingeniería de Sistemas en la Universidad Nacional Abierta y a Distancia - UNAD.
Este proyecto se desarrolla con el objetivo de brindarle a las pequeñas y medianas empresas una plataforma web que les permita la gestión eficiente de registros de incapacidades de los empleados, optimizando y automatizando los procesos administrativos de los departamentos de recursos humanos. El desarrollo de este proyecto tecnológico no solamente me ayuda a demostrar mis destrezas en el desarrollo de software, también me permite aportar una solución práctica a una problemática real del entorno empresarial local, promoviendo la eficiencia operativa y el cumplimiento normativo en la gestión del talento humano. Esta iniciativa refuerza mi compromiso con el desarrollo tecnológico como herramienta de transformación social y evidencia mi capacidad para aplicar los conocimientos adquiridos en el programa académico de ingeniería de sistemas a situaciones concretas del mundo real.

## 📝 Módulos del Proyecto

-   📊**Panel de Control (Dashboard):** Interfaz intuitiva que ofrece una vista general del sistema mediante gráficos de barras e indicadores visuales. Permite monitorear el número de incapacidades activas, pendientes, finalizadas y registradas, facilitando la toma de decisiones informadas.

-   💼**Gestión de Puestos de Trabajo:** Permite la creación, edición, consulta y eliminación de los distintos cargos o posiciones laborales dentro de la empresa, sirviendo como referencia para la clasificación de empleados y reportes asociados.

-   🏥**Gestión de EPS (Entidades Promotoras de Salud):** Módulo dedicado a la administración de las EPS asociadas a los empleados. Permite mantener actualizada la base de datos de EPS con operaciones de CRUD (Crear, Leer, Actualizar, Eliminar).

-   👥**Gestión de Empleados:** Registro detallado de los datos personales, laborales y de salud de los empleados. Este módulo soporta la administración completa del historial del empleado y se vincula con los módulos de incapacidades y notificaciones. Incluye operaciones de CRUD (Crear, Leer, Actualizar, Eliminar).

-   📝**Gestión de Incapacidades:** Permite registrar y gestionar incapacidades médicas, incluyendo duración de la incapacidad, tipo y descripción de la incapacidad y estado actual. Incluye operaciones de CRUD (Crear, Leer, Actualizar, Eliminar).

-   ✉️**Sistema de Notificaciones:** Automatiza el envío de correos electrónicos corporativos a los empleados para notificar cambios en el estado de sus incapacidades, mejorando la comunicación interna y reduciendo tiempos de respuesta.

-   📈**Reportes Estadísticos:** Generación de reportes en formato PDF y gráficos en PNG, que resumen información clave sobre las incapacidades registradas. Ideal para auditorías, presentaciones y análisis de desempeño del área de talento humano.

-   🔐**Gestión de Usuarios:** Permite administrar los usuarios del sistema, incluyendo su creación, modificación, consulta y eliminación. Cada usuario tiene un rol asignado que define sus permisos dentro de la plataforma.

-   🛡️**Gestión de Roles y Permisos:** Define y administra los distintos roles del sistema (por ejemplo: Administrador, Talento Humano, Supervisor). Asigna permisos personalizados a cada rol para garantizar una gestión segura y controlada del acceso.

## 💻 Tecnologías Utilizadas

-   **Frontend:** HTML5, CSS3, JavaScript, Tailwind CSS y Filament 3.
-   **Backend:** PHP y Laravel 12.
-   **Base de Datos:** MySQL.
-   **Servidor SMTP:** Mailtrap.

## 📦 Instalación del Proyecto

-   **Paso 1:** Clona este repositorio en tu máquina.

```bash
  git clone https://github.com/samadev14/sistema-incapacidades.git
```

-   **Paso 2:** Ingresa a la carpeta del proyecto.

```bash
  cd sistema-incapacidades
```

-   **Paso 3:** Después de haber instalado PHP, Composer y Node.js, ahora instala las dependencias.

```bash
  composer install
  npm install && npm run dev
```

-   **Paso 4:** Crea una copia del archivo .env.example con el nombre de .env.

```bash
  cp .env.example .env
```

-   **Paso 5:** Genera una clave de cifrado para la aplicación.

```bash
  php artisan key:generate
```

-   **Paso 6:** Configura la base de datos en el archivo .env.

```bash
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE={nombre de la base de datos}
  DB_USERNAME={nombre de usuario de la base de datos}
  DB_PASSWORD={contraseña de la base de datos}
```

-   **Paso 7:** Después de crear la base de datos, ejecuta las migraciones.

```bash
  php artisan migrate
```

-   **Paso 8:** Crea un usuario para acceder a la aplicación.

```bash
  php artisan make:filament-user
```

-   **Paso 9:** Inicia el servidor.

```bash
  php artisan serve
```

-   **Paso 10:** Ingresa a la siguiente URL.

```bash
  http://localhost:8000/admin/login
```

## 👨‍💻 Desarrollado por

-   Salem Martínez [@samadev14](https://github.com/samadev14)
