# AdminSENA API v1 — Guía de endpoints para Postman

Base URL: `http://api.adminsena.test/api/v1`

Todos los endpoints responden **JSON**. En Postman siempre agrega el header
**Accept: application/json** (pestaña Headers, o en Body → raw → JSON el Content-Type se pone solo).

## Prueba rápida

| Método | URL | Esperado |
|--------|-----|----------|
| GET | `http://api.adminsena.test/api/v1/ping` | `{"message":"Hola, API conectada"}` |
| GET | `http://api.adminsena.test/api/v1/hola` | `{"status":200,"mensaje":"hola"}` |

## Recursos — ENTIDADES FUERTES (lo que pide el instructor por ahora)

| Recurso | Campos del Body (JSON) |
|---|---|
| `areas` | `name` |
| `training-centers` | `name`, `location` |
| `computers` | `number`, `brand` |

> **Pendiente (posteriormente):** entidades débiles `teachers`, `courses`, `course-teachers`, `apprentices`.
> Sus rutas están comentadas en `routes/api.php`; se activan quitando el `//` de cada línea.

### Ejemplo completo con `areas`

1. **GET** `http://api.adminsena.test/api/v1/areas` → lista todas
2. **GET** `http://api.adminsena.test/api/v1/areas/1` → una sola
3. **POST** `http://api.adminsena.test/api/v1/areas` → Body → raw → JSON:
   ```json
   { "name": "Nuevo Area" }
   ```
4. **PUT** `http://api.adminsena.test/api/v1/areas/1` → Body → raw → JSON:
   ```json
   { "name": "Area Editada" }
   ```
5. **DELETE** `http://api.adminsena.test/api/v1/areas/1`

Los demás recursos funcionan igual: cambia el nombre del recurso y los campos del JSON.
Los `id` de las foreign keys (`area_id`, `course_id`, etc.) deben existir en la tabla referenciada,
si no el endpoint responde `422` con el detalle del error.

## Parámetros de consulta (query params) — estilo api.bloger.test

| Parámetro | Ejemplo | Efecto |
|---|---|---|
| `included` | `?included=area,teachers` | trae las relaciones en la respuesta |
| `filter[...]` | `?filter[name]=software` | filtra por campo (LIKE) |
| `sort` | `?sort=-name` | ordena (`-` = descendente) |
| `perPage` | `?perPage=2` | paginación (si no se envía, devuelve todo) |

Ejemplo:
`GET http://api.adminsena.test/api/v1/areas/2?included=teachers`

## Errores comunes

| Código | Causa |
|---|---|
| `ECONNREFUSED` | Apache apagado → enciéndelo en el panel de XAMPP |
| `404` | URL mal escrita: falta `/v1`, sobra `/`, o la URL tiene un salto de línea invisible (`%0A`) |
| `422` | Falló la validación: el JSON no cumple los campos requeridos |
| `500` | Error de PHP o de MySQL (revisa `storage/logs/laravel.log`) |
| `SQLSTATE[HY000] [1045]` | El nombre de la BD en `.env` no coincide con el creado en phpMyAdmin |
