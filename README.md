## Instituto - Gestion web en Laravel

Aplicacion web para la gestion basica de un instituto. Incluye autenticacion, panel principal con accesos rapidos y catalogos CRUD para proyectos, estudiantes y profesores.

## Contenido

- Funcionalidad
- Flujo de uso
- Requisitos
- Puesta en marcha
- Roles y credenciales demo
- Rutas principales

## Funcionalidad

- Registro, login, recuperacion de contraseña y verificacion de email.
- Pagina principal con tarjetas de acceso a los modulos.
- CRUD de proyectos, estudiantes y profesores con modales.
- Busqueda, filtros y paginacion en catalogos (8 por pagina).
- Subida de imagenes para proyectos y fotos para estudiantes/profesores.

## Flujo de uso

- `/` muestra una portada publica con CTA de registro/login.
- Tras iniciar sesion se muestran tarjetas que enlazan a `/tarjeta/{id}`.
- `tarjeta/1` muestra proyectos.
- `tarjeta/2` muestra estudiantes.
- `tarjeta/3` muestra profesores.

## Requisitos

- PHP 8.x y Composer.
- Node.js y NPM.
- Docker (MySQL y phpMyAdmin incluidos).

## Puesta en marcha

1. Instala dependencias:

```bash
composer install
npm install
```

2. Configura entorno:

```bash
cp .env.example .env
php artisan key:generate
```

3. Levanta la base de datos con Docker:

```bash
docker compose up -d
```

La base de datos queda en `DB_PORT=23306` y phpMyAdmin en `http://localhost:8100`. El archivo `datos.sql` se importa al iniciar el contenedor.

4. Ejecuta migraciones y seed:

```bash
php artisan migrate --seed
```

5. Publica almacenamiento para imagenes:

```bash
php artisan storage:link
```

6. Arranca la aplicacion:

```bash
php artisan serve
npm run dev
```

Alternativa con un solo comando:

```bash
npm run local
```

La app queda disponible en `http://localhost:8000`.

## Roles y credenciales demo

- `admin`: puede crear, editar y borrar proyectos, estudiantes y profesores.
- `user`: acceso de solo lectura a los catalogos.

Credenciales demo:

- Email: `admin@demo.test`
- Password: `admin1234`

Estas credenciales se crean en el seeder. Se pueden modificar en `database/seeders/DatabaseSeeder.php`.

## Rutas principales

- `/` inicio publico.
- `/tarjeta/1` catalogo de proyectos.
- `/tarjeta/2` catalogo de estudiantes.
- `/tarjeta/3` catalogo de profesores.
