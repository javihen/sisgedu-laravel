# Gestión de Citaciones con Generación de PDF - Documentación Completa

## ✅ Implementación Completada

### 1. **Base de Datos y Modelos**

- ✅ Tabla `citaciones` con relaciones foráneas
- ✅ Modelo `Citacion` con relaciones belongsTo
- ✅ Relaciones hasMany en modelos: Estudiante, Curso, Profesor, Materia, Gestion

### 2. **Controlador (CitacionController)**

#### Métodos Implementados:

```php
// Listar citaciones con gestión activa
public function index()

// Mostrar formulario de importación
public function showImportForm()

// Procesar importación desde Excel
public function import(Request $request)

// Crear citación manualmente
public function store(Request $request)

// Mostrar formulario de edición
public function edit(Citacion $citacion)

// Actualizar citación
public function update(Request $request, Citacion $citacion)

// Eliminar citación
public function destroy(Citacion $citacion)

// Generar PDF por curso
public function generarPDFCurso($idCurso)

// Generar PDF general (todos los cursos)
public function generarPDFGeneral()

// Generar PDF por estudiante
public function generarPDFEstudiante($idEstudiante)
```

### 3. **Rutas Web**

```php
// Listado
GET  /citacion                              → citacion.index
GET  /citacion/import                       → citacion.import

// CRUD
POST /citacion/import                       → citacion.import
POST /citacion/store                        → citacion.store
GET  /citacion/{citacion}/edit              → citacion.edit
PUT  /citacion/{citacion}                   → citacion.update
DELETE /citacion/{citacion}                 → citacion.destroy

// PDF
GET  /citacion/pdf/general                  → citacion.pdf.general
GET  /citacion/pdf/curso/{idCurso}          → citacion.pdf.curso
GET  /citacion/pdf/estudiante/{idEstudiante} → citacion.pdf.estudiante
```

### 4. **Vistas Blade**

#### [index.blade.php](resources/views/citacion/index.blade.php)

- ✅ Listado con tabla responsiva
- ✅ Estadísticas en tiempo real (Total, Individual, Grupal)
- ✅ Botones para editar, eliminar
- ✅ Botón PDF por estudiante (individual)
- ✅ Botón PDF General
- ✅ Botones PDF por Curso (múltiples)
- ✅ Gestión activa mostrada en header
- ✅ Integración con SweetAlert para eliminación

#### [import.blade.php](resources/views/citacion/import.blade.php)

- ✅ Formulario de importación
- ✅ Tabla de ejemplo
- ✅ Upload con drag-and-drop
- ✅ Campos: curso, gestión, fecha, hora, motivo, periodo, tipo

#### [edit.blade.php](resources/views/citacion/edit.blade.php)

- ✅ Formulario de edición
- ✅ Campos: estudiante (read-only), curso, profesor, materia, gestión, fecha, hora, motivo, periodo, tipo

#### [pdf-curso.blade.php](resources/views/citacion/pdf-curso.blade.php)

- ✅ PDF profesional con tabla de citaciones por curso
- ✅ Información del curso
- ✅ Estadísticas (individual/grupal)
- ✅ Imprimible
- ✅ Diseño elegante

#### [pdf-general.blade.php](resources/views/citacion/pdf-general.blade.php)

- ✅ PDF general con todos los cursos
- ✅ Separación por curso
- ✅ Page breaks automáticos
- ✅ Resumen general

#### [pdf-estudiante.blade.php](resources/views/citacion/pdf-estudiante.blade.php)

- ✅ PDF por estudiante
- ✅ Información personal del estudiante
- ✅ Todas sus citaciones
- ✅ Datos completos

### 5. **Paquetes Requeridos**

✅ `barryvdh/laravel-dompdf` (ya instalado)
✅ `maatwebsite/excel` (ya instalado)

## 🚀 Cómo Usar el Sistema

### 1. **Acceder al Listado de Citaciones**

```
URL: http://tu-app.local/citacion
```

### 2. **Importar Citaciones desde Excel**

```
1. Clic en botón "Importar"
2. Seleccionar archivo Excel con formato de matriz
3. Completar datos: curso, gestión, fecha, hora, motivo, etc.
4. Hacer clic en "Importar Citaciones"
```

### 3. **Generar PDFs**

#### PDF General (todos los cursos)

```
Clic en botón "PDF General" en el header
```

#### PDF por Curso

```
En la sección "Generar PDF por Curso"
Clic en el botón correspondiente al curso
```

#### PDF por Estudiante

```
En la tabla de citaciones
Clic en el icono PDF en la columna de opciones
```

### 4. **Editar Citación**

```
Clic en icono de edición
Modificar campos
Guardar cambios
```

### 5. **Eliminar Citación**

```
Clic en icono de basura
Confirmar con SweetAlert
```

## 📊 Características del Sistema

