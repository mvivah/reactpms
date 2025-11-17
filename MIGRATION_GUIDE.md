# ReactPMS Migration Guide

This document outlines the migration of the Laravel PMS (Pharmacy Management System) application from Blade templates to React with Inertia.js.

## ✅ Completed Steps

### 1. Backend Setup

#### Dependencies Added to `composer.json`
- `barryvdh/laravel-dompdf` - PDF generation
- `intervention/image` & `intervention/image-laravel` - Image processing
- `maatwebsite/excel` - Excel export functionality
- `phpoffice/phpspreadsheet` - Spreadsheet manipulation

#### Models Migrated
All models from `/pms/app/Models` have been copied to `/reactpms/app/Models`:
- Batch, Brand, Category, Email, ErrorLog, Expense, ExpenseType
- Inventory, Invoice, Login, MailingList, Product, ProductPurchase, ProductSale
- Purchase, Receipt, Role, Sale, Setting, Supplier, Unit, User

#### Database Migrations
All migration files have been copied from `/pms/database/migrations` to `/reactpms/database/migrations`.

#### Helper Files
- `app/Helpers/General.php` copied and configured in `composer.json` autoload

### 2. Controllers Created (Inertia-enabled)

The following controllers have been created with Inertia responses:

✅ **BrandController.php** - Complete CRUD for brands
✅ **CategoryController.php** - Complete CRUD for categories  
✅ **SupplierController.php** - Complete CRUD for suppliers with status toggling
✅ **UnitController.php** - Complete CRUD for measurement units
✅ **ProductController.php** - Complete with:
  - CRUD operations
  - Image upload handling
  - EOQ (Economic Order Quantity) reports
  - Expired products reports

### 3. Routes Configuration

Routes have been set up in `/reactpms/routes/web.php` for:
- Categories (index, create, store, edit, update, destroy, list)
- Brands (index, create, store, edit, update, destroy, list)
- Suppliers (index, create, store, edit, update, destroy, list, toggle-status)
- Units (index, create, store, edit, update, destroy, list)
- Products (full CRUD + reports)

### 4. React Pages Created

Example pages created in `/reactpms/resources/js/pages/`:
- ✅ `categories/index.tsx` - List view with delete functionality
- ✅ `categories/create.tsx` - Form for create/edit

## 🚧 Next Steps Required

### 1. Create Remaining Controllers

Create Inertia versions of these controllers (same pattern as existing):

#### High Priority:
- **RoleController.php** - User role management
- **UserController.php** - User management with avatar upload
- **PurchaseController.php** - Purchase orders and items
- **SaleController.php** - Sales transactions
- **InventoryController.php** - Inventory tracking
- **InvoiceController.php** - Invoice management
- **ReceiptController.php** - Receipt management

#### Medium Priority:
- **ExpenseController.php** - Expense tracking
- **ExpenseTypeController.php** - Expense categories
- **SettingController.php** - Application settings
- **MailingListController.php** - Email marketing lists

#### Supporting:
- **HomeController.php** - Dashboard
- **TurnoverController.php** - Financial reports

### 2. Create React Pages

Create React components in `/reactpms/resources/js/pages/` for each module:

```
pages/
├── brands/
│   ├── index.tsx
│   └── create.tsx (handles both create and edit)
├── categories/ ✅
│   ├── index.tsx
│   └── create.tsx
├── products/
│   ├── index.tsx
│   ├── create.tsx
│   └── show.tsx
├── suppliers/
│   ├── index.tsx
│   └── create.tsx
├── units/
│   ├── index.tsx
│   └── create.tsx
├── purchases/
│   ├── index.tsx
│   ├── create.tsx
│   └── show.tsx
├── sales/
│   ├── index.tsx
│   ├── create.tsx
│   └── show.tsx
├── inventories/
│   ├── index.tsx
│   └── report.tsx
├── expenses/
│   ├── index.tsx
│   └── create.tsx
├── users/
│   ├── index.tsx
│   ├── create.tsx
│   └── show.tsx
├── roles/
│   ├── index.tsx
│   └── create.tsx
└── reports/
    └── products/
        ├── eoq.tsx
        ├── expired.tsx
        └── results.tsx
```

