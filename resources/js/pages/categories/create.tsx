import { FormEvent } from 'react'
import { useForm, Head, Link } from '@inertiajs/react'

interface Category {
  id: number
  name: string
  description: string | null
}

interface Props {
  category?: Category
}

export default function Create({ category }: Props) {
  const { data, setData, post, put, processing, errors } = useForm({
    name: category?.name || '',
    description: category?.description || '',
    category_id: category?.id || null,
  })

  const submit = (e: FormEvent) => {
    e.preventDefault()

    if (category) {
      put(`/categories/update/${category.id}`)
    } else {
      post('/categories/store')
    }
  }

  return (
    <>
      <Head title={category ? 'Edit Category' : 'Create Category'} />

      <div className="py-12">
        <div className="mx-auto max-w-2xl sm:px-6 lg:px-8">
          <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div className="p-6">
              <div className="mb-6 flex items-center justify-between">
                <h2 className="text-2xl font-semibold text-gray-800">
                  {category ? 'Edit Category' : 'Create Category'}
                </h2>
                <Link href="/categories" className="text-blue-600 hover:text-blue-900">
                  ← Back to List
                </Link>
              </div>

              <form onSubmit={submit} className="space-y-6">
                {/* Name Field */}
                <div>
                  <label htmlFor="name" className="block text-sm font-medium text-gray-700">
                    Category Name <span className="text-red-500">*</span>
                  </label>
                  <input
                    id="name"
                    type="text"
                    value={data.name}
                    onChange={(e) => setData('name', e.target.value)}
                    required
                    className={`mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 ${
                      errors.name ? 'border-red-500' : ''
                    }`}
                  />
                  {errors.name && <p className="mt-1 text-sm text-red-600">{errors.name}</p>}
                </div>

                {/* Description Field */}
                <div>
                  <label htmlFor="description" className="block text-sm font-medium text-gray-700">
                    Description
                  </label>
                  <textarea
                    id="description"
                    value={data.description || ''}
                    onChange={(e) => setData('description', e.target.value)}
                    rows={4}
                    className={`mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 ${
                      errors.description ? 'border-red-500' : ''
                    }`}
                  />
                  {errors.description && (
                    <p className="mt-1 text-sm text-red-600">{errors.description}</p>
                  )}
                </div>

                {/* Submit Button */}
                <div className="flex items-center justify-end space-x-3">
                  <Link
                    href="/categories"
                    className="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                  >
                    Cancel
                  </Link>
                  <button
                    type="submit"
                    disabled={processing}
                    className="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 disabled:opacity-50"
                  >
                    {processing ? 'Saving...' : category ? 'Update' : 'Create'}
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </>
  )
}
