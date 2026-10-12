# 🍽️ Restaurante Escuela — API REST

Sistema completo de gestión para el **Restaurante Escuela / Cafetería Escuela** construido con **Laravel 12**, **MySQL** y autenticación **Sanctum**.

---

## 🎯 Características

- ✅ **111 endpoints REST** distribuidos en 22 recursos
- ✅ **Autenticación con tokens** (Laravel Sanctum)
- ✅ **Middleware de roles** personalizado
- ✅ **Kardex automático** de materia prima
- ✅ **Autoconsumo** registrado en cierres de caja
- ✅ **Transacciones atómicas** en ventas y movimientos
- ✅ **Documentación web** interactiva en `/docs`
- ✅ **Dashboard** con estadísticas en tiempo real en `/dashboard`
- ✅ **Seeders automáticos** para poblar la BD con un comando

---

## 📋 Requisitos

- PHP 8.2+
- Composer 2.x
- MySQL 5.7+ (o MariaDB)
- XAMPP / WAMP / Laragon

---

## ⚙️ Instalación

```bash
git clone <url-del-repo>
cd restaurante_escuela
composer install
cp .env.example .env
php artisan key:generate
# Configurar la BD en .env
php artisan migrate:fresh --seed
php artisan serve