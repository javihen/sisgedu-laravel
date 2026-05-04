# Sistema de Importación de Notas - Flujo de 4 Pasos

## 📋 Descripción General

Se ha implementado un nuevo sistema de importación de notas con una interfaz asistida que guía al usuario a través de 4 pasos simples:

```
┌─────────────────┐
│ PASO 1: Subir   │  ← El usuario sube un archivo Excel
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│ PASO 2:         │  ← El usuario selecciona una hoja del archivo
│ Seleccionar     │
│ Hoja            │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│ PASO 3:         │  ← El usuario previsualiza los datos
│ Previsualizar   │
└────────┬────────┘
         │
         ▼
┌─────────────────┐
│ PASO 4:         │  ← Los datos se importan a la BD
│ Importar        │
└─────────────────┘
```

## 🎯 Funcionalidades Principales

### Paso 1: Subir Archivo Excel

- ✅ Seleccionar archivo Excel (.xlsx, .xls)
- ✅ Validar período académico (1-4)
- ✅ Seleccionar gestión académica
- ✅ Drag & drop de archivos
- ✅ El archivo se guarda temporalmente en `storage/app/imports/`
- ✅ Se lee automáticamente la lista de hojas disponibles

### Paso 2: Seleccionar Hoja

- ✅ Select poblado dinámicamente con todas las hojas del Excel
- ✅ Mostrar cantidad de hojas encontradas
- ✅ Botón "Volver Atrás" para cambiar archivo
- ✅ Botón "Previsualizar" para continuar

### Paso 3: Previsualizar Datos

- ✅ Tabla con encabezados reales del Excel (primeras 16 columnas)
- ✅ Mostrar primeras 5 filas de datos
- ✅ Mostrar total de filas en la hoja
- ✅ Verificar visualmente que los datos sean correctos
- ✅ Botones para volver atrás o proceder con importación

### Paso 4: Resultado de Importación

- ✅ Mostrar cantidad de notas importadas
- ✅ Mostrar errores encontrados (máximo 10 visibles)
- ✅ Enlace para ver notas importadas
- ✅ Opción de realizar nueva importación

## 🔧 Cambios Técnicos

### 1. Controlador: `app/Http/Controllers/NotaController.php`

Nuevos métodos:

```php
public function uploadFile(Request $request)
// POST /notas/upload-file
// Recibe: archivo Excel
// Retorna: JSON con lista de hojas y ruta temporal del archivo

public function previewSheet(Request $request)
// POST /notas/preview-sheet
// Recibe: ruta archivo + nombre hoja
// Retorna: JSON con encabezados y primeras 5 filas

public function importData(Request $request)
// POST /notas/import-data
// Recibe: ruta archivo + hoja + período + gestión
// Retorna: JSON con resultados de importación
```

### 2. Modelo: `app/Imports/NotasImport.php`

Nuevo método:

```php
public function procesarHoja($filePath, $nombreHoja)
// Procesa una hoja específica del Excel
// Mismo formato que procesar() pero recibe nombre de hoja
```

### 3. Rutas: `routes/web.php`

```php
Route::post('/notas/upload-file', [NotaController::class, 'uploadFile'])->name('notas.upload-file');
Route::post('/notas/preview-sheet', [NotaController::class, 'previewSheet'])->name('notas.preview-sheet');
Route::post('/notas/import-data', [NotaController::class, 'importData'])->name('notas.import-data');
```

### 4. Vista: `resources/views/notas/import.blade.php`

Completamente reescrita con:

- Sistema de pasos interactivos con indicador visual
- Formularios con validación
- Tablas de preview
- Mensajes de error/éxito/info
- JavaScript para gestionar el flujo

## 📊 Flujo de Datos

