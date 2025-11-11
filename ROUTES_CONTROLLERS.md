# 🛣️ Routes & Controllers Documentation

## 📋 Routes Overview

### **Admin/Staff Routes** (Protected)

#### 1. **Order Management** (`/orders`)

```php
Route::prefix('orders')->middleware(['auth', 'role:admin,staff'])->name('orders.')->group(function () {
    Route::get('/', 'OrderController@index');              // List all orders
    Route::get('/{id}', 'OrderController@show');           // View order detail
    Route::put('/{id}/status', 'OrderController@updateStatus'); // Update order status
    Route::delete('/{id}', 'OrderController@destroy');     // Delete order (Admin only)
});
```

**Access:**

-   Admin: ✅ Full access (view, edit, delete)
-   Staff: ✅ View & edit only

**Features:**

-   Filter by status (pending_payment, pending_cooking, completed, rejected)
-   Search by order number or customer name
-   View order details with items
-   Update order status
-   Badge notification for pending orders

---

#### 2. **Payment Management** (`/payments`)

```php
Route::prefix('payments')->middleware(['auth', 'role:admin,staff'])->name('payments.')->group(function () {
    Route::get('/', 'PaymentController@index');            // List all payments
    Route::get('/{id}', 'PaymentController@show');         // View payment detail
    Route::post('/{id}/verify', 'PaymentController@verify'); // Verify payment
    Route::post('/{id}/reject', 'PaymentController@reject'); // Reject payment
});
```

**Access:**

-   Admin: ✅ Full access
-   Staff: ✅ Full access

**Features:**

-   Filter by status (pending, verified, rejected)
-   Search by order number
-   View proof of payment image
-   Verify payment → Order status becomes `pending_cooking`
-   Reject payment → User can re-upload

---

### **User/Customer Routes** (Protected)

#### 3. **Cart Management** (`/cart`)

```php
Route::prefix('cart')->middleware(['auth', 'role:user'])->name('cart.')->group(function () {
    Route::get('/', 'CartController@index');                  // View cart
    Route::post('/add/{productId}', 'CartController@add');    // Add to cart
    Route::put('/{id}', 'CartController@update');             // Update quantity
    Route::delete('/{id}', 'CartController@remove');          // Remove item
    Route::delete('/', 'CartController@clear');               // Clear all
});
```

**Features:**

-   Add product to cart with quantity
-   Update cart item quantity
-   Remove single item
-   Clear entire cart
-   Auto-check stock availability
-   Calculate subtotal per item

---

#### 4. **Checkout** (`/checkout`)

```php
Route::get('/checkout', 'CheckoutController@index');        // Checkout page
Route::post('/checkout', 'CheckoutController@process');     // Process order
```

**Features:**

-   Display cart summary
-   Calculate subtotal, tax (10%), and total
-   Create order with order_number
-   Create order_items (snapshot of product data)
-   Create payment record (QRIS)
-   Reduce product stock
-   Clear cart after checkout

---

#### 5. **User Orders** (`/my-orders`)

```php
Route::get('/my-orders', 'UserOrderController@index');                      // List user's orders
Route::get('/my-orders/{id}', 'UserOrderController@show');                  // View order detail
Route::post('/orders/{id}/upload-payment', 'UserOrderController@uploadPayment'); // Upload proof
```

**Features:**

-   View all personal orders
-   View order details with QRIS
-   Upload payment proof (jpg, jpeg, png, max 2MB)
-   Re-upload if rejected
-   Track order status

---

## 🎯 Controllers Summary

### **OrderController** (Admin/Staff)

**Location:** `app/Http/Controllers/OrderController.php`

**Methods:**
| Method | Route | Description |
|--------|-------|-------------|
| `index()` | GET /orders | List all orders with filters |
| `show($id)` | GET /orders/{id} | View order details |
| `updateStatus($id)` | PUT /orders/{id}/status | Update order status |
| `destroy($id)` | DELETE /orders/{id} | Delete order (Admin only) |

**Status Flow:**

```
pending_payment → pending_cooking → completed
                     ↓
                  rejected
```

---

### **PaymentController** (Admin/Staff)

**Location:** `app/Http/Controllers/PaymentController.php`

**Methods:**
| Method | Route | Description |
|--------|-------|-------------|
| `index()` | GET /payments | List all payments with filters |
| `show($id)` | GET /payments/{id} | View payment details |
| `verify($id)` | POST /payments/{id}/verify | Verify payment proof |
| `reject($id)` | POST /payments/{id}/reject | Reject payment proof |

**Verification Actions:**

-   **Verify:** Set status to `verified`, update `verified_by`, change order status to `pending_cooking`
-   **Reject:** Set status to `rejected`, store `rejection_reason`, allow user to re-upload

