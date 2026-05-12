## README.md File for Purple Fashion E-commerce Store

**`README.md`**

```markdown
# 🛍️ Purple Fashion - E-commerce Store

A modern, fully functional e-commerce fashion store built with Laravel 10, Bootstrap 5, and MySQL. Features a beautiful purple and white theme, complete admin panel, shopping cart, order management, and more.

## ✨ Features

### Frontend Features
- 🏠 **Home Page** - Hero banner, categories section, featured products
- 📦 **Products Page** - Grid layout with search and category filters
- 🔍 **Single Product View** - Product details, image gallery, size/color selection
- 🛒 **Shopping Cart** - Session-based cart, update quantities, remove items
- 💳 **Checkout** - Order placement with Cash on Delivery
- 📧 **Contact Page** - Contact form with database storage
- 📱 **Fully Responsive** - Mobile-friendly design

### Admin Panel Features
- 📊 **Dashboard** - Statistics overview, recent orders, messages
- 🎯 **Product Management** - CRUD operations with multiple image uploads
- 📋 **Order Management** - View orders, update status, view order items
- 👥 **User Management** - View registered users, delete users
- 👑 **Admin Management** - Create/delete admin accounts
- 💬 **Message Management** - View contact messages, mark as read

## 🚀 Technologies Used

- **Backend:** Laravel 10, PHP 8.1+
- **Frontend:** Bootstrap 5, Blade Templating, JavaScript, jQuery
- **Database:** MySQL
- **Additional:** DataTables (Yajra), Font Awesome 6, AOS Animations

## 📋 Requirements

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js (optional, for frontend assets)

## 🔧 Installation Guide

### Step 1: Clone the Repository

```bash
git clone https://github.com/yourusername/purple-fashion.git
cd purple-fashion
```

### Step 2: Install Dependencies

```bash
composer install
```

### Step 3: Environment Configuration

Copy the example environment file and update configuration:

```bash
cp .env.example .env
```

Update your `.env` file with database credentials:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=purple_fashion
DB_USERNAME=root
DB_PASSWORD=yourpassword
```

### Step 4: Generate Application Key

```bash
php artisan key:generate
```

### Step 5: Create Database

```bash
mysql -u root -p
CREATE DATABASE purple_fashion;
EXIT;
```

### Step 6: Run Migrations

```bash
php artisan migrate
```

### Step 7: Create Storage Link (Important for Images)

```bash
php artisan storage:link
```

### Step 8: Seed Database (Optional)

### Step 9: Clear Cache

```bash
php artisan cache:clear
php artisan view:clear
php artisan route:clear
php artisan config:clear
```

### Step 10: Start Development Server

```bash
php artisan serve
```

## 🌐 Access URLs

| Page | URL |
|------|-----|
| Homepage | http://localhost:8000 |
| Products | http://localhost:8000/products |
| Contact | http://localhost:8000/contact |
| Admin Login | http://localhost:8000/admin/login |
| Admin Dashboard | http://localhost:8000/admin/dashboard |

### Default Admin Credentials

- **Email:** admin@admin.com
- **Password:** password

## 📁 Project Structure

```
purple-fashion/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php      # All admin functions
│   │   │   ├── CartController.php       # Shopping cart
│   │   │   ├── CheckoutController.php   # Order placement
│   │   │   ├── ContactController.php    # Contact form
│   │   │   ├── FrontendController.php   # Home page
│   │   │   └── ProductController.php    # Product listing
│   │   └── Middleware/
│   └── Models/
│       ├── Admin.php
│       ├── ContactMessage.php
│       ├── Order.php
│       ├── OrderItem.php
│       ├── Product.php
│       └── User.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/
│   └── views/
│       ├── admin/
│       │   ├── layouts/
│       │   ├── admins/
│       │   ├── dashboard.blade.php
│       │   ├── login.blade.php
│       │   ├── messages/
│       │   ├── orders/
│       │   ├── products/
│       │   └── users/
│       ├── cart/
│       ├── checkout/
│       ├── layouts/
│       ├── products/
│       ├── contact.blade.php
│       └── home.blade.php
├── routes/
│   └── web.php
├── public/
│   └── storage/ (symlink to storage/app/public)
├── .env
└── README.md
```

## 🛠️ Admin Panel Features

### Dashboard
- Total products, orders, users, messages
- Pending orders count
- Recent orders with status
- Recent contact messages

### Products Management
- **Add Product:** Brand, name, category, sizes (checkbox), color, description, price, multiple images
- **Edit Product:** Update all fields, replace images
- **Delete Product:** Remove product and associated images

### Orders Management
- View all orders with customer details
- View order items (product snapshot)
- Update order status: pending, processing, shipped, delivered, cancelled
- Email customer button

### Users Management
- View all registered users
- See user order history
- Delete users (cascades to orders)

### Admins Management
- Create new admin accounts
- Delete admin accounts (cannot delete own account)

### Messages Management
- View contact form submissions
- Mark as read automatically when viewed
- Delete messages
- Reply via email button

## 🎨 Database Schema

### Products Table
- `id`, `brand_name`, `name`, `category`, `sizes` (JSON), `color`, `description`, `price`, `images` (JSON), `timestamps`

### Orders Table
- `id`, `order_number`, `customer_name`, `customer_email`, `customer_phone`, `customer_address`, `total_amount`, `payment_method`, `order_status`, `timestamps`

### Order Items Table
- `id`, `order_id`, `product_id`, `product_name`, `product_price`, `quantity`, `size`, `color`, `product_image`, `timestamps`

### Admins Table
- `id`, `name`, `email`, `password`, `timestamps`

### Users Table
- `id`, `name`, `email`, `password`, `timestamps`

### Contact Messages Table
- `id`, `name`, `email`, `message`, `is_read`, `timestamps`

## 🔄 Shopping Cart Flow

1. User adds product to cart (session-based)
2. Cart stores: product_id, name, price, quantity, size, color, image
3. Cart page displays items with update/remove options
4. Checkout collects customer details
5. Order creates with "pending" status
6. Order items store product snapshots
7. Cart cleared after successful order


## 🎨 Color Scheme

- **Primary Purple:** `#6B46C1`
- **Dark Purple:** `#553C9A`
- **Light Purple:** `#9F7AEA`
- **Background Purple:** `#FAF5FF`
- **Dark Text:** `#1A0B2E`
- **Gray Text:** `#4A5568`

## 🔧 Troubleshooting

### Images Not Showing
```bash
php artisan storage:link
php artisan cache:clear
```

### 404 Errors
```bash
php artisan route:clear
php artisan route:cache
```

### Database Issues
```bash
php artisan migrate:fresh
php artisan db:seed
```

## 📝 License

This project is open-source and available under the MIT License.

## 🙏 Acknowledgments

- Laravel Community
- Bootstrap 5
- Font Awesome
- DataTables
- AOS Animation Library

---
