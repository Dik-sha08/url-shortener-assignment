
# URL Shortener – Sembark Tech Backend Assignment

A role-based URL Shortener system built using **Laravel 12**, implementing:

- Company-wise multi-tenant URL management  
- Role restrictions (SuperAdmin, Admin, Member, Sales, Manager)  
- Policy-based access control  
- Short URL creation & resolution  
- User invitation rules  
- Full test coverage using Laravel's testing suite  

## 🚀 Features

### ✅ **1. Multi-company structure**
- Each user belongs to a **company**
- Sales & Manager roles can create short URLs **only for their company**
- Admin & Member cannot create URLs  
- SuperAdmin restricted from creating URLs (as per assignment)

### ✅ **2. Short URL Management**
- Generate short URLs (8-character codes)
- Store original URL, creator, and company
- Redirect internally using `resolve/{code}`
- Short URLs **are not publicly accessible**

### ✅ **3. Access Rules (Policies)**
| Role          | Can Create URL? | Can View URLs? |
|---------------|-----------------|----------------|
| SuperAdmin    | ❌ No            | ✔ Yes          |
| Admin         | ❌ No            | ✔ Only company |
| Member        | ❌ No            | ✔ Only own     |
| Sales         | ✔ Yes           | ✔ Only company |
| Manager       | ✔ Yes           | ✔ Only company |

### ✅ **4. Assignment Tests Implemented**
Includes full test file:

- Sales can create URLs  
- Admin/Member/SuperAdmin cannot  
- Company-based listing  
- No public access to resolve URL  
- Database tests  

All tests pass successfully.

---

## 🛠️ **Tech Stack**

- PHP 8.2  
- Laravel 12  
- MySQL  
- Breeze Authentication  
- Policies for authorization  
- PestPHP for tests  

---

## 📦 Installation & Setup

### **1. Clone the repository**

```

git clone [https://github.com/Dik-sha08/url-shortener-assignment.git](https://github.com/Dik-sha08/url-shortener-assignment.git)
cd url-shortener-assignment

```

---

## **2. Install dependencies**

```

composer install
npm install
npm run build

```

---

## **3. Create .env File**

```

cp .env.example .env

```

Then update the database section:

```

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url_shortener
DB_USERNAME=urluser
DB_PASSWORD=Diksha@123#

```

---

## **4. Generate application key**

```

php artisan key:generate

```

---

## **5. Run migrations**

```

php artisan migrate

```

---

## **6. Seed SuperAdmin**

```

php artisan db:seed

```

Seeder creates:

- SuperAdmin
- Default company (optional)

---

## ▶️ Running the Application

```

php artisan serve

```

Visit:

```

[http://127.0.0.1:8000](http://127.0.0.1:8000)

````

---

# 👥 Creating Test User for Roles

### **1. Create a company**

```sql
INSERT INTO companies (name, created_at, updated_at)
VALUES ('Test Company', NOW(), NOW());
````

Assume company_id = 1

### **2. Update user role**

```sql
UPDATE users
SET role = 'Sales', company_id = 1
WHERE email = 'your-email@example.com';
```

---

# 🔐 Authentication Flow

1. Register a new user (`/register`)
2. Update the user role in DB (Sales/Manager/Admin etc)
3. Login
4. Access:

```
/short-urls
```

---

# 🧪 Running Tests

To confirm that the assignment is complete:

```
php artisan test
```

All 30 tests (Laravel default + assignment tests) should pass.

---

# 📁 Project Structure

```
app/
 ├── Models/Company.php
 ├── Models/ShortUrl.php
 ├── Policies/ShortUrlPolicy.php
 ├── Http/Controllers/ShortUrlController.php
 ├── Http/Controllers/InvitationController.php
database/
 ├── migrations/
 ├── seeders/SuperAdminSeeder.php
tests/
 ├── Feature/ShortUrlAccessTest.php
resources/
 └── views/short_urls/index.blade.php
```

---

# 🤖 Acceptable AI Usage Declaration (Assignment Requirement)

As required in the assignment:

```
I have used AI tools responsibly and only for reference or syntax lookup.

- ChatGPT was used to understand Laravel policy rules, test structure, 
  and clarify error messages.
- All implementation logic, database design, controllers, policies,
  and test reasoning are written by me.
- No code was blindly copied. Every part was understood and verified manually.

This project follows the Acceptable AI Usage Policy as stated in the assignment.
```

---

# 📝 Conclusion

This project implements:

✔ Role-based URL creation
✔ Company-scoped data separation
✔ Authorization policies
✔ 100% passing tests
✔ Clean architecture
✔ Full assignment compliance