### 3. Create Shared Components

Build reusable components in `/reactpms/resources/js/components/`:

#### Data Display:
- **DataTable.tsx** - Reusable table with sorting, filtering, pagination
- **Card.tsx** - Container component
- **Badge.tsx** - Status indicators
- **EmptyState.tsx** - No data placeholder

#### Forms:
- **FormInput.tsx** - Text input with validation
- **FormSelect.tsx** - Dropdown select
- **FormTextarea.tsx** - Multi-line text input
- **FormFileUpload.tsx** - File upload with preview
- **FormDatePicker.tsx** - Date selection
- **FormCheckbox.tsx** - Checkbox input
- **FormRadio.tsx** - Radio button

#### UI Elements:
- **Button.tsx** - Styled buttons
- **Modal.tsx** - Modal dialogs
- **Alert.tsx** - Success/error messages
- **ConfirmDialog.tsx** - Confirmation prompts
- **LoadingSpinner.tsx** - Loading indicator
- **Pagination.tsx** - Page navigation

### 4. Install and Run Dependencies

```bash
cd /var/www/html/reactpms

# Install PHP dependencies
composer install

# Install Node dependencies
npm install

# Run migrations
php artisan migrate

# Build frontend assets
npm run dev
```

### 5. Configuration Files to Review

Check and copy necessary configuration from `/pms/config/` if needed:
- `config/dompdf.php` (if exists)
- `config/excel.php` (if exists)
- Any custom configuration files

### 6. Public Assets

Copy any required assets:
```bash
# Copy product images
cp -r /var/www/html/pms/public/storage/products /var/www/html/reactpms/public/storage/

# Copy other public assets as needed
cp -r /var/www/html/pms/public/images /var/www/html/reactpms/public/
```

### 7. Environment Configuration

Update `/reactpms/.env`:
```env
APP_NAME="ReactPMS"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

## 🎯 Key Differences from Original PMS

### Backend Changes:
1. **Inertia Responses** - Controllers return `Inertia::render()` instead of `view()`
2. **Flash Messages** - Using `back()->with('success', 'message')` instead of JSON responses
3. **Gate Checks** - Authorization remains the same but redirects to Inertia pages

### Frontend Architecture:
1. **React 19** - Modern component-based UI library
2. **TypeScript** - Type safety throughout the application
3. **Inertia.js** - SPA-like experience without API endpoints
4. **Vite** - Fast build tooling
5. **Tailwind CSS v4** - Utility-first CSS framework
6. **Radix UI** - Headless UI components for accessibility

### Data Loading:
- **Before (Blade)**: Laratables for server-side data tables
- **After (Inertia)**: Client-side data tables with React components or server-side with Inertia pagination

## 📋 Development Workflow

1. **Start development server**:
   ```bash
   composer dev
   # OR manually:
   php artisan serve & npm run dev
   ```

2. **Create a new feature**:
   - Add route in `routes/web.php`
   - Create/update controller method
   - Create React page component
   - Test functionality

3. **Build for production**:
   ```bash
   npm run build
   ```

## 🔍 Testing

Run tests:
```bash
php artisan test
```

## 📚 Resources

- [Inertia.js Documentation](https://inertiajs.com/)
- [React Documentation](https://react.dev/)
- [Laravel 12 Documentation](https://laravel.com/docs)
- [Tailwind CSS v4](https://tailwindcss.com/)
- [Radix UI](https://www.radix-ui.com/)

## 🤝 Contributing

When adding new features:
1. Follow the established pattern for controllers (Inertia responses)
2. Create reusable React components
3. Use TypeScript interfaces for props
4. Add proper validation on both client and server
5. Test thoroughly before committing

---

**Status**: Backend structure complete, frontend components need to be built
**Last Updated**: November 17, 2025
