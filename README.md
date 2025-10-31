# 🚀 BitgetTrade - Plataforma de Trading con Bitget

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-red.svg" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-blue.svg" alt="PHP">
  <img src="https://img.shields.io/badge/TailwindCSS-4.x-38bdf8.svg" alt="Tailwind">
  <img src="https://img.shields.io/badge/SQLite-Database-003B57.svg" alt="SQLite">
</p>

Una plataforma moderna y elegante para gestionar tus operaciones de trading en Bitget. Conecta múltiples cuentas API, visualiza tu balance en tiempo real y administra tus operaciones desde una interfaz intuitiva y profesional.

## ✨ Características

- 🔐 **Autenticación segura** con Laravel Breeze
- 💰 **Visualización de balance** en tiempo real desde Bitget
- 🔑 **Gestión de múltiples cuentas API** de Bitget
- 📊 **Dashboard interactivo** con estadísticas y métricas
- 🎨 **Diseño moderno** con Tailwind CSS y gradientes
- 📱 **Totalmente responsive** para todos los dispositivos
- 🌙 **Efectos glassmorphism** y animaciones suaves
- ⚡ **Actualización en tiempo real** del balance

## 📋 Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- **PHP** >= 8.2
- **Composer** >= 2.0
- **Node.js** >= 18.x y **npm** >= 9.x
- **SQLite** (incluido en PHP)
- **Laragon** (recomendado para Windows) o tu servidor local preferido

## 🚀 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/bitget-laravel.git
cd bitget-laravel
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias de Node.js

```bash
npm install
```

### 4. Configurar el archivo de entorno

Copia el archivo de ejemplo y configura tus credenciales:

```bash
copy .env.example .env
```

Edita el archivo `.env` y configura:

```env
APP_NAME="BitgetTrade"
APP_URL=http://127.0.0.1:8000

# Base de datos SQLite (ya configurado)
DB_CONNECTION=sqlite
```

> **✅ Nota**: Las credenciales de Bitget API ya NO se configuran en el `.env`.
> Ahora se gestionan desde la interfaz web después de iniciar sesión.

### 5. Generar la clave de la aplicación

```bash
php artisan key:generate
```

### 6. Crear la base de datos y ejecutar migraciones

```bash
# Crear el archivo de base de datos SQLite
type nul > database/database.sqlite

# Ejecutar migraciones
php artisan migrate
```

### 7. Compilar los assets

Para desarrollo (con hot reload):
```bash
npm run dev
```

Para producción:
```bash
npm run build
```

### 8. Iniciar el servidor

En una nueva terminal:
```bash
php artisan serve
```

La aplicación estará disponible en: **http://127.0.0.1:8000**

## 🔑 Obtener Credenciales de Bitget

Para usar la aplicación necesitas crear una API Key en Bitget:

