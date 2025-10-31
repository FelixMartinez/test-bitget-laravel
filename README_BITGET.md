# Laravel + Bitget Integration

Este proyecto integra Laravel con la API de Bitget para mostrar el balance de cuenta de forma segura.

## 🚀 Características

- ✅ Sistema de autenticación completo con Laravel Breeze
- ✅ Integración con API de Bitget
- ✅ Visualización de balance de cuenta Spot
- ✅ Actualización de balance en tiempo real (AJAX)
- ✅ Interface moderna y responsive
- ✅ Rutas protegidas con autenticación

## 📋 Requisitos

- PHP >= 8.2
- Composer
- Node.js y NPM
- SQLite (incluido por defecto en Laravel)
- Cuenta de Bitget con API Key

## 🔧 Instalación

### 1. Clonar o usar el proyecto

El proyecto ya está creado en: `C:\laragon\www\test-bitget-laravel`

### 2. Configurar las variables de entorno

Edita el archivo `.env` y agrega tus credenciales de Bitget:

```env
BITGET_API_KEY=tu_api_key
BITGET_SECRET_KEY=tu_secret_key
BITGET_PASSPHRASE=tu_passphrase
BITGET_BASE_URL=https://api.bitget.com
```

### 3. Ejecutar las migraciones (ya ejecutadas)

```bash
php artisan migrate
```

### 4. Instalar dependencias de frontend

```bash
npm install
npm run build
```

## 🔐 Cómo obtener las credenciales de Bitget

1. **Inicia sesión en Bitget**: Ve a [https://www.bitget.com](https://www.bitget.com)

2. **Accede a la gestión de API**:
   - Ve a tu perfil (esquina superior derecha)
   - Selecciona "API Management" o "Gestión de API"

3. **Crea una nueva API Key**:
   - Haz clic en "Create API"
   - Dale un nombre (ej: "Laravel App")
   - Configura los permisos: **Solo lectura (Read)**
   - Guarda bien el API Key, Secret Key y Passphrase

4. **Configuración de seguridad importante**:
   - ⚠️ **NO** habilites permisos de Trading o Withdrawal
   - ✅ Solo habilita permisos de **lectura (Read)**
   - ✅ Considera agregar restricción por IP si es posible

5. **Copia las credenciales al .env**:
   ```env
   BITGET_API_KEY=bg_xxxxxxxxxxxxxxxxx
   BITGET_SECRET_KEY=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
   BITGET_PASSPHRASE=tu_frase_secreta
   ```

## 🚀 Iniciar el servidor

```bash
php artisan serve
```

El sitio estará disponible en: `http://localhost:8000`

## 📱 Uso

### 1. Registro/Login

- Ve a `/register` para crear una cuenta
- O ve a `/login` si ya tienes una cuenta

### 2. Ver Balance de Bitget

- Una vez autenticado, haz clic en "💰 Balance Bitget" en el menú
- Verás tu balance de cuenta Spot con todas las monedas
- Puedes actualizar el balance haciendo clic en "🔄 Actualizar Balance"

## 📁 Estructura del Proyecto

```
app/
├── Http/Controllers/
│   └── BitgetController.php      # Controlador para manejar las peticiones
├── Services/
│   └── BitgetService.php         # Servicio para consumir la API de Bitget
resources/
└── views/
    └── bitget/
        └── balance.blade.php     # Vista del balance
routes/
└── web.php                       # Rutas de la aplicación
config/
└── services.php                  # Configuración de servicios de terceros
```

## 🔒 Seguridad

- ✅ Todas las rutas de Bitget están protegidas con middleware `auth`
- ✅ Las credenciales se almacenan en el archivo `.env` (nunca en el código)
- ✅ Se usa HTTPS para comunicación con la API
- ✅ Firma HMAC SHA256 para autenticación en API
- ✅ No se almacenan datos sensibles en la base de datos

## 🛠️ Funcionalidades del Servicio Bitget

### `BitgetService::getAccountBalance()`

Obtiene el balance completo de la cuenta Spot desde la API de Bitget.

**Retorna:**
```php
[
    'success' => true|false,
    'data' => [...],  // Array con los balances
    'message' => 'Mensaje descriptivo'
]
```

### `BitgetService::formatBalance($balanceData)`

Formatea los datos del balance para mostrarlos en la vista de forma amigable.

**Retorna:**
```php
[
    [
        'coin' => 'BTC',
        'available' => '0.12345678',
        'frozen' => '0.00000000',
        'total' => '0.12345678',
        'usdValue' => '$4,567.89'
    ],
    // ... más activos
]
```

## 📊 Vista del Balance

La vista muestra:

- 💰 Lista de todas las monedas con balance > 0
- 📈 Balance disponible, congelado y total
- 💵 Valor aproximado en USD
- 🔄 Botón para actualizar el balance en tiempo real
- ⏰ Timestamp de última actualización
- ℹ️ Información útil sobre los datos mostrados

## 🐛 Solución de Problemas

### Error: "Call to undefined method middleware()"

Ya corregido. El middleware se aplica en las rutas (`web.php`) en lugar del constructor.

### Error: "Invalid API credentials"

Verifica que:
- Las credenciales en `.env` sean correctas
- No haya espacios extra en las credenciales
- La API Key esté activa en Bitget

### Error: "Connection timeout"

Verifica tu conexión a internet y que Bitget no esté bloqueado en tu red.

## 📝 Notas Importantes

1. **Modo Demo**: Si no tienes cuenta de Bitget, la aplicación mostrará un mensaje de error amigable.

2. **Rate Limiting**: Bitget tiene límites de peticiones. El botón de actualizar tiene un control para evitar abuso.

3. **Caché**: Los datos NO se almacenan en caché por seguridad. Cada consulta es en tiempo real.

4. **Logs**: Los errores se registran en `storage/logs/laravel.log`

## 📚 Recursos Adicionales

- [Documentación de Laravel](https://laravel.com/docs)
- [Documentación API de Bitget](https://bitgetlimited.github.io/apidoc/en/spot/)
- [Laravel Breeze](https://laravel.com/docs/starter-kits#breeze)

## 🤝 Contribuciones

Este es un proyecto de demostración. Siéntete libre de mejorarlo y adaptarlo a tus necesidades.

## 📄 Licencia

Este proyecto es de código abierto y está disponible bajo la licencia MIT.

---

**Desarrollado con ❤️ usando Laravel y la API de Bitget**
