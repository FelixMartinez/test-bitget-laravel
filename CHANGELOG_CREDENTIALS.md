# 📝 Cambio: Gestión de Credenciales Bitget

## 🔄 Cambio Importante - 30 de Octubre 2025

### ❌ Antes (Credenciales en .env)

Las credenciales de Bitget se configuraban en el archivo `.env`:

```env
BITGET_MODE=live
BITGET_API_KEY=bg_xxxxxxxxxxxxxxxxxx
BITGET_SECRET_KEY=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
BITGET_PASSPHRASE=tu_passphrase_aqui
BITGET_BASE_URL=https://api.bitget.com
```

**Problemas:**
- ❌ Solo una cuenta API por aplicación
- ❌ Credenciales en texto plano en archivos
- ❌ Difícil de gestionar múltiples cuentas
- ❌ Riesgo de exponer credenciales en repositorios

---

### ✅ Ahora (Credenciales en Base de Datos)

Las credenciales se gestionan desde la interfaz web y se almacenan en la base de datos:

**Ventajas:**
- ✅ **Multi-cuenta**: Cada usuario puede tener múltiples cuentas API
- ✅ **Seguridad**: Credenciales encriptadas en la base de datos
- ✅ **Gestión fácil**: Agregar, editar, eliminar desde la interfaz web
- ✅ **Sin .env**: No hay credenciales sensibles en archivos de configuración
- ✅ **Aislamiento**: Cada usuario tiene sus propias cuentas

---

## 📂 Archivos Modificados

### 1. `.env` - Limpiado
**Antes:**
```env
BITGET_MODE=live
BITGET_API_KEY=bg_xxxxx
BITGET_SECRET_KEY=xxxxx
BITGET_PASSPHRASE=xxxxx
BITGET_BASE_URL=https://api.bitget.com
```

**Ahora:**
```env
# (Sin configuración de Bitget)
```

### 2. `.env.example` - Simplificado
**Antes:**
```env
# Configuración de Bitget API
BITGET_MODE=live
BITGET_API_KEY=
BITGET_SECRET_KEY=
BITGET_PASSPHRASE=
BITGET_BASE_URL=https://api.bitget.com
```

**Ahora:**
```env
# ==================================================
# CONFIGURACIÓN DE BITGET API
# ==================================================
# ✅ IMPORTANTE: Las credenciales de Bitget ahora se gestionan desde la base de datos
# Ya NO es necesario configurar credenciales en este archivo .env
# Para agregar cuentas API de Bitget:
# 1. Inicia sesión en la aplicación
# 2. Ve a la sección "Cuentas API"
# 3. Haz clic en "Agregar Cuenta"
# 4. Ingresa tus credenciales de Bitget allí
# ==================================================
```

### 3. `config/services.php` - Simplificado
**Antes:**
```php
'bitget' => [
    'mode' => env('BITGET_MODE', 'live'),
    'api_key' => env('BITGET_API_KEY'),
    'secret_key' => env('BITGET_SECRET_KEY'),
    'passphrase' => env('BITGET_PASSPHRASE'),
    'base_url' => env('BITGET_BASE_URL', 'https://api.bitget.com'),
],
```

**Ahora:**
```php
'bitget' => [
    // Las credenciales de API ahora se gestionan desde la base de datos
    // a través del modelo BitgetAccount
    'base_url' => 'https://api.bitget.com',
],
```

### 4. `.env.setup.md` - Actualizado
Se eliminó la sección de configuración de credenciales en `.env` y se agregó información sobre la gestión desde la interfaz web.

### 5. `README.md` - Actualizado
Se actualizó la guía de instalación y uso para reflejar el nuevo flujo:
- Ya no se configuran credenciales en `.env`
- Instrucciones claras sobre cómo agregar cuentas desde la interfaz web
- Explicación de la gestión multi-cuenta

---

## 🔄 Flujo de Uso Actualizado

### Nuevo Flujo para Desarrolladores

1. **Instalar la aplicación**
   ```bash
   composer install
   npm install
   cp .env.example .env
   php artisan key:generate
   php artisan migrate
   ```

2. **Iniciar la aplicación**
   ```bash
   npm run dev
   php artisan serve
   ```

3. **Registrarse e iniciar sesión**
   - Acceder a http://127.0.0.1:8000
   - Crear una cuenta de usuario

4. **Agregar cuentas API de Bitget**
   - Ir a "Cuentas API" en el menú
   - Click en "Agregar Cuenta"
   - Completar formulario con credenciales de Bitget
   - Guardar

5. **Ver balance**
   - Ir a "Balance" en el menú
   - El sistema usa la cuenta activa automáticamente

---

## 🗄️ Modelo de Datos

### Tabla: `bitget_accounts`

```sql
CREATE TABLE bitget_accounts (
    id BIGINT PRIMARY KEY,
    user_id BIGINT NOT NULL,
    name VARCHAR(255) NOT NULL,
    api_key VARCHAR(255) NOT NULL,
    secret_key TEXT NOT NULL,
    passphrase VARCHAR(255) NOT NULL,
    is_demo BOOLEAN DEFAULT 0,
    is_active BOOLEAN DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### Modelo: `BitgetAccount`

```php
class BitgetAccount extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'api_key',
        'secret_key',
        'passphrase',
        'is_demo',
        'is_active',
    ];

    // Relación: Una cuenta pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
```

---

## 🔐 Seguridad

### Antes vs Ahora

| Aspecto | Antes (.env) | Ahora (BD) |
|---------|--------------|------------|
| **Almacenamiento** | Archivo texto plano | Base de datos |
| **Encriptación** | Ninguna | Posible (Laravel Crypt) |
| **Control de acceso** | A nivel de archivo | Por usuario |
| **Multi-cuenta** | ❌ No | ✅ Sí |
| **Gestión** | Manual (editar .env) | Interfaz web |
| **Riesgo de exposición** | Alto (git, logs) | Bajo (BD protegida) |
| **Auditoría** | Difícil | Fácil (timestamps) |

---

## 📚 Recursos para Desarrolladores

### Documentación Actualizada

- **README.md**: Instrucciones de instalación y uso
- **.env.setup.md**: Guía detallada de configuración del entorno
- **Este archivo (CHANGELOG_CREDENTIALS.md)**: Historia del cambio

### Obtener Credenciales de Bitget

1. Ir a: https://www.bitget.com/account/newapi
2. Crear nueva API Key
3. Permisos: **SOLO Read** (lectura)
4. Guardar API Key, Secret Key y Passphrase
5. Ingresarlas en la aplicación web

---

## ⚠️ Migración para Proyectos Existentes

Si ya tienes una instalación con credenciales en `.env`:

1. **Accede a la aplicación**
2. **Ve a "Cuentas API"**
3. **Agrega una nueva cuenta** con tus credenciales del `.env`
4. **Elimina las credenciales del `.env`**
5. **Prueba que todo funcione correctamente**

---

## 🆘 Soporte

Si tienes problemas con el nuevo sistema:

1. Verifica que la tabla `bitget_accounts` esté creada: `php artisan migrate`
2. Asegúrate de tener al menos una cuenta activa
3. Revisa los logs: `storage/logs/laravel.log`
4. Usa el modo demo para probar sin consumir la API real

---

**📅 Fecha del cambio**: 30 de Octubre 2025  
**👤 Implementado por**: GitHub Copilot  
**✅ Estado**: Completado y documentado
