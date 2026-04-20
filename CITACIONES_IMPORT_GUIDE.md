# Sistema de Importación de Citaciones - Documentación

## Instalación

### 1. Instalar el paquete Maatwebsite/Excel

```bash
composer require maatwebsite/excel
```

Después de instalar, publica la configuración:

```bash
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
```

### 2. Ejecutar las migraciones

Si aún no has ejecutado la migración de citaciones, ejecuta:

```bash
php artisan migrate
```

## Estructura del Archivo Excel para Importación

El archivo Excel debe tener el siguiente formato:

### Encabezados (Primera Fila)

- **Primera celda**: Dejar vacía o poner "ID Estudiante"
- **Resto de celdas**: ID de Materias o nombres descriptivos

### Datos

- **Primera columna**: IDs de estudiantes (ej: EST001, EST002, etc.)
- **Resto de celdas**:
    - Ingresa `1` si hay citación para ese estudiante en esa materia
    - Deja vacío si NO hay citación

### Ejemplo:

| ID Estudiante | 1   | 2   | 3   | 4   |
| ------------- | --- | --- | --- | --- |
| EST001        | 1   |     | 1   |     |
| EST002        | 1   | 1   |     |     |
| EST003        |     | 1   | 1   | 1   |

En este ejemplo:

- EST001 tiene citaciones para materias 1 y 3
- EST002 tiene citaciones para materias 1 y 2
- EST003 tiene citaciones para materias 2, 3 y 4

## Uso del Sistema

### 1. Acceder a la Sección de Importación

Navega a: `/citacion/import`

### 2. Completar el Formulario

1. **Archivo Excel**: Selecciona tu archivo
2. **Curso**: Selecciona el curso asociado a las citaciones
3. **Gestión**: Selecciona la gestión (año escolar)
4. **Fecha de Citación**: Ingresa la fecha
5. **Hora de Citación**: Ingresa la hora
6. **Motivo** (Opcional): Describa el motivo de la citación
7. **Período** (Opcional): Ingresa el período (Ej: Primer Bimestre)
8. **Tipo de Citación**: Selecciona "Individual" o "Grupal"

### 3. Importar

Haz clic en "Importar Citaciones"

## Detalles Técnicos

### Archivos Creados

1. **App\Imports\CitacionImport.php**
    - Clase que procesa el archivo Excel
    - Implementa `ToCollection`
    - Usa `Excel::import(...)` para leer XLSX/XLS/CSV
    - Valida y crea citaciones para estudiantes y materias existentes

2. **App\Http\Controllers\CitacionController.php**
    - Controlador CRUD completo para citaciones
    - Método `import()` para procesar el Excel
    - Método `showImportForm()` para mostrar el formulario
    - Recibe el profesor seleccionado desde el formulario de importación

3. **resources/views/citacion/import.blade.php**
    - Formulario de importación con validación
    - Selecciona archivo, curso, gestión, profesor, fecha, hora, motivo, período y tipo
    - Instrucciones para el usuario

4. **resources/views/citacion/index.blade.php**
    - Listado por estudiante con materias citadas en una sola columna
    - Muestra curso(s), profesor(es), fechas, horas y tipos agrupados por estudiante
    - Conserva PDF por estudiante y acciones de listado

5. **resources/views/citacion/edit.blade.php**
    - Formulario para editar una citación
    - Campos completos con validación

### Rutas Disponibles

- `GET /citacion` - Listar citaciones (route: citacion.index)
- `GET /citacion/import` - Mostrar formulario de importación (route: citacion.import)
- `POST /citacion/import` - Procesar importación (route: citacion.import)
- `POST /citacion/store` - Crear citación manual (route: citacion.store)
- `GET /citacion/{citacion}/edit` - Editar citación (route: citacion.edit)
- `PUT /citacion/{citacion}` - Actualizar citación (route: citacion.update)
- `DELETE /citacion/{citacion}` - Eliminar citación (route: citacion.destroy)

### Asignación Automática

Durante la importación, los siguientes campos se asignan automáticamente:

- **idProfesor**: ID del profesor seleccionado en el formulario
- **idGestion**: ID de la gestión seleccionada en el formulario
- **idCurso**: ID del curso seleccionado en el formulario
- **fecha**: Fecha ingresada en el formulario
- **hora**: Hora ingresada en el formulario
- **motivo**: Motivo ingresado (o valor por defecto "Citación Registrada")
- **periodo**: Período ingresado (opcional)
- **tipo**: Tipo seleccionado (individual o grupal)

### Validaciones

El sistema valida:

- ✅ Que el archivo sea Excel válido (.xlsx, .xls, .csv)
- ✅ Que el estudiante exista en la BD
- ✅ Que la materia exista en la BD
- ✅ Que el curso exista en la BD
- ✅ Que la gestión exista en la BD
- ✅ Que se procesen celdas con valor `1`, `x` o `yes`
- ✅ Que la fecha sea válida
- ✅ Que la hora tenga formato correcto (HH:MM)

### Manejo de Errores

Si ocurre un error durante la importación:

- Se muestra un mensaje de error descriptivo
- Los datos válidos ya importados NO se revierten (continuidad)
- Se registran los errores en los logs

## Modelo de Datos

### Citacion Model

```php
protected $table = 'citaciones';
protected $primaryKey = 'idCitacion';
protected $fillable = [
    'idEstudiante',
    'idCurso',
    'idProfesor',
    'idMateria',
    'idGestion',
    'fecha',
    'hora',
    'motivo',
    'periodo',
    'tipo',
];

// Relaciones
public function estudiante() // belongsTo
public function curso() // belongsTo
public function profesor() // belongsTo
public function materia() // belongsTo
public function gestion() // belongsTo
```

## Ejemplo de Uso en Código

```php
// Obtener todas las citaciones de un estudiante
$citaciones = $estudiante->citaciones;

// Obtener todas las citaciones de un profesor
$citaciones = $profesor->citaciones;

// Obtener información completa de una citación
$citacion = Citacion::find(1);
echo $citacion->estudiante->nombres;
echo $citacion->profesor->nombres;
echo $citacion->materia->area;
```

## Troubleshooting

### Error: "Class 'Maatwebsite\Excel\Facades\Excel' not found"

**Solución**: Asegúrate de haber ejecutado:

```bash
composer require maatwebsite/excel
php artisan vendor:publish --provider="Maatwebsite\Excel\ExcelServiceProvider"
```

### Error: "No rows were processed"

**Solución**: Verifica que tu archivo Excel tenga la estructura correcta:

- Primera fila con encabezados de materias
- Primera columna con IDs de estudiantes
- Celdas de datos con valor `1`, `x` o `yes`

### Error: "Column not found in heap"

**Solución**: Asegúrate de que los IDs de estudiantes en el Excel existan en la base de datos.

---

**Última actualización**: 19 de abril de 2026
