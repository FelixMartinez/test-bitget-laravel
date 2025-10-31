# 🔐 Medidas de Seguridad - BitgetTrade

Este documento detalla todas las medidas de seguridad implementadas en la aplicación para proteger contra vulnerabilidades comunes.

## 📋 Tabla de Contenidos

1. [Protección CSRF](#protección-csrf)
2. [Protección contra Inyección SQL](#protección-contra-inyección-sql)
3. [Protección XSS](#protección-xss)
4. [Validación y Sanitización](#validación-y-sanitización)
5. [Encriptación de Datos Sensibles](#encriptación-de-datos-sensibles)
6. [Rate Limiting](#rate-limiting)
7. [Autorización y Control de Acceso](#autorización-y-control-de-acceso)
8. [Seguridad de Contraseñas](#seguridad-de-contraseñas)
9. [Protección de API Keys](#protección-de-api-keys)
10. [Headers de Seguridad](#headers-de-seguridad)

---

## 🛡️ Protección CSRF

### ¿Qué es CSRF?
Cross-Site Request Forgery es un ataque que fuerza a un usuario autenticado a ejecutar acciones no deseadas.

### Implementación:
- ✅ **Token CSRF en todos los formularios**: Cada formulario incluye `@csrf`
- ✅ **Verificación automática**: Laravel verifica el token en cada petición POST/PUT/DELETE
- ✅ **Regeneración de tokens**: Los tokens se regeneran después del login

```blade
<!-- Ejemplo en formularios -->
<form method="POST" action="{{ route('bitget.accounts.store') }}">
    @csrf
    <!-- campos del formulario -->
</form>
```

---

## 💉 Protección contra Inyección SQL

### ¿Qué es SQL Injection?
Inserción de código SQL malicioso en las consultas de la base de datos.

### Implementación:
- ✅ **Eloquent ORM**: Usa prepared statements automáticamente
- ✅ **Query Builder**: Todas las consultas están parametrizadas
- ✅ **Sin consultas SQL directas**: No se usa `DB::raw()` con entrada de usuario

```php
// ✅ SEGURO - Eloquent con validación
$accounts = Auth::user()->bitgetAccounts()
    ->where('id', $accountId)
    ->get();

// ❌ INSEGURO - NO usado en este proyecto
// $accounts = DB::select("SELECT * FROM accounts WHERE id = " . $input);
```

---

## 🚫 Protección XSS

### ¿Qué es XSS?
Cross-Site Scripting permite inyectar scripts maliciosos en páginas web.

### Implementación:
- ✅ **Blade escapa automáticamente**: `{{ $variable }}` escapa HTML
- ✅ **Función `e()`**: Escapado manual donde es necesario
- ✅ **Sanitización con `strip_tags()`**: Elimina etiquetas HTML peligrosas
- ✅ **Content Security Policy**: Headers configurados

```blade
<!-- ✅ SEGURO - Blade escapa automáticamente -->
<h2>{{ $account->name }}</h2>

<!-- ❌ INSEGURO - NO usado en este proyecto -->
<!-- <h2>{!! $account->name !!}</h2> -->
```

```php
// Escapado manual en controladores
$accountName = e($account->name);
return redirect()->back()->with('success', "Cuenta {$accountName} creada");
```

---

## ✅ Validación y Sanitización

### Validación de Entrada

#### **Registro de Usuario**
```php
'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/'],
'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
'password' => ['required', 'min:8', 'confirmed', Password::min(8)->mixedCase()->numbers()],
```

#### **Cuentas Bitget API**
```php
'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ\s\-_]+$/'],
'api_key' => ['required', 'string', 'max:500', 'regex:/^bg_[a-zA-Z0-9]+$/'],
'secret_key' => ['required', 'string', 'min:32', 'max:1000', 'regex:/^[a-fA-F0-9]+$/'],
'passphrase' => ['required', 'string', 'min:6', 'max:100'],
```

### Sanitización
```php
// Limpieza de datos antes de guardar
$validated['name'] = strip_tags(trim($validated['name']));
$validated['api_key'] = trim($validated['api_key']);
$validated['secret_key'] = trim($validated['secret_key']);
```

---

## 🔒 Encriptación de Datos Sensibles

### Datos Encriptados:
- ✅ **Secret Keys de Bitget**: Encriptadas en la base de datos
- ✅ **Passphrases**: Encriptadas en la base de datos
- ✅ **Contraseñas de usuario**: Hasheadas con bcrypt (12 rounds)

### Implementación en Modelo:
```php
// BitgetAccount.php
protected function setSecretKeyAttribute($value)
{
    $this->attributes['secret_key'] = encrypt($value);
}

protected function getSecretKeyAttribute($value)
{
    return decrypt($value);
}

// Ocultar en JSON
protected $hidden = [
    'secret_key',
    'passphrase',
];
```

---

## ⏱️ Rate Limiting

### Límites Implementados:

| Acción | Límite | Descripción |
|--------|--------|-------------|
| **Login** | 5 intentos / minuto | Previene ataques de fuerza bruta |
| **Registro** | Sin límite estricto | Validación robusta |
| **Actualizar Perfil** | 6 actualizaciones / minuto | Previene spam |
| **Eliminar Cuenta** | 3 intentos / minuto | Acción crítica |
| **Crear Cuenta API** | 5 cuentas / minuto | Previene abuso |
| **Actualizar Cuenta API** | 10 actualizaciones / minuto | Balance entre usabilidad y seguridad |
| **Eliminar Cuenta API** | 5 eliminaciones / minuto | Acción destructiva |
| **Activar Cuenta API** | 20 activaciones / minuto | Acción frecuente |
| **Refresh Balance** | 10 refreshes / minuto | Previene abuso de API |

### Implementación:
```php
// routes/web.php
Route::post('/', [BitgetAccountController::class, 'store'])
    ->name('store')
    ->middleware('throttle:5,1'); // 5 requests por minuto
```

---

## 🔐 Autorización y Control de Acceso

### Verificaciones Implementadas:

#### **Verificación de Propiedad**
```php
// En cada acción sensible
if ($account->user_id !== Auth::id()) {
    abort(403, 'No tienes permiso para realizar esta acción.');
}
```

#### **Middleware de Autenticación**
```php
Route::middleware('auth')->group(function () {
    // Solo usuarios autenticados pueden acceder
});
```

#### **Verificación de Email**
```php
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);
```

---

## 🔑 Seguridad de Contraseñas

### Requisitos:
- ✅ **Longitud mínima**: 8 caracteres
- ✅ **Complejidad**: Requiere mayúsculas, minúsculas y números
- ✅ **Confirmación**: Debe coincidir con el campo de confirmación
- ✅ **Hashing**: Bcrypt con 12 rounds (configurado en `config/hashing.php`)

### Validación:
```php
'password' => [
    'required',
    'min:8',
    'confirmed',
    Password::min(8)->mixedCase()->numbers()
],
```

### Verificación de Contraseña Actual:
```php
'current_password' => ['required', 'current_password'],
```

---

## 🔐 Protección de API Keys

### Medidas de Seguridad:

1. **Encriptación en Reposo**
   - Secret Keys y Passphrases encriptadas en la base de datos
   - Uso de la función `encrypt()` de Laravel

2. **Ocultación en Respuestas**
   ```php
   protected $hidden = ['secret_key', 'passphrase'];
   ```

3. **Validación Estricta**
   - API Key debe comenzar con `bg_`
   - Secret Key debe ser hexadecimal (32+ caracteres)
   - Passphrase debe tener 6+ caracteres

4. **Aislamiento por Usuario**
   - Cada usuario solo puede ver y editar sus propias cuentas
   - Verificación de `user_id` en cada operación

5. **No se Registran en Logs**
   - Las credenciales no se logguean en los archivos de registro

---

## 🛡️ Headers de Seguridad

### Headers Recomendados (configurar en servidor/middleware):

```php
// Agregar en middleware o servidor web
'X-Frame-Options' => 'SAMEORIGIN',
'X-Content-Type-Options' => 'nosniff',
'X-XSS-Protection' => '1; mode=block',
'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
'Content-Security-Policy' => "default-src 'self'",
```

---

## 🚨 Recomendaciones Adicionales

### Para Producción:

1. **Variables de Entorno**
   - ✅ Nunca subir `.env` al repositorio
   - ✅ `APP_DEBUG=false` en producción
   - ✅ `APP_ENV=production`
   - ✅ Generar nueva `APP_KEY`

2. **Base de Datos**
   - ✅ Usar contraseñas fuertes
   - ✅ Restringir acceso a la BD
   - ✅ Backups regulares

3. **HTTPS**
   - ✅ Forzar HTTPS en producción
   - ✅ Certificado SSL válido
   - ✅ Configurar HSTS

4. **Logs y Monitoreo**
   - ✅ Monitorear intentos de login fallidos
   - ✅ Alertas para actividad sospechosa
   - ✅ Logs de acceso a cuentas API

5. **Actualizaciones**
   - ✅ Mantener Laravel actualizado
   - ✅ Actualizar dependencias con `composer update`
   - ✅ Revisar alertas de seguridad de GitHub

---

## 🔍 Pruebas de Seguridad

### Checklist de Verificación:

- [x] Protección CSRF en todos los formularios
- [x] Validación de entrada en todos los endpoints
- [x] Sanitización de datos de salida (XSS)
- [x] Encriptación de datos sensibles
- [x] Rate limiting en acciones críticas
- [x] Autorización en cada acción
- [x] Contraseñas hasheadas correctamente
- [x] API Keys encriptadas
- [x] Sin consultas SQL directas
- [x] Mensajes de error no revelan información sensible

---

## 📚 Recursos Adicionales

- [Laravel Security Best Practices](https://laravel.com/docs/security)
- [OWASP Top 10](https://owasp.org/www-project-top-ten/)
- [Laravel Security Checklist](https://github.com/Grohden/laravel-security-checklist)

---

**Última actualización**: 30 de Octubre de 2025  
**Responsable de Seguridad**: Equipo de Desarrollo  
**Contacto de Seguridad**: security@bitgettrade.com