### ✨ Filtrado Automático

- Solo muestra citaciones de la **gestión activa**
- Datos siempre sincronizados

### 📈 Estadísticas en Tiempo Real

- Total de citaciones
- Citaciones individuales vs grupales
- Total de cursos con citaciones

### 📄 Generación de PDFs

- **3 tipos de PDF**:
    1. Por Curso (tabla completa del curso)
    2. General (todos los cursos con page breaks)
    3. Por Estudiante (citaciones del estudiante)

### 🎨 Diseño Profesional

- PDFs imprimibles y formales
- Estilos CSS optimizados para impresión
- Información clara y organizada

### 🔒 Validaciones

- Validación de gestión activa
- Relaciones foráneas correctas
- Datos requeridos verificados

## 📋 Estructura del Excel para Importación

```
| ID Estudiante | ID Materia 1 | ID Materia 2 | ID Materia 3 |
|---------------|--------------|--------------|--------------|
| EST001        |      1       |              |      1       |
| EST002        |      1       |      1       |              |
```

**Solo `1` crea citación**

## 🔗 URLs de PDF

```
# PDF General
GET /citacion/pdf/general

# PDF por Curso
GET /citacion/pdf/curso/{idCurso}

# PDF por Estudiante
GET /citacion/pdf/estudiante/{idEstudiante}
```

## 💾 Base de Datos

### Tabla: citaciones

```sql
CREATE TABLE citaciones (
    idCitacion BIGINT PRIMARY KEY AUTO_INCREMENT,
    idEstudiante VARCHAR(10) NOT NULL,
    idCurso VARCHAR(255) NOT NULL,
    idProfesor BIGINT UNSIGNED NOT NULL,
    idMateria INT NOT NULL,
    idGestion BIGINT UNSIGNED NOT NULL,
    fecha DATE NOT NULL,
    hora TIME NOT NULL,
    motivo VARCHAR(255) NOT NULL,
    periodo VARCHAR(255) NULL,
    tipo ENUM('individual', 'grupal') DEFAULT 'individual',
    created_at TIMESTAMP,
    updated_at TIMESTAMP,

    FOREIGN KEY (idEstudiante) REFERENCES estudiantes(id_estudiante) ON DELETE CASCADE,
    FOREIGN KEY (idCurso) REFERENCES cursos(id) ON DELETE CASCADE,
    FOREIGN KEY (idProfesor) REFERENCES profesores(id_profesor) ON DELETE CASCADE,
    FOREIGN KEY (idMateria) REFERENCES materias(id_materia) ON DELETE CASCADE,
    FOREIGN KEY (idGestion) REFERENCES gestiones(id_gestion) ON DELETE CASCADE
);
```

## 🔍 Ejemplos de Código

### Obtener citaciones de un estudiante

```php
$estudiante = Estudiante::find('EST001');
$citaciones = $estudiante->citaciones; // hasMany

foreach ($citaciones as $citacion) {
    echo $citacion->motivo;
    echo $citacion->materia->area;
}
```

### Obtener citaciones de un profesor

```php
$profesor = Profesor::find(1);
$citaciones = $profesor->citaciones; // hasMany

// Filtrar por gestión activa
$gestionActiva = Gestion::where('estado', 'A')->first();
$citacionesActuales = $citaciones->where('idGestion', $gestionActiva->id_gestion);
```

### Generar PDF por curso

```php
// En blade
<a href="{{ route('citacion.pdf.curso', $curso->id) }}">
    Descargar PDF
</a>
```

## 🎯 Validaciones Implementadas

✅ Archivo Excel válido (.xlsx, .xls, .csv)
✅ Estudiante existe
✅ Materia existe
✅ Curso existe
✅ Gestión existe y está activa
✅ Fecha válida
✅ Hora formato correcto
✅ Solo procesa celdas = 1
✅ Relaciones foráneas correctas

## 📝 Notas Importantes

1. **Gestión Activa**: El sistema filtra automáticamente por gestión con estado 'A'
2. **Profesor**: Se asigna automáticamente del usuario autenticado
3. **PDFs**: Optimizados para impresión a través de CSS @media print
4. **Transacciones**: Uso de formularios con CSRF token para seguridad

## 🐛 Troubleshooting

### Error: "No hay gestión activa"

**Solución**: Ir a Gestiones y cambiar una a estado Activo

### Error: "El estudiante no existe"

**Solución**: Verificar que el ID del estudiante en Excel existe en la BD

### Error en PDF

**Solución**: Verificar que DomPDF está instalado:

```bash
composer require barryvdh/laravel-dompdf
```

## 📞 Soporte

Para cualquier problema o pregunta, contactar al equipo de desarrollo.

---

**Versión**: 2.0
**Última actualización**: 17 de abril de 2026
**Estado**: ✅ Completamente funcional
