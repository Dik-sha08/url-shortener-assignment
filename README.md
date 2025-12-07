
# **URL Shortener – Backend Assignment**

This project is a role-based URL Shortener system built using **Laravel 12**, **MySQL**, **Policies**, **Migrations**, **Seeders**, and **Feature Tests**.
The application supports:

* Company-wise user management
* Role-based access control (SuperAdmin, Admin, Member, Sales, Manager)
* Short URL creation restrictions based on user role
* Private URL resolution (no public redirects)
* User invitation logic (rules included in controllers)
* Full automated tests for all requirements

---

## **🔧 Tech Stack Used**

* **Laravel 12.x**
* **PHP 8.2+**
* **Composer**
* **MySQL**
* **Laravel Breeze (Auth UI)**
* **PHPUnit (Feature Tests)**

---

# **🚀 How to Set Up Project Locally**

Follow these steps to run the project on your system.

---

## **1️⃣ Clone the Repository**

```bash
git clone https://github.com/Dik-sha08/url-shortener-assignment.git
```

Go inside project folder:

```bash
cd url-shortener-assignment
```

---

## **2️⃣ Install Dependencies**

Make sure Composer is installed.
Then run:

```bash
composer install
```

---

## **3️⃣ Create Environment File**

Duplicate the example env:

```bash
cp .env.example .env
```

Generate app key:

```bash
php artisan key:generate
```

---

## **4️⃣ Configure Database (MySQL)**

Open `.env` and update these values:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url_shortener
DB_USERNAME=urluser
DB_PASSWORD=Diksha@123#
```

Ensure the database and user exist.
(Already created during assignment.)

---

## **5️⃣ Run Migrations**

```bash
php artisan migrate
```

If needed (fresh install):

```bash
php artisan migrate:fresh
```

---

## **6️⃣ Seed Super Admin User**

```bash
php artisan db:seed
```

This creates:

* **Super Admin user**
* email: `superadmin@example.com`
* password: `password`
  (Defined in seeder)

---

## **7️⃣ Run the Development Server**

```bash
php artisan serve
```

Application runs at:

```
http://127.0.0.1:8000
```

---

# **👥 Role-Based Permissions**

| Role       | Create URL       | View URLs         | Invite Users    |
| ---------- | ---------------- | ----------------- | --------------- |
| SuperAdmin | ❌                | ✔️                | ✔️ (restricted) |
| Admin      | ❌                | ✔️ (company only) | ❌ invite Admin  |
| Member     | ❌                | ✔️ (only own)     | ❌               |
| Sales      | ✔️ **(Allowed)** | ✔️ (company only) | ❌               |
| Manager    | ✔️ **(Allowed)** | ✔️ (company only) | ❌               |

---

# **📌 Testing the Application**

## **Run All Automated Tests**

```bash
php artisan test
```

This runs feature tests verifying:

* Role permissions
* URL visibility rules
* URL creation rules
* Private URL resolution
* Auth flows (register, login, logout, password reset)

If all tests pass, output will show:

```
All tests passed!
```

---

# **🧪 Example Test Users**

After seeding, log in with:

**Super Admin**

```
Email: superadmin@example.com
Password: password
```

To test Sales role, manually update a user:

```sql
UPDATE users
SET role='Sales', company_id=1
WHERE email='your-email@example.com';
```

---

# **🔗 Project Features**

✔ Company-wise grouping
✔ Short URL creation
✔ Private URL resolution
✔ Policies for authorization
✔ Complete migrations & seeders
✔ Breeze authentication
✔ Full PHPUnit test coverage

---

# **📄 License**

This project is open-source and licensed under the **MIT License**.




