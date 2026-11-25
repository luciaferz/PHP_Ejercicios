# Guía rápida para el examen de PHP y BD

Estos modelos son soluciones completas para estudiar. El patrón más repetido es:

```text
formulario -> index.php -> acciones/controlador -> AccesoDatos.php -> vista
```

## `prepare`, `bindValue` y `execute`

```php
$stmt = $pdo->prepare('SELECT * FROM productos WHERE categoria=:categoria AND precio<=:maximo');
$stmt->bindValue(':categoria', $categoria);
$stmt->bindValue(':maximo', $maximo);
$stmt->execute();
```

`prepare()` prepara el SQL y deja parámetros. `:categoria` y `:maximo` son huecos. `bindValue()` coloca un valor en cada hueco y `execute()` ejecuta la consulta. Se hace así para no concatenar datos del usuario y evitar inyección SQL.

Forma equivalente:

```php
$stmt = $pdo->prepare('SELECT * FROM productos WHERE categoria=:categoria');
$stmt->execute([':categoria' => $categoria]);
```

Para números se puede indicar el tipo: `bindValue(':plazas', $plazas, PDO::PARAM_INT)`.

## `FETCH_CLASS`

```php
$stmt->setFetchMode(PDO::FETCH_CLASS, 'Producto');
$productos = $stmt->fetchAll();
```

Convierte cada fila de MySQL en un objeto `Producto`. Los nombres de columnas y propiedades deben coincidir. `__get()` permite leer propiedades privadas y `__set()` permite asignarlas.

## Singleton, `self` y `$this`

```php
private static $modelo = null;
public static function getModelo() {
    if (self::$modelo === null) self::$modelo = new self();
    return self::$modelo;
}
```

`static` pertenece a la clase completa, `self::` accede a elementos estáticos de esa clase y `$this` representa al objeto actual. El constructor privado obliga a obtener la conexión mediante `getModelo()`.

## Entrada y HTML

`$_POST` suele usarse para insertar, modificar o borrar. `$_GET` suele usarse para búsquedas. `$_POST['nombre'] ?? ''` evita avisos si falta el campo. `trim()` elimina espacios y `htmlspecialchars()` protege al mostrar datos en HTML.

## Inclusiones

`require` detiene el programa si el archivo no existe. `require_once` hace lo mismo y evita cargarlo dos veces; es lo más adecuado para clases. `include` avisa y continúa, mientras que `include_once` evita duplicados sin detener normalmente el programa.

## Modelo 7 frente al examen 1

No son iguales. El examen 1 busca vuelos por destino y plazas, normalmente sobre una tabla de vuelos, y practica cookie y `FETCH_CLASS`. El modelo 7 busca pedidos por cliente y relaciona dos tablas (`clientes` y `pedidos`) mediante `JOIN`; además practica `LIKE`, alias SQL y un objeto `Pedido`. El modelo 7 aporta práctica nueva de relaciones entre tablas.

## Qué mirar en cada modelo

- Modelo 1: PDO, `FETCH_CLASS`, validación y cookie.
- Modelo 2: CRUD y arrays de checkboxes.
- Modelo 3: varias entidades y transacción.
- Modelo 4: diferencias entre sesión y cookie.
- Modelo 5: filtros opcionales y `GET`/`POST`.
- Modelo 6: `FOR UPDATE`, `commit()` y `rollBack()`.
- Modelo 7: `JOIN` entre tablas.

No memorices todo literalmente: copia el patrón y cambia nombres de tablas, campos y variables según el enunciado.

## `$_SERVER['REQUEST_METHOD']`

Indica cómo llegó la petición:

```php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Se ha enviado un formulario: usamos $_POST.
}
```

`GET` se usa normalmente para consultar o filtrar y los datos llegan en `$_GET`. `POST` se usa para insertar, modificar o borrar y los datos llegan en `$_POST`. La condición `!== 'POST'` suele significar que todavía no se ha enviado el formulario y hay que mostrarlo.

## `time()` y las cookies

`time()` devuelve la hora actual en segundos desde el 1 de enero de 1970. Por eso se suma una duración:

```php
setcookie('nombre', $valor, time() + 7 * 24 * 60 * 60, '/');
```

`60` segundos son 1 minuto; `60*60` son 3.600 segundos, una hora; `24*60*60` son 86.400 segundos, un día; `7*24*60*60` son 604.800 segundos, una semana; `30*24*60*60` son 2.592.000 segundos, treinta días.

## Qué puede entrar de cada modelo

- **Modelo 1:** búsqueda con `GET`, validación, PDO, `FETCH_CLASS`, Singleton y cookie.
- **Modelo 2:** CRUD, `INSERT`, `UPDATE`, `DELETE`, checkboxes y arrays como `saldo[]`.
- **Modelo 3:** dos clases, comprobación de usuario/producto, `INSERT`, `UPDATE` y transacción.
- **Modelo 4:** `session_start()`, `$_SESSION`, `REQUEST_METHOD`, contador, `setcookie()` y `session_destroy()`.
- **Modelo 5:** filtros opcionales, `ORDER BY`, consultas preparadas, `GET` para buscar y `POST` para borrar.
- **Modelo 6:** plazas, `FOR UPDATE`, `beginTransaction()`, `commit()` y `rollBack()`.
- **Modelo 7:** dos tablas relacionadas, `JOIN`, `LIKE`, alias SQL y `FETCH_CLASS`.
