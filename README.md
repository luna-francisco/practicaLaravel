## Instituto - Gestion web en Laravel

Aplicacion web para la gestion basica de un instituto. Incluye autenticacion, panel principal con accesos rapidos y catalogos con CRUD para proyectos, estudiantes y profesores.

## Funcionalidad

- Autenticacion de usuarios (registro, login, recuperacion y verificacion de email).
- Pagina principal con tarjetas de acceso.
- Catalogo de proyectos con alta, edicion y borrado.
- Catalogo de estudiantes con alta, edicion y borrado.
- Catalogo de profesores con alta, edicion y borrado.

## Funcionamiento

- La ruta `/` muestra una portada publica con CTA de registro/login.
- Tras iniciar sesion se muestran tarjetas que enlazan a `/tarjeta/{id}`.
- `tarjeta/1` lista proyectos y permite CRUD con modales.
- `tarjeta/2` lista estudiantes y permite CRUD con modales.
- `tarjeta/3` lista profesores y permite CRUD con modales.
- El backend usa controladores con Form Requests para validar datos y modelos Eloquent para persistir en MySQL.

## Requisitos

- PHP 8.x y Composer.
- Node.js y NPM.
- Docker para la base de datos MySQL (incluye phpMyAdmin).

## Como iniciarlo

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

Por defecto la base de datos queda en `DB_PORT=23306` y phpMyAdmin en `http://localhost:8100`. El archivo `datos.sql` se importa automaticamente al iniciar el contenedor.

4. Ejecuta migraciones:

```bash
php artisan migrate
```

5. Arranca la aplicacion:

```bash
php artisan serve
npm run dev
```

Alternativa con un solo comando:

```bash
npm run local
```

La app queda disponible en `http://localhost:8000`.
