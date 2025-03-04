<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Blog Test
Prueba técnica - Backend con Laravel y Livewire.

## Requisitos previos
Antes de instalar el proyecto, asegúrate de tener instalado lo siguiente:
- **PHP 8.2 o superior**: Puedes verificarlo con `php -v`.
- **Composer**: Para instalar dependencias de PHP (`composer --version`).
- **Node.js y npm**: Para manejar dependencias frontend (`node -v` y `npm -v`).
- **MySQL**: Asegúrate de tener un servidor MySQL corriendo (o usa SQLite si lo prefieres).
- **Git**: Para clonar el repositorio (`git --version`).

## Stack tecnológico
- **PHP 8.2**
- **Laravel 12.0**
- **Livewire 3.6**
- **MySQL** (base de datos local; también se puede usar SQLite)
- **Tailwind CSS** (para estilos)
- **Flowbite** (para componentes interactivos como dropdowns)
- **Node.js y npm** (para manejar dependencias frontend)

## Instalación
1. Clonar el repositorio: `git clone <URL>`
2. Instalar dependencias: `composer install` y `npm install`
3. Copiar `.env.example` a `.env` y configurar la base de datos.
4. Generar la clave: `php artisan key:generate`
5. Migrar la base de datos: `php artisan migrate`
6. Iniciar el servidor: `php artisan serve`
7. Importante ejecutar a la par en otra terminal php artisan serve esto: `npm run dev`, esto para cargar los estilos de tailwind.

