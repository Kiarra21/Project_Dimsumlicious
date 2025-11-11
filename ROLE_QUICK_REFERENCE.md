# 🎯 Quick Reference - Role & Permissions

## 📌 Role Constants

```php
Role::ADMIN  // 'admin'
Role::STAFF  // 'staff'
Role::USER   // 'user'
```

## 🔑 Check User Role

```php
// In Controller
auth()->user()->isAdmin()
auth()->user()->isStaff()
auth()->user()->isUser()
auth()->user()->hasRole('admin')

// In Blade
@if(auth()->user()->isAdmin())
@if(auth()->user()->hasRole('staff'))
```

## 🛡️ Check Permission

```php
// In Controller
auth()->user()->hasPermission('product.create')

// In Blade
@if(auth()->user()->hasPermission('product.create'))
```

## 🚦 Route Middleware

### Role-based

```php
// Single role
->middleware('role:admin')

// Multiple roles (OR)
->middleware('role:admin,staff')
```

### Permission-based

```php
// Single permission
->middleware('permission:product.create')

// Multiple permissions (AND)
->middleware('permission:product.edit,product.manage')
```

## 📋 Admin Permissions (26 total)

```
Product: view, create, edit, delete, manage_status, upload_photo
Category: view, create, edit, delete
Staff: view, create, edit, delete
Report: view, sales, finance, download, transactions, profit, charts
Promo: view, create, edit, delete, upload_banner, manage_status
Company: view, edit, edit_description, edit_location, edit_contact, upload_media
```

## 👨‍💼 Staff Permissions (10 total)

```
Product: view, create, edit, delete, manage_status, upload_photo
Promo: view, create, edit, upload_banner
Report: view, transactions
```

## 👤 User Permissions (7 total)

```
Product: view
Promo: view
Company: view
Cart: add, view
Order: create, view
```

## 🔄 Quick Commands

```bash
# Run migrations
php artisan migrate

# Seed roles
php artisan db:seed --class=RoleSeeder

# Fresh start
php artisan migrate:fresh --seed
```
