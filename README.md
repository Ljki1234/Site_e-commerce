# WebDev Agency – Full-Stack PHP Application

A modern full-stack web application for a **Website Development Agency** built with **PHP 8**, **MySQL**, **Tailwind CSS**, and **Alpine.js**.

## Tech stack

- **PHP 8** (OOP, MVC)
- **MySQL** with **PDO** (prepared statements)
- **Tailwind CSS** (CDN) for UI
- **Alpine.js** for lightweight interactivity
- **Session-based authentication** with role-based access (Admin / Client)

## Project structure (MVC)

```
e-commerce/
├── app/
│   ├── Core/           # Application, Router, Request, Database, Controller
│   ├── Controllers/     # Auth, Home, Page, Order, Dashboard, Admin
│   ├── Middleware/      # Auth, Admin, Guest
│   └── Models/          # User, ServicePack, Order, Invoice, Message, AdminNote, PortfolioItem
├── config/
│   └── app.php         # App and DB config
├── database/
│   ├── schema.sql      # Full DB schema + seed data
│   └── seed_admin.php  # Set admin password to admin123
├── public/
│   ├── index.php       # Entry point
│   └── .htaccess       # Rewrite rules
├── resources/views/
│   ├── layouts/        # app, dashboard, admin
│   ├── components/     # navbar, footer, sidebar, button, card, badge, input, modal
│   ├── auth/            # login, register
│   ├── pages/           # services, packs, portfolio, contact
│   ├── dashboard/       # client dashboard views
│   └── admin/           # admin panel views
├── routes/
│   └── web.php         # All routes
├── storage/uploads/    # Uploaded files (requirements, deliverables)
├── bootstrap.php
└── helpers.php
```

## Setup

### 1. Database

- Create MySQL database and run the schema:

```bash
mysql -u root -p < database/schema.sql
```

- (Optional) Set admin password to `admin123`:

```bash
php database/seed_admin.php
```

Default admin (from schema) is **admin@webdevagency.com**. The schema seed uses a placeholder password; run `seed_admin.php` to set password to **admin123**.

### 2. Configuration

Edit `config/app.php`:

- **url**: Base URL of the app (e.g. `http://localhost/e-commerce/public`)
- **database**: host, dbname, user, password

### 3. Web server

- Point document root to the **public** folder (e.g. `c:\xampp\htdocs\e-commerce\public`), or
- Use XAMPP and open: `http://localhost/e-commerce/public`

Ensure `mod_rewrite` is enabled so `.htaccess` works.

## Features

### Public website (SaaS-style UI)

- **Home** – Hero, why choose us, website packs preview, CTA
- **Services** – Service descriptions
- **Website Packs (Pricing)** – Pricing cards with features and “Order now” (or “Register to order”)
- **Portfolio** – Portfolio grid (uses `portfolio_items` table)
- **Contact** – Contact form (stored in `messages`)
- **Login / Register** – Session-based auth

### Authentication

- Client registration and login
- Password hashing (`password_hash`)
- Roles: **admin**, **client**
- Protected dashboards via middleware

### Client dashboard

- Sidebar layout
- View orders with status badges (Pending, In Progress, Completed, Cancelled)
- Upload project requirements when ordering
- Download deliverables when provided
- View invoices
- Update profile

### Admin dashboard

- **Service pack management** – Create / Edit / Delete packs (name, slug, description, price, features, active, sort order)
- **CRM** – List clients, client detail, internal notes, client status (Lead / Active / VIP)
- **Order management** – List orders, order detail, update status, set deadline, upload deliverables, notes
- **Messages** – View contact form submissions
- **Analytics** – Total revenue, total clients, active orders, monthly revenue (simple bar view)

## Database tables

- **users** – id, email, password, full_name, company, phone, role (admin|client), status (lead|active|vip)
- **service_packs** – id, name, slug, description, price, features (JSON), is_active, sort_order
- **orders** – id, user_id, pack_id, status, requirements_file, deliverables_file, deadline, total_amount, notes
- **invoices** – id, order_id, invoice_number, amount, status, due_date
- **payments** – id, order_id, invoice_id, amount, method, reference, status, paid_at
- **messages** – id, user_id, name, email, subject, body, is_read
- **admin_notes** – id, user_id, author_id, note
- **portfolio_items** – id, title, slug, description, image_url, project_url, category, sort_order, is_active

All relationships use foreign keys.

## Security

- PDO prepared statements for all DB access
- Passwords hashed with `PASSWORD_DEFAULT`
- Role-based middleware (Auth, Admin, Guest)
- Session-based auth; no sensitive data in URLs

## UI

- Tailwind CSS (CDN) with a primary gradient and soft shadows
- Reusable components: Button, Card, Badge, Modal, Sidebar, Navbar, form inputs
- Responsive layout
- SaaS-style look (Stripe / Notion / Linear inspired)

---

**Scalable, secure, and ready for production use** after setting env-specific config (e.g. disabling `display_errors` and setting a strong DB password).
