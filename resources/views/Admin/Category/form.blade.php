<x-app-layout>
    <br>
    <div class="container max-w-screen-xl mx-auto mt-1" style="width: 80%; margin-left: auto; margin-right: 0;">
        <div class="px-4 sm:px-6 lg:px-8 bg-white pt-4">
            <h1 class="text-lg font-medium text-gray-900">
                {{ $category->id ?? false ? 'Edit Category' : 'Create Category' }}
            </h1>
            <form action="{{ $category->id ?? false ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}" method="POST">
                @lf
                @if ($category->id ?? false)
                    @method('PUT')
                @endif

                <div class="mt-6">
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ old('description', $category->description ?? '') }}</textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end">
                    <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        {{ $category->id ?? false ? 'Update Category' : 'Create Category' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