---

### **CartController** (User)

**Location:** `app/Http/Controllers/CartController.php`

**Methods:**
| Method | Route | Description |
|--------|-------|-------------|
| `index()` | GET /cart | Display user's cart |
| `add($productId)` | POST /cart/add/{productId} | Add product to cart |
| `update($id)` | PUT /cart/{id} | Update cart item quantity |
| `remove($id)` | DELETE /cart/{id} | Remove item from cart |
| `clear()` | DELETE /cart | Clear all cart items |

**Validations:**

-   Check product availability (`is_available`)
-   Check stock before adding
-   Prevent duplicate entries (update quantity instead)
-   Unique constraint: `(user_id, product_id)`

---

### **CheckoutController** (User)

**Location:** `app/Http/Controllers/CheckoutController.php`

**Methods:**
| Method | Route | Description |
|--------|-------|-------------|
| `index()` | GET /checkout | Display checkout page |
| `process()` | POST /checkout | Process order creation |

**Process Flow:**

1. Validate cart is not empty
2. Calculate totals (subtotal + 10% tax)
3. Create order with unique `order_number`
4. Create order_items (snapshot data)
5. Create payment record
6. Reduce product stock
7. Clear cart
8. Redirect to order detail page

---

### **UserOrderController** (User)

**Location:** `app/Http/Controllers/UserOrderController.php`

**Methods:**
| Method | Route | Description |
|--------|-------|-------------|
| `index()` | GET /my-orders | List user's orders |
| `show($id)` | GET /my-orders/{id} | View order details |
| `uploadPayment($id)` | POST /orders/{id}/upload-payment | Upload payment proof |

**Upload Rules:**

-   File type: jpg, jpeg, png
-   Max size: 2MB
-   Only if status: `pending` or `rejected`
-   Deletes old proof if re-uploading
-   Resets status to `pending` after upload

---

## 🔐 Permissions Required

### Admin Permissions:

```
✅ order.view, order.edit, order.delete
✅ payment.view, payment.verify
✅ Full access to all features
```

### Staff Permissions:

```
✅ order.view, order.edit
✅ payment.view, payment.verify
❌ order.delete (Admin only)
```

### User Permissions:

```
✅ cart.* (all cart actions)
✅ checkout.* (checkout process)
✅ user.orders.* (own orders only)
```

---

## 🎨 Sidebar Integration

### Admin/Staff Sidebar Sections:

**1. Produk & Kategori**

-   Dashboard
-   Produk
-   Kategori

**2. Pemesanan** ⭐ NEW

-   Pesanan (with pending count badge)
-   Pembayaran (with pending count badge)

**3. Manajemen**

-   Manajemen Staff (Admin only)
-   Laporan (View Only for Staff)
-   Promosi
-   Company Profile (Admin only)

**4. Lainnya**

-   Profile
-   Pengaturan

---

## 📊 Badge Notifications

### Pesanan Badge (Red)

```php
$pendingOrders = \App\Models\Order::where('status', 'pending_payment')->count();
```

Shows count of orders waiting for payment upload.

### Pembayaran Badge (Yellow)

```php
$pendingPayments = \App\Models\Payment::where('status', 'pending')->count();
```

Shows count of payments waiting for verification.

---

## 🚀 Next Steps

### Views to Create:

1. **Admin Views:**

    - `resources/views/admin/orders/index.blade.php` - Order list
    - `resources/views/admin/orders/show.blade.php` - Order detail
    - `resources/views/admin/payments/index.blade.php` - Payment list
    - `resources/views/admin/payments/show.blade.php` - Payment detail

2. **User Views:**

    - `resources/views/user/cart/index.blade.php` - Shopping cart
    - `resources/views/user/checkout/index.blade.php` - Checkout page
    - `resources/views/user/orders/index.blade.php` - My orders list
    - `resources/views/user/orders/show.blade.php` - Order detail with upload

3. **Homepage Updates:**
    - Add "Lihat Menu" button linking to product catalog
    - Add "Keranjang" icon in navbar
    - Display cart item count

---

## ✅ Status

-   [x] Routes created for all features
-   [x] Controllers created with methods
-   [x] Sidebar updated with new menus
-   [x] Badge notifications implemented
-   [x] Permission checks added
-   [ ] Views not yet created
-   [ ] File storage setup needed
-   [ ] QRIS QR code generation pending

---

**Generated:** 2025-11-12  
**Status:** ✅ Routes & Controllers Complete  
**Next:** Create Blade views for all features

🎉 **Semua routes dan controllers untuk fitur pemesanan sudah siap!**
