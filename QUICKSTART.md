# Quick Start Guide - ReactPMS

## Getting Started

### 1. Install Dependencies

```bash
cd /var/www/html/reactpms

# Install PHP dependencies
composer install

# Install Node.js dependencies
npm install
```

### 2. Environment Setup

Copy and configure your environment file:
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 3. Database Setup

Run migrations:
```bash
php artisan migrate
```

(Optional) Seed the database:
```bash
php artisan db:seed
```

### 4. Storage Setup

Create storage link:
```bash
php artisan storage:link

# Create products directory
mkdir -p public/storage/products
chmod -R 775 storage bootstrap/cache
```

### 5. Start Development Server

```bash
# Option 1: Using composer script (recommended)
composer dev

# Option 2: Manually
php artisan serve &
npm run dev
```

Visit `http://localhost:8000`

## Creating Your First Module

Let's create the Brands module as an example:

### 1. The Controller Already Exists
`/app/Http/Controllers/BrandController.php` ✅

### 2. Create React Pages

Create `/resources/js/pages/brands/index.tsx`:
```tsx
import { Head, Link, router } from '@inertiajs/react'

interface Brand {
  id: number
  name: string
  description: string
  created_at: string
}

interface Props {
  brands: Brand[]
}

export default function Index({ brands }: Props) {
  const deleteBrand = (id: number) => {
    if (confirm('Delete this brand?')) {
      router.delete(`/brands/delete/${id}`)
    }
  }

  return (
    <>
      <Head title="Brands" />
      
      <div className="py-12">
        <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div className="mb-6 flex items-center justify-between">
            <h1 className="text-3xl font-bold">Brands</h1>
            <Link href="/brands/create" className="btn-primary">
              Add New Brand
            </Link>
          </div>

          <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <table className="min-w-full divide-y divide-gray-200">
              <thead className="bg-gray-50">
                <tr>
                  <th className="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">
                    Name
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium uppercase text-gray-500">
                    Description
                  </th>
                  <th className="px-6 py-3 text-right text-xs font-medium uppercase text-gray-500">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody className="divide-y divide-gray-200 bg-white">
                {brands.map((brand) => (
                  <tr key={brand.id}>
                    <td className="px-6 py-4">{brand.name}</td>
                    <td className="px-6 py-4">{brand.description}</td>
                    <td className="px-6 py-4 text-right">
                      <Link
                        href={`/brands/edit/${brand.id}`}
                        className="text-blue-600 hover:text-blue-900 mr-3"
                      >
                        Edit
                      </Link>
                      <button
                        onClick={() => deleteBrand(brand.id)}
                        className="text-red-600 hover:text-red-900"
                      >
                        Delete
                      </button>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </>
  )
}
```

Create `/resources/js/pages/brands/create.tsx`:
```tsx
import { FormEvent } from 'react'
import { useForm, Head, Link } from '@inertiajs/react'

interface Brand {
  id: number
  name: string
  description: string
}

interface Props {
  brand?: Brand
}

export default function Create({ brand }: Props) {
  const { data, setData, post, processing, errors } = useForm({
    name: brand?.name || '',
    description: brand?.description || '',
    brand_id: brand?.id || null,
  })

  const submit = (e: FormEvent) => {
    e.preventDefault()
    post('/brands/store')
  }

  return (
    <>
      <Head title={brand ? 'Edit Brand' : 'Create Brand'} />
      
      <div className="py-12">
        <div className="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
          <div className="mb-6">
            <Link href="/brands" className="text-blue-600 hover:text-blue-900">
              ← Back to Brands
            </Link>
          </div>

          <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg p-6">
            <h2 className="mb-6 text-2xl font-bold">
              {brand ? 'Edit Brand' : 'Create Brand'}
            </h2>

            <form onSubmit={submit} className="space-y-6">
              <div>
                <label className="block text-sm font-medium text-gray-700">
                  Name <span className="text-red-500">*</span>
                </label>
                <input
                  type="text"
                  value={data.name}
                  onChange={(e) => setData('name', e.target.value)}
                  required
                  className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                />
                {errors.name && (
                  <p className="mt-1 text-sm text-red-600">{errors.name}</p>
                )}
              </div>

              <div>
                <label className="block text-sm font-medium text-gray-700">
                  Description <span className="text-red-500">*</span>
                </label>
                <textarea
                  value={data.description}
                  onChange={(e) => setData('description', e.target.value)}
                  required
                  rows={4}
                  className="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                />
                {errors.description && (
                  <p className="mt-1 text-sm text-red-600">{errors.description}</p>
                )}
              </div>

              <div className="flex justify-end space-x-3">
                <Link href="/brands" className="btn-secondary">
                  Cancel
                </Link>
                <button
                  type="submit"
                  disabled={processing}
                  className="btn-primary disabled:opacity-50"
                >
                  {processing ? 'Saving...' : brand ? 'Update' : 'Create'}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </>
  )
}
```

### 3. Test It

1. Visit `http://localhost:8000/brands`
2. Click "Add New Brand"
3. Fill the form and submit
4. View, edit, or delete brands

## Next Steps

Repeat this process for each module:
- ✅ Categories (example provided)
- Brands (example above)
- Units
- Suppliers  
- Products
- Users
- Roles
- Purchases
- Sales
- Expenses
- Invoices
- Receipts
- Inventory

## Useful Commands

```bash
# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Type checking
npm run types

# Linting
npm run lint

# Run tests
php artisan test

# Build for production
npm run build
```

## Troubleshooting

### "Class not found" errors
```bash
composer dump-autoload
```

### Frontend not updating
```bash
npm run dev
# or rebuild
npm run build
```

### TypeScript errors
```bash
npm run types
```

### Database errors
```bash
php artisan migrate:fresh
# or with seed
php artisan migrate:fresh --seed
```

## Project Structure

```
reactpms/
├── app/
│   ├── Http/Controllers/     # Inertia controllers
│   ├── Models/                # Eloquent models
│   └── Helpers/              # Helper functions
├── database/
│   ├── migrations/           # Database schema
│   └── seeders/              # Sample data
├── resources/
│   └── js/
│       ├── components/       # Reusable React components
│       ├── layouts/          # Page layouts
│       ├── pages/            # Page components (Inertia)
│       ├── types/            # TypeScript types
│       └── app.tsx           # Main entry point
├── routes/
│   ├── web.php              # Web routes
│   └── auth.php             # Auth routes
└── public/
    └── storage/             # Public file storage
```

## React + TypeScript Patterns

### Component with Props
```tsx
interface Props {
  title: string
  items: Item[]
}

export default function MyComponent({ title, items }: Props) {
  return <div>{title}</div>
}
```

### Form Handling
```tsx
const { data, setData, post, processing, errors } = useForm({
  name: '',
  email: '',
})

const submit = (e: FormEvent) => {
  e.preventDefault()
  post('/endpoint')
}
```

### State Management
```tsx
import { useState } from 'react'

const [count, setCount] = useState(0)
```

## Resources

- [Inertia.js Docs](https://inertiajs.com/)
- [React Docs](https://react.dev/)
- [Laravel Docs](https://laravel.com/docs)
- [Tailwind CSS](https://tailwindcss.com/)
- [TypeScript Docs](https://www.typescriptlang.org/)
- [Radix UI](https://www.radix-ui.com/)

---

Happy coding! 🚀
