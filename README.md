# University Platform

A simple and clean Laravel CRUD application I built to manage student records and university news. It also fetches global university data dynamically using a public API. For the frontend, I focused on creating a modern UI from scratch with a nice frosted-glass effect, without relying too heavily on heavy frameworks.

## Features
- **Student Management:** Standard CRUD for student profiles (with image uploads).
- **News Updates:** Internal news system to publish, edit, and toggle active/inactive news.
- **REST API Integration:** Fetches and displays a list of global universities via an external public API, using AJAX and DataTables.
- **Authentication:** Standard Laravel auth for protecting the CRUD operations. Guests can only view the public data.
- **Custom UI:** Built a custom clean and slightly transparent design using Vanilla CSS and Bootstrap 5.

## Tech Stack
- Laravel 10 (PHP 8+)
- MySQL
- Bootstrap 5 & Custom CSS
- jQuery, Axios, DataTables

## How to run it locally

1. **Clone the repo**
   ```bash
   git clone https://github.com/your-username/university-platform.git
   cd university-platform
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Set up the environment**
   Copy the example file to `.env`:
   ```bash
   cp .env.example .env
   ```
   Generate the app key:
   ```bash
   php artisan key:generate
   ```

4. **Database (XAMPP / MySQL)**
   Open your `.env` file and configure the database. If you use XAMPP, just make sure Apache and MySQL are running, create an empty DB in phpMyAdmin, and leave the password blank:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Migrate the database**
   ```bash
   php artisan migrate
   ```

6. **Start the server**
   ```bash
   php artisan serve
   ```
   Now visit `http://localhost:8000`.

7. **Create a User Account**
   By default, there are no users in the database. When you first start the application, you must go to the **Register** page to create an account before you can log in and access the dashboard.

---

Feedback and contributions are welcome.