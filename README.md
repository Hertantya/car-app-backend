## ⚙️ Setup Instructions

### Step 1 — Start XAMPP

Open **XAMPP Control Panel** and click **Start** on both:
- Apache
- MySQL

---

### Step 2 — Create the Database

1. Open your browser and go to:
   ```
   http://localhost/phpmyadmin
   ```
2. Click **New** on the left sidebar
3. Enter database name:
   ```
   car_db
   ```
4. Set collation to: `utf8mb4_unicode_ci`
5. Click **Create**

---

### Step 3 — Clone the Repository

```bash
git clone https://github.com/your-username/car-app-backend.git
cd car-app-backend
```

---

### Step 4 — Install Dependencies

```bash
composer install
```

---

### Step 5 — Configure Environment

```bash
cp .env.example .env
```

Open `.env` and update these values:

```dotenv
APP_NAME="Car App"
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=car_db
DB_USERNAME=root
DB_PASSWORD=
```

> **Note:** Leave `DB_PASSWORD` empty if you are using the default XAMPP setup.

---

### Step 6 — Generate App Key

```bash
php artisan key:generate
```

---

### Step 7 — Run Migrations

```bash
php artisan migrate
```

This will create all the required tables:
- `users`
- `cars`
- `user_preferences`
- `personal_access_tokens`

---

### Step 8 — Seed the Database

```bash
php artisan db:seed
```

This will insert:
- 30 car records
- 1 admin account
- 1 sample user account

---

### Step 9 — Start the Server

```bash
php artisan serve
```

The server will run at:
```
http://localhost:8000
```

---

## 🔐 Default Login Credentials

### Admin Dashboard
| Field    | Value               |
|----------|---------------------|
| URL      | http://localhost:8000/admin/login |
| Email    | admin@carapp.com    |
| Password | password            |

### Mobile App / API User
| Field    | Value               |
|----------|---------------------|
| Email    | user@carapp.com     |
| Password | password            |

---

## 🖥️ Admin Dashboard Pages

| Page           | URL                          | Description                        |
|----------------|------------------------------|------------------------------------|
| Login          | `/admin/login`               | Admin sign in                      |
| Dashboard      | `/admin/dashboard`           | Overview stats                     |
| Users          | `/admin/users`               | All mobile users + activity        |
| Car Inventory  | `/admin/cars`                | View and manage 30 cars            |
| Add Car        | `/admin/cars/create`         | Add a new car                      |
| Reports        | `/admin/reports`             | Per-user liked brand, model, type  |

---

## 📡 API Endpoints

Base URL: `http://localhost:8000/api`

All protected endpoints require this header:
```
Authorization: Bearer {token}
Accept: application/json
```

| Method | Endpoint                  | Auth     | Description               |
|--------|---------------------------|----------|---------------------------|
| POST   | `/api/register`           | No       | Register new user         |
| POST   | `/api/login`              | No       | Login, returns token      |
| POST   | `/api/logout`             | Required | Logout                    |
| GET    | `/api/cars`               | Required | Get all cars              |
| POST   | `/api/preferences`        | Required | Save a swipe              |
| GET    | `/api/preferences`        | Required | Get user's swipes         |
| POST   | `/api/preferences/sync`   | Required | Batch sync offline swipes |
| GET    | `/api/reports`            | Required | Get user's report         |

### Test Login via Postman / Hoppscotch

```
POST http://localhost:8000/api/login

Headers:
  Content-Type: application/json
  Accept: application/json

Body:
{
  "email": "user@carapp.com",
  "password": "password"
}
```

> ⚠️ Do **not** use the admin email on the API — it will be rejected. The admin only logs in via the browser dashboard.

---

## 🗄️ Database Schema

```
users               → id, name, email, password, role (admin/user)
cars                → id, brand, model, type, image_url, is_active
user_preferences    → id, user_id, car_id, action (like/skip)
personal_access_tokens → Sanctum API tokens
```

---

## 🛠️ Useful Commands

```bash
# Reset everything and re-seed
php artisan migrate:fresh --seed

# Clear all caches (run this if something feels broken)
php artisan config:clear
php artisan cache:clear
php artisan route:clear

# View all registered routes
php artisan route:list
```

---

## ❗ Troubleshooting

**ERR_TOO_MANY_REDIRECTS**
- Clear browser cookies or open an Incognito window
- Run `php artisan config:clear` then restart the server

**Database connection error**
- Make sure MySQL is running in XAMPP Control Panel
- Check `DB_DATABASE=car_db` and `DB_PASSWORD=` in `.env`

**419 Page Expired on login**
- Run `php artisan config:clear` and `php artisan cache:clear`

**API returns HTML instead of JSON**
- Make sure you are sending the `Accept: application/json` header
