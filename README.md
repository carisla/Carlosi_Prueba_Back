
## *Requisitos Previos*

Antes de empezar, asegúrate de tener instalados los siguientes componentes en tu máquina:

- PHP >= 8.0
- Composer
- MySQL o MariaDB
- Node.js & NPM (si usas características frontend)
- [Postman](https://www.postman.com/downloads/) o cualquier otra herramienta para probar la API (opcional)

## *Instalación*

### 1. Clonar el Repositorio
Clona el repositorio en tu máquina local:
bash
git clone https://github.com/tu_usuario/tu_proyecto.git
cd tu_proyecto


### 2. Instalar Dependencias
Ejecuta el siguiente comando para instalar todas las dependencias del proyecto:
bash
composer install


### 3. Configurar el Archivo .env
Copia el archivo .env.example y renómbralo como .env:
bash
cp .env.example .env


Edita el archivo .env para configurar la conexión a la base de datos. Aquí un ejemplo de configuración:

dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña


### 4. Generar la Clave de la Aplicación
Ejecuta el siguiente comando para generar una clave única para la aplicación:
bash
php artisan key:generate


### 5. Migrar la Base de Datos
Para crear las tablas en la base de datos, ejecuta las migraciones:
bash
php artisan migrate


Si necesitas poblar la base de datos con un usuario de prueba, puedes ejecutar el siguiente comando:
bash
php artisan db:seed


### 6. Instalar Laravel Sanctum
El proyecto utiliza *Laravel Sanctum* para la autenticación basada en tokens. Ejecuta el siguiente comando para publicar la configuración de Sanctum (ya lo hicimos al instalar Sanctum):
bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"


Luego, ejecuta las migraciones si aún no lo has hecho:
bash
php artisan migrate


## *Ejecución del Proyecto*

Para levantar el servidor de desarrollo de Laravel, ejecuta:
bash
php artisan serve


Esto levantará el servidor local en http://localhost:8000.

## *Probando la API*

Puedes usar herramientas como *Postman* para probar la API. A continuación, te explicamos cómo interactuar con los endpoints principales.

### *Autenticación*
#### Registro de Usuario
*URL:* POST /api/register

*Body:*
json
{
    "name": "Usuario de Prueba",
    "email": "usuario@example.com",
    "password": "password"
}


#### Login
*URL:* POST /api/login

*Body:*
json
{
    "email": "firetensor@example.com",
    "password": "fire123"
}


*Respuesta:*
json
{
    "token": "tu_token_generado"
}


#### Logout
*URL:* POST /api/logout

*Header:* Authorization: Bearer {token}

### *Bienvenida al Usuario*
*URL:* GET /api/welcome

*Header:* Authorization: Bearer {token}

*Respuesta:*
json
{
    "message": "Bienvenido, NombreDelUsuario"
}


### *Gestión de Productos*
#### Crear Producto
*URL:* POST /api/products

*Header:* Authorization: Bearer {token}

*Body:*
json
{
    "name": "Producto A",
    "price": 25.99,
    "quantity": 100
}


#### Listar Productos
*URL:* GET /api/products

*Header:* Authorization: Bearer {token}

#### Actualizar Producto
*URL:* PUT /api/products/{id}

*Header:* Authorization: Bearer {token}

*Body:*
json
{
    "name": "Producto A Actualizado",
    "price": 30.99,
    "quantity": 80
}


#### Eliminar Producto
*URL:* DELETE /api/products/{id}

*Header:* Authorization: Bearer {token}

#### Ingreso de Productos (Incrementar stock)
*URL:* POST /api/products/{id}/increase

*Header:* Authorization: Bearer {token}

*Body:*
json
{
    "quantity": 50
}


#### Salida de Productos (Reducir stock)
*URL:* POST /api/products/{id}/decrease

*Header:* Authorization: Bearer {token}

*Body:*
json
{
    "quantity": 20
}


### *Gestión de Usuarios*
#### Listar Usuarios
*URL:* GET /api/users

*Header:* Authorization: Bearer {token}

#### Crear Usuario
*URL:* POST /api/users

*Header:* Authorization: Bearer {token}

*Body:*
json
{
    "name": "Nuevo Usuario",
    "email": "nuevo_usuario@example.com",
    "password": "password"
}


#### Actualizar Usuario
*URL:* PUT /api/users/{id}

*Header:* Authorization: Bearer {token}

*Body:*
json
{
    "name": "Usuario Actualizado",
    "email": "actualizado@example.com"
}


#### Eliminar Usuario
*URL:* DELETE /api/users/{id}

*Header:* Authorization: Bearer {token}

## *Principio SOLID Implementado*

Se ha aplicado el principio de *Responsabilidad Única (Single Responsibility Principle - SRP)*. Cada controlador (como ProductController y UserController) se encarga únicamente de gestionar un recurso específico, lo que simplifica la mantenibilidad y escalabilidad del código.
