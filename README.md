# 🍽️ Restaurante Escuela — Sistema de Gestión

Sistema completo de gestión para el **Restaurante Escuela / Cafetería Escuela** construido con **Laravel 12**, **MySQL** y autenticación **Sanctum**.

---

## ✨ Características

- ✅ **111 endpoints REST** distribuidos en 22 recursos
- ✅ **Autenticación con tokens** (Laravel Sanctum)
- ✅ **Middleware de roles** aplicado a rutas
- ✅ **Kardex automático** de materia prima
- ✅ **Autoconsumo** registrado en cierres de caja
- ✅ **CRUD visual** de platillos
- ✅ **Documentación web** en `/docs`
- ✅ **Dashboard** con estadísticas en `/dashboard`
- ✅ **API Playground** interactivo en `/playground`
- ✅ **Seeders** para poblar la BD con un comando

---

## 📋 Requisitos

- PHP 8.2+
- Composer 2.x
- MySQL / MariaDB
- XAMPP / Laragon

---

## ⚙️ Instalación

```bash
git clone https://github.com/yamishukehiro4-max/Restaurante_Escuela.git
cd Restaurante_Escuela
composer install
cp .env.example .env
php artisan key:generate

# Configurar .env con los datos de MySQL
# Crear la base de datos "restaurante_escuela" en phpMyAdmin

php artisan migrate:fresh --seed
php artisan serve