import { Head, Link, router } from '@inertiajs/react'

interface Category {
  id: number
  name: string
  description: string | null
  created_at: string
  updated_at: string
}

interface Props {
  categories: Category[]
}

export default function Index({ categories }: Props) {
  const deleteCategory = (id: number) => {
    if (confirm('Are you sure you want to delete this category?')) {
      router.delete(`/categories/delete/${id}`)
    }
  }

  return (
    <>
      <Head title="Categories" />

      <div className="py-12">
        <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div className="p-6">
              <div className="mb-6 flex items-center justify-between">
                <h2 className="text-2xl font-semibold text-gray-800">Categories</h2>
                <Link
                  href="/categories/create"
                  className="rounded-md bg-blue-600 px-4 py-2 text-white hover:bg-blue-700"
                >
                  Add New Category
                </Link>
              </div>

              {/* Categories Table */}
              <div className="overflow-x-auto">
                <table className="min-w-full divide-y divide-gray-200">
                  <thead className="bg-gray-50">
                    <tr>
                      <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                        Name
                      </th>
                      <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                        Description
                      </th>
                      <th className="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                        Created At
                      </th>
                      <th className="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">
                        Actions
                      </th>
                    </tr>
                  </thead>
                  <tbody className="divide-y divide-gray-200 bg-white">
                    {categories.length > 0 ? (
                      categories.map((category) => (
                        <tr key={category.id}>
                          <td className="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                            {category.name}
                          </td>
                          <td className="px-6 py-4 text-sm text-gray-500">
                            {category.description || '-'}
                          </td>
                          <td className="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                            {new Date(category.created_at).toLocaleDateString()}
                          </td>
                          <td className="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                            <Link
                              href={`/categories/edit/${category.id}`}
                              className="mr-3 text-blue-600 hover:text-blue-900"
                            >
                              Edit
                            </Link>
                            <button
                              onClick={() => deleteCategory(category.id)}
                              className="text-red-600 hover:text-red-900"
                            >
                              Delete
                            </button>
                          </td>
                        </tr>
                      ))
                    ) : (
                      <tr>
                        <td colSpan={4} className="px-6 py-4 text-center text-sm text-gray-500">
                          No categories found. Create your first category!
                        </td>
                      </tr>
                    )}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </>
  )
}
