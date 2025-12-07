📌 URL Shortener – Backend Assignment (Sembark Tech)

This project is a role-based URL shortener system built using Laravel 12, implementing:

Company-wise user & URL isolation

Role-based access control (SuperAdmin, Admin, Member, Sales, Manager)

URL shortening with authorization policies

Invitation workflow (Admin & SuperAdmin restrictions)

Complete test suite (Pest + PHPUnit)

🚀 How to Setup the Project Locally
1️⃣ Clone the Repository
git clone https://github.com/Dik-sha08/url-shortener-assignment.git
cd url-shortener-assignment

2️⃣ Install Dependencies
composer install
npm install
npm run build

3️⃣ Environment Setup

Copy example file:

cp .env.example .env


Update .env with your MySQL credentials:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=url_shortener
DB_USERNAME=urluser
DB_PASSWORD=Diksha@123#


Generate key:

php artisan key:generate

4️⃣ Run Migrations & Seeders
php artisan migrate:fresh --seed


This will create:

Companies

Users (including SuperAdmin)

Short URLs table

Additional relations & roles

5️⃣ Start Development Server
php artisan serve


Visit:

👉 http://127.0.0.1:8000

🔐 Role Access Rules
Role	Can Create URL?	Notes
Sales	✅ Yes	Allowed
Manager	✅ Yes	Allowed
Admin	❌ No	Restricted
Member	❌ No	Restricted
SuperAdmin	❌ No	Restricted

Each role’s permissions are enforced using Laravel Policies.

🧪 Running Tests

To execute the full test suite:

php artisan test


Includes:

Authentication tests

Profile tests

URL access & visibility tests

Role-based authorization tests

📦 Project Structure (Summary)
app/
 ├── Models/
 ├── Policies/
 ├── Http/
 │    ├── Controllers/
 │    ├── Middleware/
database/
 ├── migrations/
 ├── seeders/
resources/
 ├── views/
tests/
 ├── Feature/
 ├── Unit/

🤖 AI Usage Declaration (As Required by Assignment)

I used AI tools only for assistance, not for generating the full assignment.
My usage includes:

ChatGPT: Helped me understand Laravel policies, model relationships, and testing concepts.

ChatGPT: Assisted in debugging specific errors (policy binding, factories, controller fixes).

Cursor / ChatGPT: Used occasionally for syntax lookup (e.g., validation, migrations).

All implementation decisions, coding, testing, debugging strategy, and final logic are my own work.
AI was used only for learning, verification, and error guidance as allowed in the assignment.