```
Cliente (Browser)
    │
    ├─ [1] POST archivo → uploadFile()
    │      └─ Guardar en storage/imports/
    │      └─ Leer hojas con IOFactory
    │      └─ Retornar: {archivo, hojas[]}
    │
    ├─ [2] Usuario selecciona hoja
    │
    ├─ [3] POST {archivo, hoja} → previewSheet()
    │      └─ Leer hoja específica
    │      └─ Extraer encabezados (F1:P1)
    │      └─ Extraer primeras 5 filas (F7:P11)
    │      └─ Retornar: {encabezados[], datos[][], totalFilas}
    │
    ├─ [4] Usuario revisa preview
    │
    └─ [5] POST {archivo, hoja, periodo, gestion} → importData()
           └─ Llamar procesarHoja()
           └─ Recorrer todas las filas
           └─ Validar y guardar en notas tabla
           └─ Eliminar archivo temporal
           └─ Retornar: {notasCreadas, errores[]}
```

## 🗂️ Almacenamiento Temporal

Los archivos Excel se guardan temporalmente con nombre único:

```
storage/app/imports/temp_notas_[timestamp]_[uniqid].xlsx
```

Se eliminan automáticamente después de:

1. Una importación exitosa
2. Después de 24 horas (mediante limpieza cron si existe)

## ✅ Validaciones

### Cliente (JavaScript)

- ✅ Período no vacío
- ✅ Gestión no vacía
- ✅ Archivo seleccionado
- ✅ Hoja seleccionada

### Servidor (PHP)

**En uploadFile():**

- ✅ Archivo requerido
- ✅ Formato: xlsx, xls
- ✅ Tamaño máximo: 2MB

**En previewSheet():**

- ✅ Archivo temporal existe
- ✅ Hoja existe en el archivo

**En importData():**

- ✅ Período válido (1-4)
- ✅ Gestión existe en BD
- ✅ Archivo temporal existe
- ✅ Hoja existe

**Al procesar datos:**

- ✅ Estudiante existe
- ✅ Materia/Asignación existe
- ✅ Nota es numérica
- ✅ Nota está en rango 0-100

## 📌 Formato Esperado del Excel

```
     A      B        C              D        E      F    G    H    I    J    K    L    M    N    O    P
1                                                   [ID  [ID  [ID  ...materias...]
                                                    MAT  MAT  MAT
2
3
4
5
6                                                   1T   1T   1T   <- Indicador de período
7              EST001  Nombre Est.  EFECTIVO       85   90   78   <- Primeros datos
8              EST002  Nombre Est.  EFECTIVO       92   88   95
9              EST003  Nombre Est.  EFECTIVO       75   82   70
...

Donde:
- Fila 1, Cols F-P: IDs de materias
- Fila 6, Cols F-P: "1T", "2T", "3T", "4T" (período)
- Col B, Fila 7+: IDs de estudiantes
- Celdas F7-P...: Notas (valores 0-100)
```

## 🚀 Cómo Usar

1. Ir a: `/notas/import`
2. **Paso 1:** Seleccionar período, gestión y cargar archivo Excel
3. **Paso 2:** Seleccionar una hoja del archivo
4. **Paso 3:** Revisar la tabla de preview
5. **Paso 4:** Importar y revisar resultados

## 🐛 Manejo de Errores

- Si hay errores en la importación, se muestran los primeros 10
- Los registros válidos se importan, los inválidos se reportan
- Se puede reimportar con otro archivo sin perder datos válidos

## 📁 Archivos Modificados

```
✅ app/Http/Controllers/NotaController.php
   - Agregados: uploadFile(), previewSheet(), importData()

✅ app/Imports/NotasImport.php
   - Agregado: procesarHoja()

✅ routes/web.php
   - Agregadas: 3 nuevas rutas POST

✅ resources/views/notas/import.blade.php
   - Reescrita completamente
```

## 🔄 Compatibilidad

- Mantiene compatible el método `import()` anterior
- No afecta otras funcionalidades
- Usa Storage de Laravel
- Requiere PhpSpreadsheet (ya está en composer.json)

## 💡 Ventajas del Nuevo Sistema

✅ **Experiencia mejorada:** Guía paso a paso al usuario
✅ **Previsualización:** Ver datos antes de importar
✅ **Flexible:** Soporta múltiples hojas en un archivo
✅ **Validación robusta:** Muchas validaciones integradas
✅ **Manejo de errores:** Muestra errores específicos
✅ **Seguridad:** Validación CSRF incluida
✅ **Responsive:** Funciona en desktop y tablet
