# 💼 Sistema de Gestión RRHH – Intelafix (Laravel 11 + MySQL)

Aplicación web desarrollada en Laravel 11 para gestionar empleados y logros internos dentro de Intelafix.  
Incluye módulos de listado, creación y edición de empleados.

---

## 🚀 Características principales
- CRUD de empleados.
- Registro y visualización de logros.
- Validaciones de formularios.
- Sistema estructurado por controladores, modelos y vistas Blade.
- Uso de Eloquent ORM.

---

## 🛠 Tecnologías utilizadas
- PHP 8+
- Laravel 11
- MySQL
- Composer
- XAMPP
- Blade Templates

---

## 📁 Estructura del proyecto
/intelafix-rrhh
/app
/database
/public
/resources/views
/routes
/screenshots

## 🧰 Instalación

### 1. Clonar el repositorio
git clone https://github.com/ATejeda21/intelafix-rrhh.git
cd intelafix-rrhh

### 2. Instalar dependencias
composer install

### 3. Configurar archivo .env
cp .env.example .env
Editar credenciales MySQL (puerto 3306).

### 4. Generar clave de Laravel
php artisan key:generate

---

## 🖼 Screenshots 
![Empleados](https://github.com/user-attachments/assets/799a5d88-c19d-46ea-b282-e3a38856534d)
![form CrearEmpleado](https://github.com/user-attachments/assets/02176253-e0cf-400b-ba79-7302d7e945c4)

![Logros](https://github.com/user-attachments/assets/6460cafc-d613-4f66-a748-734bb3d2de94)
![Guardar logro](https://github.com/user-attachments/assets/ca0631cf-c2ac-4a40-81f4-9a5406833ac8)

---

## ▶️ Ejecución del proyecto

### 1. Iniciar XAMPP  
Encender:
- Apache  
- MySQL  

### 2. Ejecutar servidor Laravel
php artisan serve

Acceder a:
http://127.0.0.1:8000

---

## ⛔ Detener
CTRL + C

---

## 👤 Autor
**Fredy Alejandro Tejeda Recinos**
________________________________________

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
