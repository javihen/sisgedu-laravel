# ⚙️ Guía de Configuración Vite - SisGEDU Laravel

## 🔴 Problema Resuelto

**Error:** `Vite manifest not found at: E:\...\public\build/manifest.json`

**Causa:** El manifest.json se genera solo cuando ejecutas `npm run build`. En desarrollo, Vite usa un servidor hot-reload.

---

## 🚀 CÓMO EJECUTAR EN DESARROLLO

### Opción 1: Desarrollo Completo (Recomendado)

Abre **dos terminales** simultáneamente:

**Terminal 1 - Servidor Vite (Hot Reload):**

```bash
npm run dev
```

Esto mantiene abierto el servidor de desarrollo de Vite en `http://localhost:5173` y recarga automáticamente cuando cambias archivos CSS/JS.

**Terminal 2 - Servidor Laravel:**

```bash
php artisan serve
```

O si prefiero especificar host/puerto:

```bash
php artisan serve --host=127.0.0.1 --port=8000
```

Luego accede a: `http://localhost:8000`

### Opción 2: Solo Build Estático (Para Testing)

Si NO quieres ejecutar el servidor Vite:

```bash
npm run build
php artisan serve
```

Esto compila los assets una sola vez en `public/build/` y no recarga automáticamente.

---

## 📦 PROCEDIMIENTO PARA PRODUCCIÓN

### 1. Compilar Assets

```bash
npm run build
```

Genera los archivos minificados en `public/build/`.

### 2. Crear archivo `.env.production` con:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com
```

### 3. Optimizar Laravel (Ejecutar en servidor de producción)

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

### 4. Subir archivos a servidor

- Incluye la carpeta `public/build/` en el deploy
- Asegúrate que `APP_ENV=production` en el servidor

---

## 📝 CAMBIOS REALIZADOS

### 1. **vite.config.js** ✅

- Seteado `manifest: true` para generar manifest.json
- Seteado `outDir: 'public/build'` (salida correcta)
- Removidas referencias a `chart.js` (no instalado)
- Optimizado para TailwindCSS v4 con @tailwindcss/vite

### 2. **AppServiceProvider.php** ✅

- Configuración automática en Laravel 12 (no requiere cambios)
- Vite se maneja automáticamente a través del helper `@vite()`

### 3. **tailwind.config.js** ✅

- Configurado `content` para purge automático de CSS no usado
- Solo CSS de clases realmente usadas se incluye en build

---

## 🔍 VERIFICACIÓN

### Para comprobar que todo está bien:

**Después de ejecutar `npm run build`, debe existir:**

```
public/build/
├── .vite/
│   └── manifest.json ✅
├── assets/
│   ├── app-[hash].css
│   ├── app-[hash].js
│   └── vendor-[hash].js
```

**En desarrollo (después de ejecutar `npm run dev`), el @vite helper:**

- Automáticamente reemplaza los archivos por referencias al servidor hot-reload
- NO requiere manifest.json
- Recarga automáticamente al guardar cambios

---

## 🐛 TROUBLESHOOTING

### Error: "Vite manifest not found"

✅ **Solución:** Ejecutar `npm run build`

### Error: "Module not found: chart.js"

✅ **Solución:** Ya está resuelto. Se removió la referencia.

### CSS/JS no aplican cambios en desarrollo

✅ **Solución:** Asegúrate que `npm run dev` está ejecutándose en otra terminal

### Puerto 5173 ya está en uso

✅ **Solución:**

```bash
npm run dev -- --port 5174
```

---

## 📊 DIFERENCIAS: npm run dev vs npm run build

| Aspecto               | `npm run dev`    | `npm run build`     |
| --------------------- | ---------------- | ------------------- |
| Propósito             | Desarrollo local | Producción          |
| Minificación          | ❌ No            | ✅ Sí               |
| Source Maps           | ✅ Sí            | ❌ No               |
| Hot Reload            | ✅ Sí            | ❌ No               |
| Velocidad compilación | ⚡ Rápido        | 🐢 Lento (optimiza) |
| Manifest.json         | ❌ No            | ✅ Sí               |
| Tamaño bundle         | Grande           | Pequeño             |

---

## ✨ BUENAS PRÁCTICAS

1. **En desarrollo:** Usa `npm run dev` + `php artisan serve`
2. **Antes de commit:** Ejecuta `npm run build` para verificar que no hay errores
3. **En producción:** Siempre usa `npm run build` + cache de Laravel
4. **Cache:** Limpia con `php artisan view:clear` si hay cambios en Blade

---

## 📞 RESUMEN RÁPIDO

```bash
# 🚀 DESARROLLO
npm run dev                    # Terminal 1
php artisan serve             # Terminal 2

# 📦 PRODUCCIÓN
npm run build                  # Compilar assets
php artisan config:cache      # Caché configuración
php artisan route:cache       # Caché rutas
php artisan view:cache        # Caché vistas
php artisan optimize          # Optimización global
```

---

**Última actualización:** 21 de Marzo, 2026