1. Ve a [Bitget](https://www.bitget.com) e inicia sesión
2. Navega a **Cuenta → API Management** o ve a: https://www.bitget.com/account/newapi
3. Crea una nueva API Key con los siguientes permisos:
   - ✅ **Read** (lectura de balance)
   - ❌ **Trade** (no necesario para ver balance)
   - ❌ **Withdraw** (nunca habilites esto)
4. Guarda tu **API Key**, **Secret Key** y **Passphrase** (solo se muestran una vez)
5. **Inicia sesión en la aplicación** y ve a "Cuentas API"
6. Haz clic en **"Agregar Cuenta"** e ingresa tus credenciales allí

⚠️ **Importante**: Nunca compartas tus credenciales API y solo habilita los permisos necesarios.

## 📖 Uso de la Aplicación

### Primer Uso

1. **Registrarse**: 
   - Accede a `/register` o la aplicación te redirigirá automáticamente
   - Crea tu cuenta con email y contraseña

2. **Iniciar Sesión**: 
   - Después del registro, serás redirigido al dashboard

3. **Agregar Cuenta API de Bitget**: 
   - Ve a **"Cuentas API"** en el menú de navegación
   - Haz clic en **"Agregar Cuenta"**
   - Completa el formulario:
     - Nombre de la cuenta (ej: "Cuenta Principal")
     - API Key (obtenida de Bitget)
     - Secret Key (obtenida de Bitget)
     - Passphrase (obtenida de Bitget)
     - Marca "Modo demostración" si quieres probar sin usar la API real

4. **Ver Balance**: 
   - Navega a "Balance" en el menú
   - El sistema mostrará tu balance usando la cuenta activa
   - Si tienes varias cuentas, puedes cambiar entre ellas desde "Cuentas API"

### Gestión de Múltiples Cuentas

Cada usuario puede gestionar múltiples cuentas API de Bitget:

- ➕ **Agregar cuentas**: Tantas como necesites desde "Cuentas API"
- 🎯 **Cuenta activa**: Solo una cuenta está activa a la vez
- 🔄 **Cambiar entre cuentas**: Con un solo clic desde la lista de cuentas
- ✏️ **Editar credenciales**: Actualiza API keys cuando sea necesario
- 🗑️ **Eliminar cuentas**: Borra cuentas que ya no uses

Las credenciales se almacenan de forma segura en la base de datos (no en archivos `.env`).

### Modo Demo

Al crear una cuenta, puedes marcar **"Modo demostración"**:

- ✅ La cuenta se guarda pero **no consulta la API real** de Bitget
- ✅ Útil para pruebas sin consumir llamadas a la API
- ✅ Puedes desactivar el modo demo más tarde para usar la API real
- ✅ Ideal para desarrollo y testing

## 🛠️ Comandos Útiles

```bash
# Limpiar caché
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Ejecutar migraciones frescas (⚠️ elimina todos los datos)
php artisan migrate:fresh

# Ver rutas disponibles
php artisan route:list

# Compilar assets para producción
npm run build

# Ver logs en tiempo real
tail -f storage/logs/laravel.log
```

## 🎨 Tecnologías Utilizadas

- **Backend**: Laravel 11.x
- **Frontend**: Tailwind CSS 4.x con gradientes personalizados
- **Base de datos**: SQLite
- **Autenticación**: Laravel Breeze
- **API**: Bitget REST API
- **Fuente**: Inter (Google Fonts)
- **Iconos**: Heroicons (SVG)

## 📁 Estructura del Proyecto

```
├── app/
│   ├── Http/Controllers/
│   │   ├── BitgetController.php       # Controlador para balance
│   │   └── BitgetAccountController.php # Gestión de cuentas
│   ├── Models/
│   │   ├── BitgetAccount.php          # Modelo de cuentas API
│   │   └── User.php
│   └── Services/
│       └── BitgetService.php          # Servicio de integración con API
├── resources/
│   ├── views/
│   │   ├── auth/                      # Vistas de autenticación
│   │   ├── bitget/                    # Vistas de Bitget
│   │   ├── layouts/                   # Layouts principales
│   │   └── dashboard.blade.php        # Dashboard principal
│   └── css/
│       └── app.css                    # Estilos Tailwind
├── routes/
│   └── web.php                        # Rutas de la aplicación
└── database/
    └── migrations/                    # Migraciones de base de datos
```

## 🔒 Seguridad

- ✅ Las claves API se almacenan encriptadas en la base de datos
- ✅ Autenticación obligatoria para todas las operaciones
- ✅ Validación de datos en formularios
- ✅ Protección CSRF en todos los formularios
- ✅ Solo se permiten permisos de lectura en la API

## 🐛 Solución de Problemas

### Error: "Base table or view not found"
```bash
php artisan migrate:fresh
```

### Los estilos no se aplican
```bash
npm run build
php artisan view:clear
```

### Error de conexión con Bitget
- Verifica que tus credenciales API sean correctas
- Asegúrate de que la API Key tenga permisos de lectura
- Revisa que `BITGET_BASE_URL` sea `https://api.bitget.com`

### La página muestra código sin compilar
```bash
npm install
npm run dev
```

## 📝 Licencia

Este proyecto está bajo la licencia MIT. Puedes usarlo libremente para proyectos personales o comerciales.

## 🤝 Contribuciones

Las contribuciones son bienvenidas. Por favor:

1. Haz fork del proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📧 Contacto

Si tienes preguntas o sugerencias, no dudes en abrir un issue en el repositorio.

---

**Desarrollado con ❤️ usando Laravel y Tailwind CSS**
